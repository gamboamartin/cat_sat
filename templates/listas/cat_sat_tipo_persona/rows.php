<?php /** @var controllers\controlador_cat_sat_tipo_persona $controlador  viene de registros del controler/lista */ ?>
<tbody>
<?php foreach ($controlador->registros as $cat_sat_tipo_persona){?>
    <?php include 'templates/listas/cat_sat_tipo_persona/row.php';?>
<?php } ?>
</tbody>
