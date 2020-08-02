<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Match;
use App\Team;
use App\Odd;
use App\Mail\contactMessageEmail;
use App\Http\Controllers\Admin\MultibetController;
use App\Http\Controllers\Admin\MaxstakeController;


class HomeController extends Controller
{
     
    /**
     * prettyMatches
     *
     * @param  mixed $queryResult
     *
     * @return void
     */
    public function prettyMatches($queryResult)
    {
        $queryResult->map(function($match){

            $homeTeam = Team::find($match->home_team);
            $awayTeam = Team::find($match->away_team);
            $match['game'] = $homeTeam->name.' vs '.$awayTeam->name;
            //$match['game'] = $match['home_team'].' vs '.$match['away_team'];

            $odds = explode(',',$match->odd_type);
            $oddTypeNames = '';
            foreach($odds as $odd)
            {
                $oddTypeName = Odd::find($odd);
                $oddTypeNames .= $oddTypeName->name .',';
            }
            $oddTypeNames= substr($oddTypeNames, 0, -1);
            $match['odd_type'] = $oddTypeNames;
            
            $match['match_date'] = Carbon::parse($match->match_date)->format('d-m-Y H:i');

            return $match;
        });

        return $queryResult;
    }


   
    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        // $free = DB::table('matches')
        //                 ->join('teams as ht', 'matches.home_team', '=', 'ht.id')
        //                 ->join('teams as at', 'matches.away_team', '=', 'at.id')
        //                 ->select('matches.*', 'ht.name as home_team', 'at.name as away_team')
        //                 ->where('tag', 'Free')
        //                 ->get();

        $free = Match::where('tag', 'Free')
                        ->where('outcome', 'In progress')
                        ->orderBy('match_date', 'asc')
                        ->get();

        $played = Match::where('outcome', '!=', 'In progress')
                        ->orderBy('match_date', 'asc')
                        ->get();

        $freeMatches = $this->prettyMatches($free);
        $playedMatches = $this->prettyMatches($played);
        $odds = Odd::all();

        return view('site.freeTips', compact('freeMatches', 'playedMatches', 'odds'));
    }


     /**
     * Function to check whether the email already exists
     *
     * @param array $request All input values from form
     *
     * @return true or false
     */

    public function checkUserEmailExists(Request $request)
    {
        $email = $request->input('email');

        $users = User::where('email', $email)->first();

        echo $users ? "false" : "true";
    }

 
    /**
     * sendMessage
     *
     * @param  mixed $request
     *
     * @return void
     */
    public function sendMessage(Request $request)
    {
        $message_info = [
            'name' => $request->input('name'),
            'subject' => $request->input('subject'),
            'email' =>  $request->input('email'),
            'message' => $request->input('message')
        ];
        Mail::send(new contactMessageEmail($message_info));
       
        return response()->json('OK');
    }

    /**
     * getPlans
     *
     * @return void
     */
    public function getPlans()
    {
        $plans = app('rinvex.subscriptions.plan')::where('is_active', 1)->get();
        
        return response()->json($plans);
    }

}
