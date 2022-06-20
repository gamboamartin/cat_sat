<?php /** @var stdClass $cat_sat_tipo_persona  Registro de tipo cat sat tipo persona */ ?>
<?php use links\links_menu; ?>
<a href="<?php echo (new links_menu($cat_sat_tipo_persona->cat_sat_tipo_persona_id))->links->cat_sat_tipo_persona->elimina_bd ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="icon-remove"></i> Elimina</a>