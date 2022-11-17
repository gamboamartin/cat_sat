<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_division_producto extends modelo{
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

    public function alta_bd(): array|stdClass
    {
        $this->registro =$this->campos_base(data:$this->registro, modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar estado',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }

    protected function campos_base(array $data, modelo $modelo, int $id = -1): array
    {
        if(!isset($data['codigo_bis'])){
            $data['codigo_bis'] =  $data['codigo'];
        }

        if(!isset($data['descripcion_select'])){
            $ds = str_replace("_"," ",$data['descripcion']);
            $ds = ucwords($ds);
            $data['descripcion_select'] =  "{$data['codigo']} - {$ds}";
        }

        if(!isset($data['alias'])){
            $data['alias'] = $data['codigo'];
        }
        return $data;
    }

    public function get_division(int $cat_sat_division_producto_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $cat_sat_division_producto_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener division producto',data:  $registro);
        }

        return $registro;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
    {
        $registro =$this->campos_base(data:$registro, modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar estado',data:  $r_modifica_bd);
        }
        return $r_modifica_bd;
    }

}