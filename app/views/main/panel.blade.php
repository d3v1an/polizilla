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
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_df" id="tab_df" data-toggle="tab">D.F.</a></li>
                                    <li><a href="#tab_estados" id="tab_estados" data-toggle="tab">Estados</a></li>
                                    <li><a href="#tab_revistas" id="tab_revistas" data-toggle="tab">Revistas</a></li>
                                    <li><a href="#tab_portales" id="tab_portales" data-toggle="tab">Portales</a></li>
                                </ul>
                                <div class="tab-content">
                                    
                                    <div class="tab-pane active" id="tab_df">
                                        <b>How to use:</b>
                                        <p>Exactly like the original bootstrap tabs except you should use
                                            the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                                        A wonderful serenity has taken possession of my entire soul,
                                        like these sweet mornings of spring which I enjoy with my whole heart.
                                        I am alone, and feel the charm of existence in this spot,
                                        which was created for the bliss of souls like mine. I am so happy,
                                        my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                                        that I neglect my talents. I should be incapable of drawing a single stroke
                                        at the present moment; and yet I feel that I never was a greater artist than now.
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_estados">
                                        The European languages are members of the same family. Their separate existence is a myth.
                                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                        new common language would be desirable: one could refuse to pay expensive translators. To
                                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                        words. If several languages coalesce, the grammar of the resulting language is more simple
                                        and regular than that of the individual languages.
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane active" id="tab_revistas">
                                        <b>How to use:</b>
                                        <p>Exactly like the original bootstrap tabs except you should use
                                            the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                                        A wonderful serenity has taken possession of my entire soul,
                                        like these sweet mornings of spring which I enjoy with my whole heart.
                                        I am alone, and feel the charm of existence in this spot,
                                        which was created for the bliss of souls like mine. I am so happy,
                                        my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                                        that I neglect my talents. I should be incapable of drawing a single stroke
                                        at the present moment; and yet I feel that I never was a greater artist than now.
                                    </div><!-- /.tab-pane -->

                                    <div class="tab-pane" id="tab_portales">
                                        The European languages are members of the same family. Their separate existence is a myth.
                                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                        new common language would be desirable: one could refuse to pay expensive translators. To
                                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                        words. If several languages coalesce, the grammar of the resulting language is more simple
                                        and regular than that of the individual languages.
                                    </div><!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div>
                    </div>


                </section><!-- /.content -->
@stop