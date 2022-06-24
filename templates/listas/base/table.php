<?php /** @var controllers\base\system $controlador  viene de registros del controler/lista */ ?>
<table class="table table-striped footable-sort" data-sorting="true">
    <?php include $controlador->include_lista_thead;?>
    <?php include 'templates/listas/base/rows.php';?>
</table>
