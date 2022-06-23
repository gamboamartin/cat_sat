<?php /** @var controllers\controlador_cat_sat_tipo_persona $controlador */ ?>
<div class="widget  widget-box box-container form-main widget-form-cart" id="form">
    <div class="widget-header">
        <h2>Modifica</h2>
    </div>
    <?php include "templates/mensajes.php"; ?>
    <form method="post" action="<?php echo$controlador->link_modifica_bd; ?>" class="form-additional">
        <?php include $controlador->include_inputs_modifica; ?>
    </form>
</div>