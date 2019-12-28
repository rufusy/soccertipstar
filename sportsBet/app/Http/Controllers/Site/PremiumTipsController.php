<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\MultibetController;
use App\Http\Controllers\Admin\MaxstakeController;

use App\Match;


class PremiumTipsController extends HomeController
{
    /**
     * premiumTips
     *
     * @return void
     */
    public function premiumTips()
    {
        $premium = Match::where('tag', 'Premium')
                    ->where('outcome', 'In progress')
                    ->orderBy('match_date', 'asc')
                    ->get();

        $supersingle = Match::where('is_supersingle', 1)
                    ->where('outcome', 'In progress')
                    ->orderBy('match_date', 'asc')
                    ->get();

        $played = Match::where('outcome', '!=', 'In progress')
                    ->orderBy('match_date', 'asc')
                    ->get();

        $paidMatches = $this->prettyMatches($premium);
        $supersingleMatches = $this->prettyMatches($supersingle);
        $playedMatches = $this->prettyMatches($played);


        $subscription_is_active = $this->user_subscription();

       return view('site.paidTips', compact('paidMatches', 'subscription_is_active', 'supersingleMatches', 'playedMatches')); 
    }


    /**
     * getMultibets
     *
     * @return void
     */
    public function getMultibets()
    {
        $matches = MultibetController::multibetMatches();
        // Return the result to jquery datatables
        if(request()->ajax())
        {
            return datatables()->of($matches)->make(true);
        }
    }


    /**
     * getMaxstakes
     *
     * @return void
     */
    public function getMaxstakes()
    {
        $matches = MaxstakeController:: MaxstakeMatches();
        // Return the result to jquery datatables
        if(request()->ajax())
        {
            return datatables()->of($matches)->make(true);
        }
    }

}