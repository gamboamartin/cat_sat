<?php

namespace gamboamartin\cat_sat\models;

use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class cat_sat_tipo_producto extends _modelo_parent
{
    public function __construct(PDO $link)
    {
        $tabla = 'cat_sat_tipo_producto';

        $columnas = array($tabla => false);

        $campos_obligatorios[] = 'descripcion';

        $columnas_extra['cat_sat_tipo_producto_n_divisiones'] = "(SELECT COUNT(*) FROM cat_sat_division_producto 
        WHERE cat_sat_division_producto.cat_sat_tipo_producto_id = cat_sat_tipo_producto.id)";

        parent::__construct(link: $link, tabla: $tabla, campos_obligatorios: $campos_obligatorios, columnas: $columnas,
            columnas_extra: $columnas_extra);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Tipo Producto';


        if(!isset($_SESSION['init'][$tabla])) {

            $catalogo = array();
            $catalogo[] = array('id'=>1,'codigo' => '01', 'descripcion' => 'Productos');
            $catalogo[] = array('id'=>2,'codigo' => '02', 'descripcion' => 'Servicios');


            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }
}