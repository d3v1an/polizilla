$(function() {

	// Funcion para cargar notas iniciales
	$.loadCurrentSummary = function(b) {

		$('.resumen-list').html('').addClass('text-center').html('<i class="fa fa-spinner fa-spin"></i> Cargando resumenes...');

		$.d3POST(base_path+'/analytic/loadsummary',{},function(data){
			console.log(data);
			$.dataFill(data);
		});
	};

	// Data fill
	$.dataFill = function(data) {

		if(data.status==true) {
				
			if(data.summaries.length>0) {

				$('.resumen-list').html('').removeClass('text-center');

				$.each(data.summaries,function(index,summary) {

					var _sumary = '<div class="panel box box-default" id="return_'+summary.id+'">'+
                                    '<div class="box-header">'+
                                        '<div class="board-box">'+
                                            '<a data-toggle="collapse" data-parent="#accordion_periodicos" href="#collapse_item_'+summary.id+'">'+
                                                '<span class="header-board">'+summary.title+'</span>'+
                                                '<p><span>Segmento : <span class="label label-danger">'+summary.segment.name+'</span></span> | <span>Fecha : '+summary.created_at+'</span></p>' +
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div id="collapse_item_'+summary.id+'" class="panel-collapse collapse">'+
                                        '<div class="box-body">'+
                                            '<div class="panel panel-default">'+
                                              '<div class="panel-body">'+
                                              	'<p>'+summary.summary+'</p>' +
                                              	'<p>Fuente : <small>'+summary.sources+'</small></p>' +
                                              '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';

                    $('.resumen-list').append(_sumary);

				});

			}

		} else {
			$('.resumen-list').html('').addClass('text-center').html(data.message);
			return false;
		}
	};

	// Carga por defecto de notas existentes
	$.loadCurrentSummary();

});