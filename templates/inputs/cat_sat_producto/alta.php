<?php /** @var controllers\controlador_cat_sat_producto $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->cat_sat_tipo_producto_id; ?>
<?php echo $controlador->inputs->cat_sat_division_producto_id; ?>
<?php echo $controlador->inputs->cat_sat_grupo_producto_id; ?>
<?php echo $controlador->inputs->cat_sat_clase_producto_id; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->descripcion; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>

