<?php /** @var controllers\base\system $controlador  viene de registros del controler/lista */ ?>
<table class="table table-striped footable-sort" data-sorting="true">
    <?php include "templates/listas/$controlador->seccion/th.php";?>
    <?php include 'templates/listas/base/rows.php';?>
</table>
