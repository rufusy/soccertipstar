<?php

    /**
     * PHP Version 7.2.19
     * Functions for dashboard
     * 
     * @category    File
     * @package     Country
     * @author      Idachi Rufusy
     * @copyright   soccertipstar 
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    use App\Country;


    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    Country
     *  @author     Idachi Rufusy
     *  @copyright  soccertipstar
     */

    class CountryController
    {

        /**
         * index
         *
         * @return all countries
         */

        public function index()
        {
            $countries = Country::all();

            // Return the result to jquery datatables
            if(request()->ajax())
            {
                return datatables()->of($countries)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Edit" 
                                    class="edit btn btn-primary btn-sm btn-flat editCountry">
                                    Edit</a>';

                            $btn .= '<a href="javascript:void(0)" 
                                    data-toggle="tooltip"  data-id="'.$row->id.'" 
                                    data-original-title="Delete" 
                                    class="btn btn-danger btn-sm btn-flat deleteCountry">
                                    Delete</a>';

                            return $btn;  
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('admin.countries.index');
        }


        public function saveCountry(Request $request)
        {
            $country_id = $request->country_id;

            $data = request()->validate([
                'name' => 'required|string|max:255|unique:countries'
            ]);

            if($country_id)
            {
                $country = Country::findOrFail($country_id);
                $success_message = 'Country updated successfully';
            }
            else
            {
                $country = new Country();
                $success_message = 'Country added successfully';
            }

            $country->name = $data['name'];
            $country->save();
            //Session::flash('success', $success_message);
            return response()->json(['success' => $success_message]);
        }


        public function edit($id)
        {
            $country = Country::find($id);

            return response()->json($country);
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
            $id = $request->country_id;
            if(!empty($id))
            {   
                Country::find($id)->delete();
                return response()->json(['success'=>'Country deleted']);
            }
            else 
            {
                return response()->json(['error'=>'Country not deleted']);
            }            
        }


        /**
         * getData
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function getData(Request $request)
        {
            $countries = Country::all();
            return response()->json($countries);
        }
    }