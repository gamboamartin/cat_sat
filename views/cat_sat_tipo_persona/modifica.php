<?php use links\links_menu;

include "init.php"; ?>
<?php /** @var controllers\controlador_cat_sat_tipo_persona $controlador */ ?>
<main class="main section-color-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section class="top-title">
                    <ul class="breadcrumb">
                        <?php include "templates/breadcrumb/adm_session/inicio.php"; ?>
                        <?php include "templates/breadcrumb/cat_sat_tipo_persona/lista.php"; ?>
                        <li class="item"> Modifica </li>
                    </ul>
                    <h1 class="h-side-title page-title page-title-big text-color-primary">TIPO PERSONA</h1>
                </section> <!-- /. content-header -->
                <div class="widget  widget-box box-container form-main widget-form-cart" id="form">
                    <div class="widget-header">
                        <h2>Modifica</h2>
                    </div>
                    <form method="post" action="<?php echo (new links_menu($controlador->registro_id))->links->cat_sat_tipo_persona->modifica_bd ?>" class="form-additional">

                        <?php include "templates/inputs/modifica/id.php"; ?>
                        <?php include "templates/inputs/modifica/codigo.php"; ?>
                        <?php include "templates/inputs/modifica/codigo_bis.php"; ?>
                        <?php include "templates/inputs/modifica/descripcion.php"; ?>
                        <?php include "templates/inputs/modifica/alias.php"; ?>
                        <?php include "templates/inputs/modifica/descripcion_select.php"; ?>
                        <?php include "templates/botons/cat_sat_tipo_persona/valida_persona_fisica.php"; ?>
                        <?php include "templates/botons/status.php"; ?>
                        <?php include "templates/botons/submit/modifica_bd.php"; ?>

                    </form>
                </div>
            </div><!-- /.center-content -->
        </div>
    </div>
</main>
