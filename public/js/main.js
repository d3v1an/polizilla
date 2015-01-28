$(function() {

	// Boton para cargar la informacion del tablero seleccionado
	$(".btn-board").click(function(e){

		var board_id = $(this).data('board');

		$.loadBoardConfig(board_id);	

		e.preventDefault();
	});

	// Funcion para carga de tableros
	$.loadBoardConfig = function(board_id) {

		$('.menu-items').html('').addClass('text-center').html('<i class="fa fa-spinner fa-spin"></i> Cargando personajes...');

		$.d3POST(base_path+'/analytic/loadboardconfig',{id:board_id},function(data){
			console.log(data);

			if(data.status==true) {

				$(".main-character").html('').html(data.board.title);

				if(data.menu_items.items.length>0) {

					var _char_link = '';

					$.each(data.menu_items.items,function(i, item){
						_char_link += '<a class="btn btn-primary btn-xs margin-bottom btn-char-item" id="bci-'+item.id+'" data-id="'+item.id+'" data-count="'+item.count_notes+'">('+item.count_notes+') '+item.text+'</a> ';
					});

					$('.menu-items').html('').removeClass('text-center').append(_char_link);

					$(".btn-char-item").on('click',function(){
						console.log($(this).data('id'));
					});
				} else {

					$('.menu-items').html('').html('No hay personajes para cargar.');

				}

			} else {
				alert(data.message);
				return false;
			}

		});
	};

	// Funcion para cargar

	// Carga por defecto de informacion de tablero
	$.loadBoardConfig(default_board);

});