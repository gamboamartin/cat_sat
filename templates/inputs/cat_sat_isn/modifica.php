<?php /** @var  \gamboamartin\cat_sat\controllers\controlador_cat_sat_isn $controlador  $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->id; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->codigo_bis; ?>
<?php echo $controlador->inputs->descripcion; ?>
<?php echo $controlador->inputs->alias; ?>
<?php echo $controlador->inputs->descripcion_select; ?>
<?php echo $controlador->inputs->select->dp_estado_id; ?>
<?php echo $controlador->inputs->porcentaje; ?>
<?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>