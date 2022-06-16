<?php /** @var stdClass $cat_sat_tipo_persona  Registro de tipo cat sat tipo persona */ ?>
<?php use links\links_menu; ?>
<a href="<?php echo (new links_menu($cat_sat_tipo_persona->cat_sat_tipo_persona_id))->links->cat_sat_tipo_persona->modifica ?>"
   class="btn btn-info"><i class="icon-edit"></i>
    Modifica
</a>