<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_division_producto extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_division_producto';
        $columnas = array($tabla=>false,"cat_sat_tipo_producto" => $tabla);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'cat_sat_tipo_producto_id';

        $columnas_extra['cat_sat_division_producto_n_grupos'] = "(SELECT COUNT(*) FROM cat_sat_grupo_producto 
        WHERE cat_sat_grupo_producto.cat_sat_division_producto_id = cat_sat_division_producto.id)";

        $tipo_campos['codigo'] = 'cod_int_0_2_numbers';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, columnas_extra: $columnas_extra, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Division Producto';

        /*
        if(!isset($_SESSION['init'][$tabla])) {

            $codigo = '02';
            if(isset($_SESSION['init']['cat_sat_tipo_producto'])){
                unset($_SESSION['init']['cat_sat_tipo_producto']);
            }

            $cat_sat_tipo_producto = (new cat_sat_tipo_producto(link: $this->link))->registro_by_codigo(codigo: $codigo);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al obtener cat_sat_tipo_producto', data: $cat_sat_tipo_producto);
                print_r($error);
                exit;
            }

            $catalago = array();
            $catalago[] = array('codigo' => '81', 'descripcion' => 'Servicios Basados en Ingeniería, Investigación y Tecnología', 'cat_sat_tipo_producto_id'=>$cat_sat_tipo_producto['cat_sat_tipo_producto_id']);

            $r_alta_bd = (new _defaults())->alta_defaults(catalago: $catalago, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }
        */

    }

    public function get_division(int $cat_sat_division_producto_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $cat_sat_division_producto_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener division producto',data:  $registro);
        }

        return $registro;
    }
}