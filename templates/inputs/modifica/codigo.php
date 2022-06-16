<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>
<div class="control-group col-sm-4">
    <label class="control-label" for="codigo">Codigo</label>
    <div class="controls">
        <input type="text" name="codigo" value="<?php echo $controlador->row_upd->codigo; ?>" class="form-control" id="codigo" placeholder="Codigo" />
    </div>
</div>
