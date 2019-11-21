<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Match;
use App\Team;
use App\Odd;
use App\Mail\contactMessageEmail;


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

        $premium = Match::where('tag', 'Premium')
                        ->where('outcome', 'In progress')
                        ->orderBy('match_date', 'asc')
                        ->get();

        $played = Match::where('outcome', '!=', 'In progress')
                        ->orderBy('match_date', 'asc')
                        ->get();

        $freeMatches = $this->prettyMatches($free);
        $paidMatches = $this->prettyMatches($premium);
        $playedMatches = $this->prettyMatches($played);

        $odds = Odd::all();

        return view('site.home', compact('freeMatches', 'paidMatches', 'playedMatches', 'odds'));
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

    public function signup(Request $request)
    {
        dd($request->all());
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
        Mail::send(new contactMessageEmail($request->input('name'),
                                        $request->input('subject'),
                                        $request->input('email'),
                                        $request->input('message')));
       
        return response()->json('OK');
    }

}
