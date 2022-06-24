<?php use config\generales;
use links\links_menu; ?>
<div class="pull-left menu">
    <?php include (new generales())->path_base.'templates/head/nav/_menu_responsive.php'?>

    <nav class="navbar text-color-primary">
        <?php include (new generales())->path_base.'templates/head/nav/_sombra_menu.php'?>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav clearfix">
                <?php echo (new links_menu(registro_id:-1))->lis_menu_principal(); ?>
            </ul>
        </div>
    </nav>

</div>
