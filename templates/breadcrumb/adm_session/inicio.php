<?php /** @var controllers\controlador_adm_session $controlador */ ?>
<?php use links\links_menu; ?>
<li class="item"><a href="<?php echo (new links_menu($controlador->registro_id))->links->adm_session->inicio ?>"> Inicio </a></li>
