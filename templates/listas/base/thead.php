<?php /** @var controllers\base\system $controlador  controlador en ejecucion */ ?>
<thead>
<tr>
    <?php foreach ($controlador->keys_row_lista as $campo){ ?>
        <?php include 'templates/listas/base/th.php';?>
    <?php } ?>
    <th data-breakpoints="xs md" class="control"  data-type="html">Modifica</th>
    <th data-breakpoints="xs md" class="control"  data-type="html">Elimina</th>
</tr>
</thead>

