<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('site.home');
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


}
