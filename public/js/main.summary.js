$(function() {

	var currentTab = "#periodicos";

	// Boton para cargar la informacion del tablero seleccionado
	$(".btn-board").click(function(e){

		var board_id 	= $(this).data('board');

		default_board 	= board_id;

		$.loadSummary(default_board);

		e.preventDefault();
	});

	$.loadSummary = function(board_id) {

		$.d3POST(base_path+'/analytic/loadsummaries',{id:board_id},function(data){
			$.dataFill(data);
		});
	};

	// Carga de resumenes
	$.loadSummary(default_board);

	// Data fill
	$.dataFill = function(data) {

		if(data.status==true) {
				
			if(data.summaries.length>0) {

				$('.resumen-list').html('').addClass('text-center').html('<i class="fa fa-spinner fa-spin"></i> Cargando resumenes...');

				var _sumary = '';

				$.each(data.summaries,function(index,summary) {

					_sumary += '<div class="panel box box-default" id="return_'+summary.id+'">'+
                                    '<div class="box-header">'+
                                        '<div class="board-box">'+
                                            '<a data-toggle="collapse" data-parent="#accordion_periodicos" href="#collapse_item_'+summary.id+'">'+
                                                '<span class="header-board">'+summary.title+'</span>'+
                                                '<p>' +
                                                	'<span>Estatus : <span class="label label-'+(summary.enabled==1?'success':'danger')+'" id="status_'+summary.id+'">'+(summary.enabled==1?'Libre':'Tomada')+'</span></span> | '+
                                                	'<span>Segmento : <span class="label label-primary">'+summary.segment.name+'</span></span> | '+
                                                	'<span>Fecha : '+summary.created_at+'</span>'+
                                                '</p>' +
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div id="collapse_item_'+summary.id+'" class="panel-collapse collapse">'+
                                        '<div class="box-body">'+
                                            '<div class="panel panel-default">'+
                                              '<div class="panel-heading clearfix">'+
                                                '<div class="btn-group">'+
													'<a class="btn btn-default btn-sm summary-deploy-object" data-id="'+summary.id+'" data-status="'+(summary.enabled==1?'free':'taked')+'">Tomar</a>' +
                                                '</div>'+
                                              '</div>'+
                                              '<div class="panel-body">'+
                                              	'<p>'+summary.summary+'</p>' +
                                              	'<p>Fuente : <small>'+summary.sources+'</small></p>' +
                                              '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';

				});

				$('.resumen-list').html('').removeClass('text-center').append(_sumary);

				$("a.summary-deploy-object").on('click',function(){

					var _obj_id 	= $(this).data('id');
					var _obj_status = $(this).data('status');

					if(_obj_status=='free') {
						$("span#status_"+_obj_id).removeClass('label-success').addClass('label-danger').html('').html('Tomada');
						$(this).data('status','taked');
						$.updateStatus(_obj_id,0);
					} else {
						$("span#status_"+_obj_id).removeClass('label-danger').addClass('label-success').html('').html('Libre');
						$(this).data('status','free');
						$.updateStatus(_obj_id,1);
					}

					console.log($(this).data('id'));
				});
			}

		} else {
			$('.resumen-list').html('').addClass('text-center').html(data.message);
			return false;
		}
	};

	$.updateStatus = function(id,status) {
		$.d3POST(base_path+'/analytic/updatesummary',{id:id,status:status},function(data){
			console.log(data);
		});
	};

});