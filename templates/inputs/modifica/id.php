<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>
<div class="control-group col-sm-4">
    <label class="control-label" for="id">Id</label>
    <div class="controls">
        <input type="text" name="id" value="<?php echo $controlador->row_upd->id; ?>" class="form-control" id="id" placeholder="Id" />
    </div>
</div>
