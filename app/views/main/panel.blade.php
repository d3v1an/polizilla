@extends ('layout.main')

@section ('content')
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Análisis Político
                        <strong class="main-character"></strong>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Various colors -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Personajes</h3>
                                </div>
                                <div class="box-body menu-items">
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Various colors -->
                            <div class="box">
                                <div class="box-body box-body_margin menu-option">
                                    <a class="btn btn-default" id="check_all" data-status="unchecked">
                                        <i class="fa fa-check"></i>
                                        Seleccionar todos
                                    </a> 
                                    <a class="btn btn-default" id="btn-resumen">
                                        <i class="fa fa-newspaper-o"></i>
                                        Resumen
                                    </a>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom" id="box-boards">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#periodicos" id="tab_df" data-toggle="tab">D.F.</a></li>
                                    <li><a href="#estados" id="tab_estados" data-toggle="tab">Estados</a></li>
                                    <li><a href="#revistas" id="tab_revistas" data-toggle="tab">Revistas</a></li>
                                    <li><a href="#web" id="tab_portales" data-toggle="tab">Portales</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="accordion-result"></div>
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div>
                    </div>


                </section><!-- /.content -->

                <!-- Modal -->
                <div class="modal fade" id="dialog-resument" tabindex="-1" role="dialog" aria-labelledby="dialogResumenLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="dialogResumenLabel">Resumen</h4>
                      </div>
                      <div class="modal-body">
                        <form role="form" name="form-resumen" id="form-resumens">
                            <input type="hidden" name="note-ids" id="note-ids">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" name="note-title" id="note-title">
                            </div>
                            <div class="form-group">
                            <label>Resumen</label>
                                <textarea class="form-control" rows="9" name="note-resume" id="note-resume"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Fuente(s)</label>
                                <input type="text" class="form-control" name="note-source" id="note-source">
                            </div>
                            <div class="form-group">
                                <label>Select</label>
                                <select class="form-control" name="note-segment" id="note-segment">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ID Notas</label>
                            </div>
                            <div class="form-group dialog-notes">
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn-resumen-save">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
@stop