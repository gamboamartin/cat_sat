<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>
<div class="control-group col-sm-12">
    <label class="control-label" for="descripcion">Descripcion</label>
    <div class="controls">
        <input type="text" name="descripcion" value="<?php echo $controlador->row_upd->descripcion; ?>" class="form-control" id="descripcion" placeholder="Descripcion" />
    </div>
</div>
