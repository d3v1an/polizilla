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
			$menu_items 		= $board->menus()->with(array('items'=>function($query){ $query->where('type','sql')->where('query','!=','N/A')->where('query','!=',''); }))->where('position','=','left')->first();

			foreach ($menu_items->items as $item) {
				if(!empty($item->query_count) && $item->query_count!='') {
	        		$_count_notes = DB::select( DB::raw( $item->query_count ) );
		        	$item->count_notes = $_count_notes[0]->Total;
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

	// Cuenta las notas de las pestañas
	public function countBoardNotes()
	{
		try {
			
			if(Input::get('type')=='board')
			{
				$board = Board::find(Input::get('id'));

				if(!$board) return Response::json(array('status'=>false,'message'=>'No pudo ser localizado el tablero'),200);

				// Obtenemos el tipo de query a ejecutar
			    $main_query 	= $board->queries->query;
			    $estados_query 	= $board->queries->query_estados;
			    $revistas_query = $board->queries->query_revistas;
			    $web_query 		= $board->queries->query_web;

			} else {

				$board = MenuItem::find(Input::get('id'));

				if(!$board) return Response::json(array('status'=>false,'message'=>'No pudo ser localizado el tablero'),200);

				// Obtenemos el tipo de query a ejecutar
			    $main_query 	= $board->query;
			    $estados_query 	= $board->query_estados;
			    $revistas_query = $board->query_revistas;
			    $web_query 		= $board->query_web;
			}

			// Si el query esta limpio no mandamos mensaje de no disponivilidad
		    if(
		    	(empty($main_query) || $main_query=='') ||
		    	(empty($estados_query) || $estados_query=='') ||
		    	(empty($revistas_query) || $revistas_query=='') ||
		    	(empty($web_query) || $web_query=='')
		    	) {
		    	return Response::json(array('status'=>false,'message'=>'No hay datos disponibles para estas consultas'),200);
		    }

		    // Main counter
		    $main_cq 		= DB::select( DB::raw( $main_query ) );
		    $estados_cq 	= DB::select( DB::raw( $estados_query ) );
		    $revistas_cq 	= DB::select( DB::raw( $revistas_query ) );
		    $web_cq 		= DB::select( DB::raw( $web_query ) );

		    return Response::json(array('status'=>true,'message'=>'Contadores de tableros','main'=>count($main_cq),'estados'=>count($estados_cq),'revistas'=>count($revistas_cq),'web'=>count($web_cq)),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'Ocurrio un erro al obtener la informacion de los contadores','exception'=>$e->getMessage()),200);
		}
	}

	// Obtenemos los tableros iniciales
	public function loadBoardsByMenuItem()
	{

		try {

			$id 			= Input::get('id');
			$user_query 	= Input::has('query') ? Input::get('query') : 'query';
			$menuItem 		= MenuItem::find($id);

			if(!$menuItem) return Response::json(array('status'=>false,'message'=>"No se pudo localizar el item de menu seleccionado"),200);

			// Checksum del query
		    $_query 		= $menuItem->query;

		    // Obtenemos el tipo de query a ejecutar
		    if($user_query=='query') $_query = $menuItem->query;
		    elseif ($user_query=='query_estados') $_query = $menuItem->query_estados;
		    elseif ($user_query=='query_revistas') $_query = $menuItem->query_revistas;
		    elseif ($user_query=='query_web') $_query = $menuItem->query_web;

		    if($_query=='') return Response::json(array('status'=>false,'message'=>"No hay consulta disponible para esta opcion"),200);

	   		$notes = DB::select( DB::raw( $_query) );

	    	if(count($notes)<1) return Response::json(array('status'=>false,'message'=>"No hay datos disponibles para esta consulta"),200);

	    	// Obtenemos los id's de los tags
	    	$tags 			= array();

	    	// Creterio para remplaso
			$original 		= array();
			$idTags 		= array();

			if($menuItem->tags()->count()>0) {
				
				foreach ($menuItem->tags()->get() as $tag) {
					array_push($original, $tag->tag);
					array_push($idTags,$tag->id);
				}

				$tags = $idTags;

			}

			foreach ($notes as $note) {

				if(count($original)>0) {
					foreach ($original as $t) {
						if(trim($t)!='') $note->Texto = preg_replace("/".$t."/i", "<mark>".$t."</mark>", $note->Texto);
					}
				}

				$note->Fecha = esDateTime(strtotime($note->Fecha));
			}

			return Response::json(array('status'=>true,'message'=>'El tablero si contiene notas para mostrar','notes'=>$notes,'tags'=>$tags),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>"Ocurrio un erro al intentar obtener la informacion del menu",'exception'=>$e->getMessage()),200);
		}

	}

	// Funcion para lectura de segmentos
	public function loadSegments()
	{
		try {
			
			$segments = Segment::where('board_id',Input::get('id'))->get();

			if(!$segments) return Response::json(array('status'=>false,'message'=>'No hay segmentos disponibles para este tablero'),200);

			return Response::json(array('status'=>true,'message'=>'Segmentos localizados','segments'=>$segments),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'Ocurrio un problema con la lectutra de segmentos','exception'=>$e->getMessage()),200);
		}
	}

	// Funcion para guardar un resumen
	public function saveSummary()
	{
		try {
			
			$summary = new Summary();

			$summary->title 				= Input::get('title');
			$summary->summary 				= Input::get('summary');
			$summary->sources 				= Input::get('source');
			$summary->board_id 				= Input::get('board_id');
			$summary->summary_segment_id	= Input::get('segment');

			if(!$summary->save()) return Response::json(array('status'=>false,'message'=>'No pude ser guardado el resumen'),200);

			$summary->notes()->attach(explode(',', Input::get('ids')));

			return Response::json(array('status'=>true,'message'=>'Resumen guadado.'),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'No pude ser guardado el resumen','exception'=>$e->getMessage()),200);			
		}
	}

	// Carga los resumenes del dia
	public function loadSummary()
	{
		try {
			
			$summaries = Summary::with('segment')->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = '".date("Y-m-d")."'")->get();

			if(count($summaries)<1) return Response::json(array('status'=>false,'message'=>'No se enontraron resumenes recientes'),200);

			return Response::json(array('status'=>true,'message'=>'Resumenes encontrados','summaries'=>$summaries),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'Ocurrio un problema al buscar los resumenes','exception'=>$e->getMessage()),200);
		}
	}

	// Carga de sumarios
	public function loadSummaries()
	{

		try {
			
			$summaries = Summary::with('segment')->where('board_id',Input::get('id'))->get();

			if(count($summaries)<1) return Response::json(array('status'=>false,'message'=>'No se encontraron resumenes para cargar'),200);

			return Response::json(array('status'=>true,'message'=>'Se localizaron resumenes','summaries'=>$summaries),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'Ocurrio un problema al cargar los resumenes','exception'=>$e->getMessage()),200);
		}
	}

	// Actualizacion de estatus de resuen
	public function updateSummary()
	{

		try {
			
			$summary = Summary::find(Input::get('id'));

			if(!$summary) return Response::json(array('status'=>false,'message'=>'No se encontro el resumen seleccionado'),200);

			$summary->enabled = Input::get('status');

			if(!$summary->save()) return Response::json(array('status'=>false,'message'=>'El resumen no pudo ser actualizado'),200);

			return Response::json(array('status'=>true,'message'=>'Resumen actualizado'),200);

		} catch (Exception $e) {
			return Response::json(array('status'=>false,'message'=>'El resumen no pudo ser actualizado'),200);			
		}
	}

}