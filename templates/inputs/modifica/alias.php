<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>
<div class="control-group col-sm-6">
    <label class="control-label" for="alias">Alias</label>
    <div class="controls">
        <input type="text" name="alias" value="<?php echo $controlador->row_upd->alias; ?>" class="form-control" id="alias" placeholder="Alias" />
    </div>
</div>
