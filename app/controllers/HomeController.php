<?php

class HomeController extends BaseController {

	// Panel Principal
	public function analytic()
	{
		if( Auth::user()->role <= 5 ) {
			return View::make('main.panel');
		} else if ( Auth::user()->role == 6 ) {
			return View::make('main.panel_design');
		}
	}

	// Panel de resumenes
	public function summaries()
	{
		if( Auth::user()->role <= 5 ) {
			return View::make('main.panel_resumen');
		}
	}

}
