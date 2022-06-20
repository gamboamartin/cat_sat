<?php /** @var controllers\controlador_cat_sat_tipo_persona $controlador */ ?>
<main class="main section-color-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="top-title">
                    <ul class="breadcrumb">
                        <?php include "templates/breadcrumb/adm_session/inicio.php"; ?>
                        <?php include "templates/breadcrumb/cat_sat_tipo_persona/alta.php"; ?>
                        <li class="item"> Lista </li>
                    </ul>
                    <h1 class="h-side-title page-title page-title-big text-color-primary">TIPO PERSONA</h1>
                </section> <!-- /. content-header -->
                <?php include 'templates/listas/cat_sat_tipo_persona/content.php';?>
            </div><!-- /.center-content -->
        </div>
    </div>
</main>
