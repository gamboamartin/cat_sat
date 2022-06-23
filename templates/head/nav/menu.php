<?php use config\generales;
use html\directivas; ?>
<div class="pull-left menu">
    <?php include (new generales())->path_base.'templates/head/nav/_menu_responsive.php'?>

    <nav class="navbar text-color-primary">
        <?php include (new generales())->path_base.'templates/head/nav/_sombra_menu.php'?>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav clearfix">
                <?php echo (new directivas())->lis_menu_principal(); ?>
            </ul>
        </div>
    </nav>

</div>
