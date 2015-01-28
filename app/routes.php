<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if (Auth::check())
    {
        // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
        return Redirect::to('analytic');
    }
    else
    {
    	return Redirect::to('login');
    }
});

Route::get('/login', function()
{
	if (Auth::check())
    {
        // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
        return Redirect::to('analytic');
    }
    
	return View::make('login');
});

// Inicio de session
Route::post('login', 'AuthController@authLogin');

// Cierre de session
Route::get('logout', 'AuthController@logout');

//Route::group(['prefix' => 'analytic','before' => 'auth'], function ()
Route::group(['prefix' => 'analytic','before' => 'auth'], function ()
{
	// Pagina principal del panel de administracion
    Route::get('/', 'HomeController@index');

    // Carga de informacion de tablero seleccionado
    Route::post('/loadboardconfig', 'BoardController@loadBoardConfig');
});