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

	// Funcion para cargar notas iniciales
	$.loadBoardNotes = function(board_id,tab) {

		$('.accordion-result').html('').addClass('text-center').html('<i class="fa fa-spinner fa-spin"></i> Cargando notas...');
		
		$.d3POST(base_path+'/analytic/loadboardnotes',{id:board_id,query:tab},function(data){
			console.log(data);

			if(data.status==true) {
				
				if(data.notes.length>0) {

					$('.accordion-result').html('').removeClass('text-center');

					$.each(data.notes,function(index,note) {

						var _note = '<div class="panel box box-default" id="return_'+note.idEditorial+'">'+
                                        '<div class="box-header">'+
                                            '<div class="board-box">'+
                                                '<div class="board-check pull-left"><input type="checkbox" class="minimal" name="board_note[]" data-id="'+note.idEditorial+'"></div>'+
                                                '<a data-toggle="collapse" data-parent="#accordion_periodicos" href="#collapse_item_'+note.idEditorial+'">'+
                                                    /*'<span class="label label-default pull-right">Neutral</span>'+*/
                                                    '<div class="board-image pull-left"><img src="'+base_path+'/img/portadas/thumbs/thumb-'+note.idPeriodico+'.jpg" alt="" class="img-thumbnail" width="100px" height="100px" data-thumb-id="'+note.idEditorial+'"></div>'+
                                                    '<span class="header-board" data-title-id="'+note.idEditorial+'">'+(note.Titulo.length>160?note.Titulo.substring(0,160)+'...':note.Titulo)+'</span>'+
                                                    '<p><span data-news-id="'+note.idEditorial+'">'+note.Periodico+'</span> | <span data-state-id="'+note.idEditorial+'">'+note.estado+'</span> <span class="time"><i class="fa fa-clock-o"></i> <span data-date-id="'+note.idEditorial+'">'+note.Fecha+' ' +note.Hora+ '</span></span></p>'+
                                                    '<h3 class="panel-title pull-left">'+
                                                        '<ul class="list-inline board-list-text">'+
                                                            '<li><span class="label label-danger" data-page-id="'+note.idEditorial+'">Pagina : '+note.PaginaPeriodico+'</span></li>'+
                                                            '<li><span class="label label-danger" data-section-id="'+note.idEditorial+'">Seccion : '+note.seccion+'</span></li>'+
                                                            '<li><span class="label label-danger" data-category-id="'+note.idEditorial+'">Categoria : '+note.Categoria+'</span></li>'+
                                                            '<li><span class="label label-danger" data-autor-id="'+note.idEditorial+'">Autor : '+note.Autor+'</span></li>'+
                                                        '</ul>'+
                                                    '</h3>'+
                                                '</a>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div id="collapse_item_'+note.idEditorial+'" class="panel-collapse collapse">'+
                                            '<div class="box-body">'+
                                                '<div class="panel panel-default">'+
                                                  '<div class="panel-heading clearfix">'+
                                                    '<div class="btn-group pull-right">'+

                                                        (note.cutted==1 ? '<button data-return="#return_'+note.idEditorial+'" class="btn btn-default btn-sm board-deploy-cut" data-id="'+note.idEditorial+'" data-type="cut"><i class="fa fa-scissors"></i> <i class="fa fa-file-pdf-o"></i> Recorte</button>' : '') +

                                                        (note.pdf.indexOf('.pdf')>=0 ? '<button data-return="#return_'+note.idEditorial+'" class="btn btn-default btn-sm board-deploy-object" data-url="'+base_path+note.pdf+'.jpg" data-type="image" data-doc-img-id="'+note.idEditorial+'"><i class="fa fa-file-image-o" ></i> Imagen</button>' + '<button data-return="#return_'+note.idEditorial+'" class="btn btn-default btn-sm board-deploy-object" data-url="'+base_path+note.pdf+'" data-type="pdf" data-doc-pdf-id="'+note.idEditorial+'"><i class="fa fa-file-pdf-o"></i> PDF</button>' + '<button data-return="#return_'+note.idEditorial+'" class="btn btn-default btn-sm board-deploy-link-pdf" data-url="'+base_path+note.pdf+'" data-type="image"><i class="fa fa-file-pdf-o"></i> Link de PDF</button>' : '<button data-return="#return_'+note.idEditorial+'" class="btn btn-default btn-sm board-deploy-link-ext" data-url="'+note.Encabezado+'" data-type="elink"><i class="fa fa-file-pdf-o"></i> Link de nota</button>') +

                                                        '<button class="btn btn-default btn-sm board-deploy-email" data-id="'+note.idEditorial+'" data-type="email"><i class="fa fa-envelope-o"></i> Email</button>' +

                                                    '</div>'+
                                                  '</div>'+
                                                  '<div class="panel-body">'+
                                                    (note.Encabezado.trim()!="" && note.Encabezado.trim().substring(0, 4)!='http' ? '<h3 class="box-title">'+note.Encabezado+'</h3>' : '') +
                                                    '<p class="text-justify" data-note-id="'+note.idEditorial+'">'+note.Texto+'</p>'+
                                                  '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';

                        $('.accordion-result').append(_note);

					});
				}

			} else {
				alert(data.message);
				return false;
			}

		});

	};

	// Carga por defecto de informacion de tablero
	$.loadBoardConfig(default_board);

	// Carga por defecto de notas existentes
	$.loadBoardNotes(default_board,current_tab);

});