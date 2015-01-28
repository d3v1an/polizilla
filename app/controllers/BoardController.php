<?php

class BoardController extends \BaseController {

	// Carga la informacion del tablero seleccionado
	public function loadBoardConfig()
	{
		$id = Input::get('id');

		try {

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

	// Carga de notas del tablero seleccionado
	public function loadBoardNotes()
	{
		try {
			
			$board 	= Board::with('queries','tags')->find(Input::get('id'));

			if(!$board) return Response::json(array('status'=>false,'message'=>'Error en la carga de las notas del tablero seleccionado'),200);

			$_query = $board->queries->query;

			// Obtenemos el tipo de query a ejecutar
		    if (Input::get('query')=='query_estados') $_query = $board->queries->query_estados;
		    elseif (Input::get('query')=='query_revistas') $_query = $board->queries->query_revistas;
		    elseif (Input::get('query')=='query_web') $_query = $board->queries->query_web;

		    // Si el query esta limpio no mandamos mensaje de no disponivilidad
		    if(empty($_query) || $_query=='') {
		    	return Response::json(array('status'=>false,'message'=>'No hay datos disponibles para esta consulta'),200);
		    }

		    $notes 	= DB::select( DB::raw( $_query) );

		    if(count($notes)<1) return Response::json(array('status'=>false,'message'=>'No hay datos disponibles para esta consulta'),200);

		    // Obtenemos los id's de los tags
	    	$tags 			= array();

	    	// Creterio para remplaso
			$original 	= array();
			$idTags 	= array();

			if($board->tags()->count()>0) {
				
				foreach ($board->tags()->get() as $tag) {
					array_push($original, $tag->tag);
					array_push($idTags,$tag->id);
				}

	        	$tags = $idTags;
	        }

	        foreach ($notes as $note) {

				foreach ($original as $t) {
					if(trim($t)!='') $note->Texto = preg_replace("/".$t."/i", "<mark>".$t."</mark>", $note->Texto);
				}

				$note->Fecha = esDateTime(strtotime($note->Fecha));
			}

	    	return Response::json(array('status'=>true,'message'=>'El tablero si contiene notas para mostrar','notes'=>$notes,'tags'=>$tags),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>"Error en la carga de las notas del tablero seleccionado",'exception'=>$e->getMessage()),200);
		}

	}

}