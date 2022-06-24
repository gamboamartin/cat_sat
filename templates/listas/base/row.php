<?php /** @var controllers\base\system $controlador  controlador en ejecucion */ ?>
<tr>
    <?php foreach ($controlador->keys_row_lista as $campo){ ?>
    <?php include 'templates/listas/base/td.php';?>
    <?php } ?>
    <!-- End dynamic generated -->

    <?php include 'templates/listas/base/action_row.php';?>
</tr>
