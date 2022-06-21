<?php /** @var stdClass $row  viene de registros del controler*/ ?>
<tr>
    <td><?php echo $row->cat_sat_tipo_de_comprobante_id; ?></td>
    <td><?php echo $row->cat_sat_tipo_de_comprobante_codigo; ?></td>
    <td><?php echo $row->cat_sat_tipo_de_comprobante_codigo_bis; ?></td>
    <!-- Dynamic generated -->
    <td><?php echo $row->cat_sat_tipo_de_comprobante_descripcion; ?></td>
    <td><?php echo $row->cat_sat_tipo_de_comprobante_descripcion_select; ?></td>
    <td><?php echo $row->cat_sat_tipo_de_comprobante_alias; ?></td>
    <td>Valida persona fisica</td>
    <!-- End dynamic generated -->

    <?php include 'templates/listas/base/action_row.php';?>
</tr>
