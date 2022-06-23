<?php /** @var stdClass $row  viene de registros del controler*/ ?>
<tr>
    <td><?php echo $row->cat_sat_unidad_id; ?></td>
    <td><?php echo $row->cat_sat_unidad_codigo; ?></td>
    <td><?php echo $row->cat_sat_unidad_codigo_bis; ?></td>
    <!-- Dynamic generated -->
    <td><?php echo $row->cat_sat_unidad_descripcion; ?></td>
    <td><?php echo $row->cat_sat_unidad_descripcion_select; ?></td>
    <td><?php echo $row->cat_sat_unidad_alias; ?></td>

    <!-- End dynamic generated -->

    <?php include 'templates/listas/base/action_row.php';?>
</tr>
