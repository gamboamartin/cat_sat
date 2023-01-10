let sl_cat_sat_division_producto = $("#cat_sat_division_producto_id");
let input = $("#codigo");

let division = sl_cat_sat_division_producto.find('option:selected');
let codigo_division = division.data(`cat_sat_division_producto_codigo`);

var mask = IMask(
    document.getElementById('codigo'),
    {
        mask: `${codigo_division}00`,
        lazy: false,
    }
);



