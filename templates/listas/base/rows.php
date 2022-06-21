<?php /** @var controllers\base\system $controlador  viene de registros del controler/lista */ ?>
<tbody>
<?php foreach ($controlador->registros as $row){?>
    <?php include "templates/listas/$controlador->seccion/row.php";?>
<?php } ?>
</tbody>