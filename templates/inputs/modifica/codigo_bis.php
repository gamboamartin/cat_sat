<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>
<div class="control-group col-sm-4">
    <label class="control-label" for="codigo_bis">Codigo BIS</label>
    <div class="controls">
        <input type="text" name="codigo_bis" value="<?php echo $controlador->row_upd->codigo_bis; ?>" class="form-control" id="codigo_bis" placeholder="Codigo BIS" />
    </div>
</div>
