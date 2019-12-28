<?php

    /**
     * PHP Version 7.2.19
     * Functions for website subscriber
     * 
     * @category    File
     * @package     Account
     * @author      Idachi Rufusy
     * @copyright   soccertipstar 
     */

    namespace App\Http\Controllers\Site;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;

    use Carbon\Carbon;


    use App\User;
    use App\Profile;
    use App\Http\Controllers\Payment\CashierController;
    use App\Mail\PaymentCompleteEmail;



    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Account
     *  @author     Idachi Rufusy
     *  @copyright  soccertipstar
     */

    class AccountController extends Controller
    {


        /**
         * index
         *
         * @return void
         */
        public function index()
        {
            $logged_in_user = auth()->user();

            if (!Auth::user()->hasRole('administrator'))
            {
                $subscription =  app('rinvex.subscriptions.plan_subscription')::where('user_id', $logged_in_user->id)
                                                                            ->first();
                $plan =  app('rinvex.subscriptions.plan')::find($subscription->plan_id);
                $plan_name = $plan->name;

                // Format subcription end date 18 January 2019 11:30 AM EAT
                $ends_at = Carbon::parse($subscription->ends_at)->format('d F Y g:i A').' EAT';

                $role = 'user';
            }
            else {
                $ends_at = 'Forever';
                $plan_name = null;
                $role = 'administrator';
            }

            // check if subscription is active
            $user = Auth::user();
            $subscription_is_active = $this->user_subscription($user->id);


            $user = [
                'id' => $logged_in_user->id,
                'role' => $role,
                'name' => $logged_in_user->first_name.' '.$logged_in_user->last_name,
                'first_name' => $logged_in_user->first_name,
                'last_name' => $logged_in_user->last_name,
                'email' => $logged_in_user->email,
                'plan' => $plan_name,
                'subscription_exp' => $ends_at,
                'country' => $logged_in_user->country,
                'subscription_is_active' => $subscription_is_active
            ];

            return view('site.users.index', compact('user'));
        }

        /**
         * update
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function updateProfile(Request $request)
        {
            $user = auth()->user();

            $success_message = 'Account updated successfully';

            $validation_rules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            ];
        
            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) 
            {
                return $this->return_output('error', 'error', $validator, 'back', '422');
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            return $this->return_output('flash', 'success', $success_message, '/account', '200');
        }

        /**
         * checkUserPasswordMatches
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function checkUserPasswordMatches(Request $request)
        {
            $user = auth()->user();

            echo Hash::check($request->old_password, $user->password) ? "true" : "false";
            
        }

        /**
         * updatePassword
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function updatePassword(Request $request)
        {
            $user = auth()->user();

            $success_message = 'Password updated successfully';

            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return $this->return_output('flash', 'success', $success_message, '/account', '200');

        }

        /**
         * makePayment
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function makePayment(Request $request)
        {
            // Token info 
            $token = $request->payment_token;

            // Card info
            $card_holder = $request->card_name;
            $card_number = $request->card_number;
            $card_number = substr_replace($card_number,'****', 0, strlen($card_number)-4);

            // Buyer info
            $user = auth()->user();
            $email = $user->email;
            $buyer_name = $user->first_name.' '.$user->last_name;
            $country = $user->country;

            $plan =  app('rinvex.subscriptions.plan')::find($request->plan);
            $itemName = $plan->name;
            $itemPrice = $plan->price;
            $itemDesc = $plan->description;
            $currency = env('CURRENCY');
            $orderID = time() . mt_rand() . $user->id;
    
            $payment_info = [
                "sellerId" => env('2CHECKOUT_SELLER_ID'),
                "merchantOrderId" => $orderID,
                "token" => $token,
                "currency" => $currency,
                "total" => $itemPrice, 
                "billingAddr" => [
                    "name" => $card_holder,
                    "email" => $email,
                    "addrLine1" => 'address Line 1',
                    "city" => 'City',
                    "state" => 'State',
                    "zipCode" => 'Zipcode',
                    "country" => $country,
                    "phoneNumber" => 'N/A'
                ]
            ];

            $res = CashierController::pay($payment_info);

            if($res['success'])
            {
                app('rinvex.subscriptions.plan_subscription')::where('user_id', $user->id)->delete();
                $user->newSubscription('main', $plan);
                
                $order_info = [
                    'subject' => 'Payment to soccertipstar',
                    'order_id' => $orderID,
                    'card_holder' => $card_holder,
                    'card_number' => $card_number,
                    'buyer_name' => $buyer_name,
                    'buyer_email' => $email,
                    'item_name' => $itemName,
                    'item_price' => $itemPrice,
                    'currency' => $currency,
                ];

                Mail::send(new PaymentCompleteEmail($order_info));
            }
            else
            {
                return $this->return_output('flash', 'error', $res['message'], 'back', '400');  
            }

            return $this->return_output('flash', 'success', 'Payment made successfully', 'back', '200');
        }


        /**
         * delete
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function delete(Request $request)
        {
            $id = $request->id;
            if(!empty($id))
            {   
                app('rinvex.subscriptions.plan_subscription')::where('user_id', $id)->delete();

                User::find($id)->delete();
                return response()->json(['success'=>'Account deleted successfully']);
            }
            else 
            {
                return response()->json(['errors'=>'Account failed to delete']);
            }
        }
    }
