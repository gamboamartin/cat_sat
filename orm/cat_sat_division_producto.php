<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_division_producto extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_division_producto';
        $columnas = array($tabla=>false,"cat_sat_tipo_producto" => $tabla);
        $campos_obligatorios[] = 'descripcion';

        $campos_view['cat_sat_tipo_producto_id'] = array('type' => 'selects', 'model' => new cat_sat_tipo_producto($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
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