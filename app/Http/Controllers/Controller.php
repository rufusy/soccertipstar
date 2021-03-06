<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

use Session;
use Redirect;
use Carbon\Carbon;

use App\User;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   
    //commmon function to display the error both in terminal and browser
    /**
     * return_output
     *
     * @param  mixed $type
     * @param  mixed $status_title
     * @param  mixed $message
     * @param  mixed $redirect_url
     * @param  mixed $status_code
     *
     * @return void
     */
    public function return_output($type, $status_title, $message, $redirect_url, $status_code = '')
    {
        // echo 'test';exit;
        //$type = error/flash - error on form validations, flash to show session values
        //$status_title = success/error/info - change colors in toastr as per the status

        if ($type=='error') 
        {
            if ($redirect_url == 'back') 
            {
                return Redirect::back()->withErrors($message)->withInput();
            } elseif ($redirect_url != '') 
            {
                return Redirect::to($redirect_url)->withErrors($message)->withInput();
            }
        } 
        else 
        {
            if ($redirect_url == 'back') 
            {
                return Redirect::back()->with($status_title, $message);
            } 
            elseif ($redirect_url != '') 
            {
                return Redirect::to($redirect_url)->with($status_title, $message);
            } 
            elseif ($redirect_url == '') 
            {
                return Session::flash($status_title, $message);
            }
        }
        
    }


    /**
     * user_subscription
     *
     * @return void
     */
    public function user_subscription($user_id)
    {
        /**
         * Users registered on the website always have an associated subscription.
         * We check whether their subscription is still active or not.
         * If subscription is active they can view premium tips.
         */
        $user = User::find($user_id);
        if($user)
        {
            if ($user->hasRole('administrator'))
                $subscription_is_active = true;
            else{
                $subscription = app('rinvex.subscriptions.plan_subscription')::where('user_id', $user->id)->first();
                $subscription_is_active = $user->subscribedTo($subscription->plan_id);
            }
            return $subscription_is_active;
        }
        return false;
    }
  
}
