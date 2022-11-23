<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_parent;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_clase_producto extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_clase_producto';
        $columnas = array($tabla=>false,"cat_sat_grupo_producto" => $tabla,
            "cat_sat_division_producto" => "cat_sat_grupo_producto","cat_sat_tipo_producto" => "cat_sat_division_producto");
        $campos_obligatorios[] = 'descripcion';

        $campos_view['cat_sat_tipo_producto_id'] = array('type' => 'selects', 'model' => new cat_sat_tipo_producto($link));
        $campos_view['cat_sat_division_producto_id'] = array('type' => 'selects', 'model' => new cat_sat_division_producto($link));
        $campos_view['cat_sat_grupo_producto_id'] = array('type' => 'selects', 'model' => new cat_sat_grupo_producto($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas,campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(): array|stdClass
    {
        $this->registro = $this->campos_base(data:$this->registro,modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }

        $this->registro = $this->limpia_campos(registro: $this->registro,
            campos_limpiar: array('cat_sat_tipo_producto_id','cat_sat_division_producto_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar clase',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }

    public function get_clase(int $cat_sat_clase_producto_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $cat_sat_clase_producto_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener clase producto',data:  $registro);
        }

        return $registro;
    }

    private function limpia_campos(array $registro, array $campos_limpiar): array
    {
        foreach ($campos_limpiar as $valor) {
            if (isset($registro[$valor])) {
                unset($registro[$valor]);
            }
        }
        return $registro;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
    {
        $registro = $this->campos_base(data: $registro, modelo: $this, id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $registro = $this->limpia_campos(registro: $registro,
            campos_limpiar: array('cat_sat_tipo_producto_id','cat_sat_division_producto_id'));
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar estado',data:  $r_modifica_bd);
        }
        return $r_modifica_bd;
    }
}