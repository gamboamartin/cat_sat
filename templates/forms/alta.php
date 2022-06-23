<?php /** @var controllers\base\system $controlador */ ?>
<div class="widget  widget-box box-container form-main widget-form-cart" id="form">

    <?php include "templates/head/subtitulo.php"; ?>
    <?php include "templates/mensajes.php"; ?>

    <form method="post" action="<?php echo $controlador->link_alta_bd; ?>" class="form-additional">
        <?php include $controlador->include_inputs_alta; ?>
    </form>
</div>
