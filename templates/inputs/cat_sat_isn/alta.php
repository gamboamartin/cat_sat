<?php /** @var  \gamboamartin\cat_sat\controllers\controlador_cat_sat_isn $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>

<?php echo $controlador->inputs->select->dp_estado_id; ?>
<?php echo $controlador->inputs->porcentaje; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd_otro.php';?>