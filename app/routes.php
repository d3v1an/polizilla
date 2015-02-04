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

Route::get('/test', function()
{
    return Summary::with('segment')->where('board_id',Input::get('id'))
                                    ->orderBy('created_at','desc')
                                    ->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = CURDATE()")
                                    ->get();
});

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
    Route::get('/', 'HomeController@analytic');

    // Pagina de resumenes
    Route::get('/summaries', 'HomeController@summaries');

    // Carga de configuracion de tablero seleccionado
    Route::post('/loadboardconfig', 'BoardController@loadBoardConfig');

    // Carga de notas del tablero seleccionado
    Route::post('/loadboardnotes', 'BoardController@loadBoardNotes');

    // Obtenemos el contador de las notas del tablero seleccionado
    Route::post('/countnotes', 'BoardController@countBoardNotes');

    // Carga de notas del tablero seleccionado
    Route::post('/loadmenuitemdnotes', 'BoardController@loadBoardsByMenuItem');

    // Carga de segmentos
    Route::post('/loadsegments', 'BoardController@loadSegments');

    // Se guarda el resumen
    Route::post('/savesummary', 'BoardController@saveSummary');

    // Se guarda el resumen
    Route::post('/loadsummary', 'BoardController@loadSummary');

    // Se guarda el resumen
    Route::post('/loadsummaries', 'BoardController@loadSummaries');

    // Actualiza el sumario
    Route::post('/updatesummary', 'BoardController@updateSummary');
});