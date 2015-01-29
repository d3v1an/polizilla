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
@stop