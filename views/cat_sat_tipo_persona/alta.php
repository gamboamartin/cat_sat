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
                        <h2>Alta</h2>
                    </div>
                    <?php  echo $controlador->mensaje_exito; ?>
                    <?php  echo $controlador->mensaje_warning; ?>
                    <form method="post" action="<?php echo (new links_menu($controlador->registro_id))->links->cat_sat_tipo_persona->alta_bd ?>" class="form-additional">


                        <?php include "templates/inputs/alta/codigo.php"; ?>
                        <?php include "templates/inputs/alta/codigo_bis.php"; ?>
                        <?php include "templates/inputs/alta/descripcion.php"; ?>
                        <?php include "templates/inputs/alta/alias.php"; ?>
                        <?php include "templates/inputs/alta/descripcion_select.php"; ?>
                        <?php include "templates/botons/submit/alta_bd_otro.php"; ?>

                    </form>
                </div>
            </div><!-- /.center-content -->
        </div>
    </div>
</main>
