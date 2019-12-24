<?php

    /**
     * PHP Version 7.2.19
     * Functions for dashboard
     * 
     * @category    File
     * @package     Supersingle
     * @author      Idachi Rufusy
     * @copyright   soccertipstar 
    */

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Carbon\Carbon;


    use App\Match;
    use App\Team;
    use App\Odd;
    use App\SuperSingleMatch;

    class SupersingleController
    {
        public function index()
        {
            $matches = Match::whereNotNull('supersingle_id')->get();

            // Format the result for the dashboard
            $matches->map(function($match){
              
                $homeTeam = Team::find($match->home_team);
                $awayTeam = Team::find($match->away_team);
                $match['game'] = $homeTeam->name.' vs '.$awayTeam->name;

                $odds = explode(',',$match->odd_type);
                $oddTypeNames = '';
                foreach($odds as $odd)
                {
                    $oddTypeName = Odd::find($odd);
                    $oddTypeNames .= $oddTypeName->name .',';
                }
                $oddTypeNames= substr($oddTypeNames, 0, -1);
                $match['odd_type'] = $oddTypeNames;

                $supersingle = SuperSingleMatch::find($match->supersingle_id);
                $supersingleName = $supersingle->name;
                $match['supersingleName'] = $supersingleName;
                
                $match['match_date'] = Carbon::parse($match->match_date)->format('d-m-Y H:i');
                return $match;
            });

          

            // Return the result to jquery datatables
            if(request()->ajax())
            {

                return datatables()->of($matches)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                             $btn = '<a href="javascript:void(0)" 
                                        data-toggle="tooltip"  data-id="'.$row->id.'" 
                                        data-original-title="Delete" 
                                        class="btn btn-danger btn-sm btn-flat delete-from-supersingle">
                                        Delete</a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('admin.supersingles.index');  
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
            $count = SuperSingleMatch::count();
            $count === 0 ? $name = 'SuperSingle #1' : $name = 'SuperSingle #'.(string)($count+1); 
            $SuperSingle = SuperSingleMatch::create([
                'name' => $name
            ]);
            if($SuperSingle)
            {
                foreach($request->matches as $matchId)
                {
                    $match = Match::find($matchId);
                    $match->supersingle_id = $SuperSingle->id;
                    $match->save();
                }
                return response()->json(['success'=>'Supersingle created successfully']);  
            }
            else 
            {
                return response()->json(['errors'=>'Supersingle not created']); 
            }
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
            $match = Match::find($request->match_id);
            $supersingle_id = $match->supersingle_id;
            $match->supersingle_id = NULL;
            $match->save();
            SuperSingleMatch::find($supersingle_id)->delete();
            return response()->json(['success'=> 'Match removed from supersingle']);
        }

    }