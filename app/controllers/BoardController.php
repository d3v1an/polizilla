<?php

class BoardController extends \BaseController {

	// Carga la informacion del tablero seleccionado
	public function loadBoardConfig()
	{
		$id = Input::get('id');

		try {

			//$board = Board::with('queries','tags')->find($id);
			$board = Board::find($id);

			if(!$board) return Response::json(array('status'=>false,'message'=>'El tablero no existe'),200);

			// Menu items
			$menu_items 		= $board->menus()->with(array('items'=>function($query){ $query->where('type','sql')->where('query','!=','N/A'); }))->where('position','=','left')->first();

			foreach ($menu_items->items as $item) {
				if(!empty($item->query_count) && $item->query_count!='') {
	        		$_count_notes = DB::select( DB::raw( $item->query_count ) );
		        	$item->count_notes = isset($_count_notes[0]->Total) ? $_count_notes[0]->Total : 666;
		        } else  $item->count_notes = 0;
			}

			return Response::json(array('status'=>true,'message'=>'Tablero localizado','board'=>$board,'menu_items'=>$menu_items),200);
			
		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'Ocurrio un problema al cargar la informacion del tablero','Exception'=>$e->getMessage()),200);
		}

	}

}