<?php /** @var stdClass $cat_sat_tipo_persona  viene de registros del controler*/ ?>
<tr>
    <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_id; ?></td>
    <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_codigo; ?></td>
    <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_codigo_bis; ?></td>
    <!-- Dynamic generated -->
    <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_descripcion; ?></td>
    <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_descripcion_select; ?></td>
    <td><?php echo $cat_sat_tipo_persona->cat_sat_tipo_persona_alias; ?></td>
    <td>Valida persona fisica</td>
    <!-- End dynamic generated -->

    <?php include 'templates/listas/cat_sat_tipo_persona/action_row.php';?>
</tr>
