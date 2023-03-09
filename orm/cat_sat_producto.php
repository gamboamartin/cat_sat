<?php

namespace gamboamartin\cat_sat\models;

use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_producto extends _modelo_parent
{
    public function __construct(PDO $link)
    {
        $tabla = 'cat_sat_producto';
        $columnas = array($tabla => false, "cat_sat_clase_producto" => $tabla, "cat_sat_grupo_producto" => "cat_sat_clase_producto",
            "cat_sat_division_producto" => "cat_sat_grupo_producto", "cat_sat_tipo_producto" => "cat_sat_division_producto");
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'cat_sat_clase_producto_id';

        $tipo_campos['codigo'] = 'cod_int_0_8_numbers';

        parent::__construct(link: $link, tabla: $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Producto SAT';


        if(!isset($_SESSION['init'][$tabla])) {

            if(isset($_SESSION['init']['cat_sat_clase_producto'])){
                unset($_SESSION['init']['cat_sat_clase_producto']);
            }
            new cat_sat_clase_producto(link: $this->link);

            $catalogo = array();
            $catalogo[] = array('codigo' => '50151604', 'descripcion' => 'Aceites animal comestibles (Animales marinos, Hígado de bacalao)', 'cat_sat_clase_producto_id'=>501516);
            $catalogo[] = array('codigo' => '50151605', 'descripcion' => 'Grasa saturada animal comestibles (Manteca, Sebo)', 'cat_sat_clase_producto_id'=>501516);

            foreach ($catalogo as $key=>$row){
                $catalogo[$key]['id'] = (int)$row['codigo'];
            }

            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }

    public function alta_bd(array $keys_integra_ds = array()): array|stdClass
    {
        $this->registro = $this->campos_base(data: $this->registro, modelo: $this);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al inicializar campo base', data: $this->registro);
        }

        $campos_limpiar[] = 'cat_sat_tipo_producto_id';
        $campos_limpiar[] = 'cat_sat_division_producto_id';
        $campos_limpiar[] = 'cat_sat_grupo_producto_id';
        $this->registro = $this->limpia_campos_extras(registro: $this->registro, campos_limpiar: $campos_limpiar);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar producto', data: $r_alta_bd);
        }
        return $r_alta_bd;
    }

    public function get_producto(int $cat_sat_producto_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $cat_sat_producto_id);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al obtener producto', data: $registro);
        }

        return $registro;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false, array $keys_integra_ds = array()):
    array|stdClass
    {
        $registro = $this->campos_base(data: $registro, modelo: $this, id: $id);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al inicializar campo base', data: $registro);
        }

        $campos_limpiar[] = 'cat_sat_tipo_producto_id';
        $campos_limpiar[] = 'cat_sat_division_producto_id';
        $campos_limpiar[] = 'cat_sat_grupo_producto_id';
        $registro = $this->limpia_campos_extras(registro: $registro, campos_limpiar: $campos_limpiar);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al modificar producto', data: $r_modifica_bd);
        }
        return $r_modifica_bd;
    }
}