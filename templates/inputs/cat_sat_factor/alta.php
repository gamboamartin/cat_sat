<?php /** @var  \gamboamartin\cat_sat\controllers\controlador_cat_sat_factor $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->factor; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd.php';?>