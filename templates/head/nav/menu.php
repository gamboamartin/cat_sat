<?php use config\generales; ?>
<div class="pull-left menu">
    <?php include (new generales())->path_base.'templates/head/nav/_menu_responsive.php'?>

    <nav class="navbar text-color-primary">
        <?php include (new generales())->path_base.'templates/head/nav/_sombra_menu.php'?>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav clearfix">
                <?php include (new generales())->path_base.'templates/head/nav/links/_tipo_persona.php'?>
                <?php include (new generales())->path_base.'templates/head/nav/links/_tipo_de_comprobante.php'?>
            </ul>
        </div>
    </nav>

</div>
