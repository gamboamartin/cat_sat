let sl_cat_sat_division_producto = $("#cat_sat_division_producto_id");

let division = sl_cat_sat_division_producto.find('option:selected');
let codigo_division = division.data(`cat_sat_division_producto_codigo`);

var mask = IMask(
    document.getElementById('codigo'),
    {
        mask: `${codigo_division}00`,
        lazy: false,
        placeholderChar: '#',
        normalizeZeros: true
    }
);

mask.value = `${codigo_division}`;

mask.on("complete", function () {
    let next = mask.value.substring(2, mask.value.length)
    mask.value  = `${codigo_division}${next}`
});



$( ".form-additional" ).validate({
    errorLabelContainer: $("div.error"),
    submitHandler: function(form) {
        form.submit();
    },
    rules: {
        codigo: {
            required: true,
            digits: true
        },
        descripcion: {
            required: true,
        }
    },
    messages: {
        codigo: "* Ingrese un código valido",
        descripcion: "* Ingrese una descripción valida"
    }
});



