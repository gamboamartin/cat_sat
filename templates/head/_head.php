<?php
/** @var stdClass $data Obtenido de index de la funcion data para la definicion del men  */
use config\generales;
$generales = new generales();
?>
<div class="top-box" data-toggle="sticky-onscroll">
    <div class="container">

        <?php include $generales->path_base.'templates/head/nav/_redes_sociales.php' ?>

        <section class="header-inner">
            <div class="container">
                <?php if($data->menu){ ?>
                <?php include $generales->path_base.'templates/head/nav/menu.php' ?>
                <?php } ?>
            </div>
        </section><!-- /.menu-->
    </div>
</div>
<div class="top-box-mask"></div>
