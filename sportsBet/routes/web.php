<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'Site\HomeController@index')->name('home');
Route::post('sendMessage','Site\HomeController@sendMessage')->name('sendMessage');
Route::get('getPlans', 'Site\HomeController@getPlans')->name('getPlans');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

/* Jquery form Validation */
Route::get('checkUserEmailExists', 'Site\HomeController@checkUserEmailExists')->name('checkUserEmailExists');
Route::get('checkUserPasswordMatches', 'Site\AccountController@checkUserPasswordMatches')->name('checkUserPasswordMatches');

Auth::routes(['verify' => true]);
Route::get('logout', 'Auth\LoginController@logout')->name('logOut');

Route::group(['middleware' => ['auth','verified']], function(){

    Route::get('account', 'Site\AccountController@index')->name('account.index');
    Route::post('account/update-profile', 'Site\AccountController@updateProfile')->name('account.updateProfile');
    Route::post('account/update-password', 'Site\AccountController@updatePassword')->name('account.updatePassword');
    Route::post('account/make-payment', 'Site\AccountController@makePayment')->name('account.makePayment');
    Route::post('account/delete', 'Site\AccountController@delete')->name('account.delete');


    Route::group(['middleware' => ['role:administrator']], function() {

        Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

        Route::get('admin/users', 'Admin\UserController@index')->name('admin.users');
        Route::get('admin/create-user', 'Admin\UserController@create')->name('admin.createUser');
        Route::get('admin/edit-user/{user_id}', 'Admin\UserController@edit')->name('admin.editUser');
        Route::post('admin/save-user', 'Admin\UserController@saveUser')->name('admin.saveUser');
        Route::post('admin/delete-user', 'Admin\UserController@delete')->name('admin.deleteUser');

        Route::get('admin/countries', 'Admin\CountryController@index')->name('admin.countries');
        Route::get('admin/edit-country/{country_id}', 'Admin\CountryController@edit')->name('admin.editCountry');
        Route::post('admin/save-country', 'Admin\CountryController@saveCountry')->name('admin.saveCountry');
        Route::post('admin/delete-country', 'Admin\CountryController@delete')->name('admin.deleteCountry');
        Route::get('admin/countries/get-data', 'Admin\CountryController@getData')->name('countries.getData');
      
        Route::get('admin/leagues', 'Admin\LeagueController@index')->name('leagues.index');
        Route::get('admin/leagues/edit', 'Admin\LeagueController@edit')->name('leagues.edit');
        Route::post('admin/leagues/store', 'Admin\LeagueController@store')->name('leagues.store');
        Route::post('admin/leagues/delete', 'Admin\LeagueController@delete')->name('leagues.delete');
        Route::get('admin/leagues/get-data', 'Admin\LeagueController@getData')->name('leagues.getData');
        Route::get('admin/leagues/get-leagues-under-country', 'Admin\LeagueController@getLeaguesUnderCountry')->name('leagues.leagueCountry');
       
        Route::get('admin/teams', 'Admin\TeamController@index')->name('teams.index');
        Route::get('admin/teams/edit', 'Admin\TeamController@edit')->name('teams.edit');
        Route::post('admin/teams/store', 'Admin\TeamController@store')->name('teams.store');
        Route::post('admin/teams/delete', 'Admin\TeamController@delete')->name('teams.delete');
        Route::get('admin/teams/get-teams-under-league', 'Admin\TeamController@getTeamsUnderLeague')->name('teams.teamLeague');
              
        Route::get('admin/odds', 'Admin\OddController@index')->name('odds.index');
        Route::get('admin/odds/edit', 'Admin\OddController@edit')->name('odds.edit');
        Route::post('admin/odds/store', 'Admin\OddController@store')->name('odds.store');
        Route::post('admin/odds/delete', 'Admin\OddController@delete')->name('odds.delete');
        Route::get('admin/odds/get-data', 'Admin\OddController@getData')->name('odds.getData');
       
        Route::get('admin/matches', 'Admin\MatchController@index')->name('matches.index');
        Route::get('admin/matches/edit', 'Admin\MatchController@edit')->name('matches.edit');
        Route::post('admin/matches/store', 'Admin\MatchController@store')->name('matches.store');
        Route::post('admin/matches/delete', 'Admin\MatchController@delete')->name('matches.delete');
        Route::post('admin/matches/delete-selected', 'Admin\MatchController@deleteSelected')->name('matches.deleteSelected');

        Route::get('admin/multibets', 'Admin\MultibetController@index')->name('multibets.index');
        Route::post('admin/multibets/store', 'Admin\MultibetController@store')->name('multibet.store');
        Route::post('admin/multibets/delete', 'Admin\MultibetController@delete')->name('multibet.delete');
        Route::post('admin/multibets/delete-selected', 'Admin\MultibetController@deleteSelected')->name('multibet.deleteSelected');

        Route::get('admin/supersingles', 'Admin\SupersingleController@index')->name('supersingles.index');
        Route::post('admin/supersingles/store', 'Admin\SupersingleController@store')->name('supersingle.store');
        Route::post('admin/supersingles/delete', 'Admin\SupersingleController@delete')->name('supersingle.delete');

        Route::get('admin/maxstake', 'Admin\MaxstakeController@index')->name('maxstake.index');
        Route::post('admin/maxstake/store', 'Admin\MaxstakeController@store')->name('maxstake.store');
        Route::post('admin/maxstake/delete', 'Admin\MaxstakeController@delete')->name('maxstake.delete');
        Route::post('admin/maxstake/delete-selected', 'Admin\MaxstakeController@deleteSelected')->name('maxstake.deleteSelected');

        Route::get('admin/plans', 'Admin\PlanController@index')->name('plans.index');
        Route::get('admin/plans/edit', 'Admin\PlanController@edit')->name('plans.edit');
        Route::post('admin/plans/store', 'Admin\PlanController@store')->name('plans.store');
        Route::post('admin/plans/delete', 'Admin\PlanController@delete')->name('plans.delete');
    });
});


