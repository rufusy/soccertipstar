<?php

    /**
     * PHP Version 7.2.19
     * Functions for dashboard
     * 
     * @category    File
     * @package     League
     * @author      Idachi Rufusy
     * @copyright   soccertipstar 
     */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    use App\League;
    use App\Country;

    /**
     *  Class contain functions for admin
     *  @category   Class
     *  @package    League
     *  @author     Idachi Rufusy
     *  @copyright  soccertipstar
     */

    class LeagueController
    {
        /**
         * index
         *
         * @return void
         */
        public function index()
        {
            $leagues = League::all();

            // Append the country name of the league to the collection result
            $leagues->map(function($league){
                $country = Country::find($league->country_id);
                $league['country'] = $country->name;
                return $league;
            });

            // Return the result to jquery datatables
            if(request()->ajax())
            {
                return datatables()->of($leagues)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)"
                                    data-toggle="tooltip"  
                                    data-id="'.$row->id.'" 
                                    data-original-title="Edit" 
                                    class="edit btn btn-primary btn-sm btn-flat editLeague">
                                    Edit</a>';

                            $btn .= '<a href="javascript:void(0)" 
                                    data-toggle="tooltip"  data-id="'.$row->id.'" 
                                    data-original-title="Delete" 
                                    class="btn btn-danger btn-sm btn-flat deleteLeague">
                                    Delete</a>';

                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('admin.leagues.index');
        }

        
        /**
         * edit
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function edit(Request $request)
        {
            $id = $request->league_id;
            $league = League::find($id);
            return response()->json($league);
        }


        /**
         * store
         *
         * @param  mixed $request
         *
         * @return void
         */
        public function store(Request $request)
        {
            $league_id = $request->league_id;

            if($league_id)
            {
                $data = request()->validate([
                    'name' => 'required|string|max:255',
                    'country' => 'required'
                ]);
                $league = League::find($league_id);
                $success_message = 'League updated successfully';
            }
            else
            {
                $data = request()->validate([
                    'name' => 'required|string|max:255|unique:leagues',
                    'country' => 'required'
                ]);
                $league = new League();
                $success_message = 'League added successfully';
            }
            $league->name = $data['name'];
            $league->country_id = $data['country'];
            $league->save();
            return response()->json(['success' => $success_message]);
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
            $id = $request->league_id;
            if(!empty($id))
            {   
                League::find($id)->delete();
                return response()->json(['success'=>'League deleted']);
            }
            else 
            {
                return response()->json(['error'=>'League not deleted']);
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
            $id = $request->league_id;
            $leagues = League::all();
            return response()->json($leagues);
        }


         /**
         * getLeagues 
         *
         * Get leagues under country
         * 
         * @param  mixed $request
         *
         * @return void
         */
        public function getLeaguesUnderCountry(Request $request)
        {
            $countryId = $request->countryId;
            if(!empty($countryId))
            {   
                $leagues = League::where('country_id', $countryId)->get();
                return response()->json($leagues);
            }
        }
    }