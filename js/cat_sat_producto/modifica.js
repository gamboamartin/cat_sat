let sl_cat_sat_tipo_producto = $("#cat_sat_tipo_producto_id");
let sl_cat_sat_division_producto = $("#cat_sat_division_producto_id");
let sl_cat_sat_grupo_producto = $("#cat_sat_grupo_producto_id");
let sl_cat_sat_clase_producto = $("#cat_sat_clase_producto_id");
let text_codigo = $("#codigo");

let clase = sl_cat_sat_clase_producto.find('option:selected');
let codigo_clase = clase.data(`cat_sat_clase_producto_codigo`);

const mask_formato = (cadena) => {
    let salida = "";
    let aux = '';

    for (var i = 0; i < cadena.length; i++) {
        let value = cadena.substring(i, i + 1);
        if (cadena.substring(i, i + 1) === '0'){
            aux = '\\'
        }
        salida += `${aux}${value}`
    }
    return salida;
}

codigo_clase = mask_formato(`${codigo_clase}`)

var mask = IMask(
    document.getElementById('codigo'),
    {
        mask: `${codigo_clase}00`,
        lazy: false,
        placeholderChar: '#'
    }
);

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
            required: true
        }
    },
    messages: {
        cat_sat_tipo_producto_id: "* Seleccione un tipo de producto",
        cat_sat_division_producto_id: "* Seleccione un división de producto",
        cat_sat_grupo_producto_id: "* Seleccione un grupo de producto",
        cat_sat_clase_producto_id: "* Seleccione una clase de producto",
        codigo: "* Ingrese un código valido",
        descripcion: "* Ingrese una descripción valida"
    }
});

let asigna_divisiones = (cat_sat_tipo_producto_id = '') => {
    let url = get_url("cat_sat_division_producto","get_divisiones", {cat_sat_tipo_producto_id: cat_sat_tipo_producto_id});

    get_data(url, function (data) {
        sl_cat_sat_division_producto.empty();
        sl_cat_sat_grupo_producto.empty();
        sl_cat_sat_clase_producto.empty();

        integra_new_option(sl_cat_sat_division_producto,'Seleccione una division','-1');
        integra_new_option(sl_cat_sat_grupo_producto,'Seleccione un grupo','-1');
        integra_new_option(sl_cat_sat_clase_producto,'Seleccione una clase','-1');

        $.each(data.registros, function( index, division ) {
            integra_new_option(sl_cat_sat_division_producto,division.cat_sat_division_producto_descripcion_select,
                division.cat_sat_division_producto_id,"data-cat_sat_division_producto_codigo",division.cat_sat_division_producto_codigo);
        });
        sl_cat_sat_division_producto.selectpicker('refresh');
        sl_cat_sat_grupo_producto.selectpicker('refresh');
        sl_cat_sat_clase_producto.selectpicker('refresh');
    });
}

let asigna_grupos = (cat_sat_division_producto_id = '') => {
    let url = get_url("cat_sat_grupo_producto","get_grupos", {cat_sat_division_producto_id: cat_sat_division_producto_id});

    get_data(url, function (data) {
        sl_cat_sat_grupo_producto.empty();
        sl_cat_sat_clase_producto.empty();

        integra_new_option(sl_cat_sat_grupo_producto,'Seleccione un grupo','-1');
        integra_new_option(sl_cat_sat_clase_producto,'Seleccione una clase','-1');

        $.each(data.registros, function( index, grupo ) {
            integra_new_option(sl_cat_sat_grupo_producto,grupo.cat_sat_grupo_producto_descripcion_select,
                grupo.cat_sat_grupo_producto_id,"data-cat_sat_grupo_producto_codigo",grupo.cat_sat_grupo_producto_codigo);
        });
        sl_cat_sat_grupo_producto.selectpicker('refresh');
        sl_cat_sat_clase_producto.selectpicker('refresh');
    });
}

let asigna_clases = (cat_sat_grupo_producto_id = '') => {
    let url = get_url("cat_sat_clase_producto","get_clases", {cat_sat_grupo_producto_id: cat_sat_grupo_producto_id});

    get_data(url, function (data) {
        sl_cat_sat_clase_producto.empty();

        integra_new_option(sl_cat_sat_clase_producto,'Seleccione una clase','-1');

        $.each(data.registros, function( index, clase ) {
            integra_new_option(sl_cat_sat_clase_producto,clase.cat_sat_clase_producto_descripcion_select,
                clase.cat_sat_clase_producto_id,"data-cat_sat_clase_producto_codigo",clase.cat_sat_clase_producto_codigo);
        });
        sl_cat_sat_clase_producto.selectpicker('refresh');
    });
}

sl_cat_sat_tipo_producto.change(function () {
    let selected = $(this).find('option:selected');
    asigna_divisiones(selected.val());

    mask.Value = ``;
    mask.updateOptions({mask: `00000000`});
});

sl_cat_sat_division_producto.change(function () {
    let selected = $(this).find('option:selected');
    let codigo = selected.data(`cat_sat_division_producto_codigo`);
    asigna_grupos(selected.val());

    let mascara = ``;

    mask.Value = "";

    if (codigo === undefined) {
        mascara = `00`;
    } else {
        mascara = mask_formato(`${codigo}`);
    }

    mask.updateOptions({mask: `${mascara}000000`});
});

sl_cat_sat_grupo_producto.change(function () {
    let selected = $(this).find('option:selected');
    let codigo = selected.data(`cat_sat_grupo_producto_codigo`);
    asigna_clases(selected.val());


    let mascara = ``;

    mask.Value = "";

    if (codigo === undefined) {
        mascara = `0000`;
    } else {
        mascara = mask_formato(`${codigo}`);
    }

    mask.updateOptions({mask: `${mascara}0000`});
});



sl_cat_sat_clase_producto.change(function () {
    let selected = $(this).find('option:selected');
    let codigo = selected.data(`cat_sat_clase_producto_codigo`);

    let mascara = ``;

    mask.Value = "";

    if (codigo === undefined) {
        mascara = `000000`;
    } else {
        mascara = mask_formato(`${codigo}`);
    }

    mask.updateOptions({mask: `${mascara}00`});
});