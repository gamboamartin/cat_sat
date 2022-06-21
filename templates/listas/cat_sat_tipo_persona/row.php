<?php /** @var stdClass $row  viene de registros del controler*/ ?>
<tr>
    <td><?php echo $row->cat_sat_tipo_persona_id; ?></td>
    <td><?php echo $row->cat_sat_tipo_persona_codigo; ?></td>
    <td><?php echo $row->cat_sat_tipo_persona_codigo_bis; ?></td>
    <!-- Dynamic generated -->
    <td><?php echo $row->cat_sat_tipo_persona_descripcion; ?></td>
    <td><?php echo $row->cat_sat_tipo_persona_descripcion_select; ?></td>
    <td><?php echo $row->cat_sat_tipo_persona_alias; ?></td>
    <td>Valida persona fisica</td>
    <!-- End dynamic generated -->

    <?php include 'templates/listas/base/action_row.php';?>
</tr>
