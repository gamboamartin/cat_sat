<?php /** @var base\controller\controlador_base $controlador */ ?>
<?php use links\links_menu; ?>
<li class="nav-item">
    <a class="nav-link" href="<?php echo (new links_menu($controlador->registro_id))->links->cat_sat_tipo_de_comprobante->lista; ?>" role="button">Tipo de comprobante</a>
</li>