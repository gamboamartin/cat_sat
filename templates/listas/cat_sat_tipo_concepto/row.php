<?php /** @var stdClass $row  viene de registros del controler*/ ?>
<tr>
    <td><?php echo $row->cat_sat_tipo_concepto_id; ?></td>
    <td><?php echo $row->cat_sat_tipo_concepto_codigo; ?></td>
    <td><?php echo $row->cat_sat_tipo_concepto_codigo_bis; ?></td>
    <!-- Dynamic generated -->
    <td><?php echo $row->cat_sat_tipo_concepto_descripcion; ?></td>
    <td><?php echo $row->cat_sat_tipo_concepto_descripcion_select; ?></td>
    <td><?php echo $row->cat_sat_tipo_concepto_alias; ?></td>

    <!-- End dynamic generated -->

    <?php include 'templates/listas/base/action_row.php';?>
</tr>
