<?php

class HomeController extends BaseController {

	// Panel Principal
	public function analytic()
	{
		return View::make('main.panel');
	}

	// Panel de resumenes
	public function summaries()
	{
		return View::make('main.panelb');
	}

}
