let sl_cat_sat_division_producto = $("#cat_sat_division_producto_id");
let input = $("#codigo");

let selected = sl_cat_sat_division_producto.find('option:selected');
let codigo = selected.data(`cat_sat_division_producto_codigo`);

var mask = IMask(
    document.getElementById('codigo'),
    {
        mask: `${codigo}00`,
        lazy: false,
    }
);



