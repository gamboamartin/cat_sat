let sl_cat_sat_grupo_producto = $("#cat_sat_grupo_producto_id");
let input = $("#codigo");

let grupo = sl_cat_sat_grupo_producto.find('option:selected');
let codigo_grupo = grupo.data(`cat_sat_grupo_producto_codigo`);

var mask = IMask(
    document.getElementById('codigo'),
    {
        mask: `${codigo_grupo}00`,
        lazy: false,
    }
);



