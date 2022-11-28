<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_moneda extends modelo{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_moneda';
        $columnas = array($tabla=>false,"dp_pais"=>$tabla);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'dp_pais_id';

        $tipo_campos = array();
        $tipo_campos['codigo'] = 'cod_3_letras_mayusc';
        $tipo_campos['dp_pais_id'] = 'id';

        $campos_view['dp_pais_id'] = array('type' => 'selects', 'model' => new dp_pais($link));
        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, campos_view: $campos_view);

        $this->NAMESPACE = __NAMESPACE__;
    }

   public function alta_bd(): array|stdClass
   {
       $this->registro =$this->campos_base(data:$this->registro, modelo: $this);
       if(errores::$error){
           return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
       }

       if(!isset($this->registro['dp_pais_id']) || $this->registro['dp_pais_id'] === -1){
           $id_predeterminado = (new dp_pais($this->link))->id_predeterminado();
           if(errores::$error){
               return $this->error->error(mensaje: 'Error al obtener pais predeterminado', data: $id_predeterminado);
           }
           $this->registro['dp_pais_id'] = $id_predeterminado;
       }

       $r_alta_bd =  parent::alta_bd();
       if(errores::$error){
           return $this->error->error(mensaje: 'Error al insertar tipo de comprobante', data: $r_alta_bd);
       }
       return $r_alta_bd;
   }

    protected function campos_base(array $data, modelo $modelo, int $id = -1, array $keys_integra_ds = array()): array
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

    public function modifica_bd(array $registro, int $id, bool $reactiva = false, array $keys_integra_ds = array('codigo','descripcion')): array|stdClass
    {
        $registro =$this->campos_base(data:$registro, modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar tipo de comprobante',data:  $r_modifica_bd);
        }

        return $r_modifica_bd;
    }
}