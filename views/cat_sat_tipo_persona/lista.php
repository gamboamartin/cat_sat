<?php /** @var controllers\controlador_cat_sat_tipo_persona $controlador */ ?>
<?php use links\links_menu; ?>
<main class="main section-color-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="top-title">
                    <ul class="breadcrumb">
                        <li class="item"><a href="<?php echo (new links_menu())->links->adm_session ?>"> Inicio </a></li>
                        <li class="item"> Lista </li>
                    </ul>
                    <h1 class="h-side-title page-title page-title-big text-color-primary">TIPO PERSONA</h1>
                </section> <!-- /. content-header -->
                <div class="widget widget-box box-container widget-mylistings">
                    <?php include 'templates/etiquetas/_titulo_lista.php';?>
                    <div class="">
                        <table class="table table-striped footable-sort" data-sorting="true">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>Codigo Bis</th>
                                <!-- Dynamic generated -->
                                <th data-breakpoints="xs sm md"  data-type="html">Descripcion</th>
                                <th data-breakpoints="xs sm md"  data-type="html">Descripcion select</th>
                                <th data-breakpoints="xs sm md"  data-type="html">Alias</th>
                                <th data-breakpoints="xs sm md"  data-type="html">Valida persona fisica</th>
                                <!-- End dynamic generated -->
                                <th data-hide="phone" class="control"  data-type="html">Modifica</th>
                                <th data-breakpoints="xs md" class="control"  data-type="html">Elimina</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($controlador->registros as $cat_sat_tipo_persona){?>
                            <tr>

                                <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_id; ?></td>
                                <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_codigo; ?></td>
                                <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_codigo_bis; ?></td>
                                <!-- Dynamic generated -->
                                <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_descripcion; ?></td>
                                <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_descripcion_select; ?></td>
                                <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_alias; ?></td>
                                <td>Valida persona fisica</td>
                                <!-- End dynamic generated -->

                                <td><a href="#" class="btn btn-info"><i class="icon-edit"></i> Modifica</a></td>
                                <td><a href="#" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="icon-remove"></i> Elimina</a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php include 'templates/etiquetas/_footer_lista.php';?>
                    </div>
                </div> <!-- /. widget-table-->
            </div><!-- /.center-content -->
        </div>
    </div>
</main>
