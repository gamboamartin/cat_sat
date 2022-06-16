<?php /** @var controllers\controlador_cat_sat_tipo_persona $controlador */ ?>
<?php use links\links_menu; ?>
<a href="<?php echo (new links_menu($controlador->registro_id))->links->cat_sat_tipo_persona->elimina_bd ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="icon-remove"></i> Elimina</a>