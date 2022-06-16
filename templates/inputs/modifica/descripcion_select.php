<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>
<div class="control-group col-sm-6">
    <label class="control-label" for="descripcion_select">Descripcion select</label>
    <div class="controls">
        <input type="text" name="descripcion_select" value="<?php echo $controlador->row_upd->descripcion_select; ?>" class="form-control" id="descripcion_select" placeholder="Descripcion select" />
    </div>
</div>
