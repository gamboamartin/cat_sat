<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_children;

use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_moneda extends _modelo_children{
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

        $parents_data['dp_pais'] = array();
        $parents_data['dp_pais']['namespace'] = 'gamboamartin\\direccion_postal\\models';
        $parents_data['dp_pais']['registro_id'] = -1;
        $parents_data['dp_pais']['keys_parents'] = array('dp_pais_descripcion');
        $parents_data['dp_pais']['key_id'] = 'dp_pais_id';


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, campos_view: $campos_view, tipo_campos: $tipo_campos, parents_data: $parents_data);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Moneda';
    }



    public function alta_bd(): array|stdClass{


        $valida = $this->valida_alta_bd(registro:$this->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro en modelo '.$this->tabla,data: $valida);
        }

        if(!isset($this->registro['dp_pais_id']) || (int)$this->registro['dp_pais_id']<=0 ){
            $ins_pred = (new dp_pais(link: $this->link))->inserta_predeterminado(codigo: 'XXX',descripcion: 'SIN PAIS');
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al insertar pais_predeterminado en modelo '.$this->tabla,
                    data: $ins_pred);
            }
            $dp_pais_id = (new dp_pais(link: $this->link))->id_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener pais_predeterminado en modelo '.$this->tabla,
                    data: $dp_pais_id);
            }

            $this->registro['dp_pais_id'] = $dp_pais_id;

        }

        $registro = $this->init_row_alta(
            defaults: $this->defaults,parents_data: $this->parents_data, registro: $this->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar registro en modelo '.$this->tabla,data: $registro);
        }



        $this->registro = $registro;

        $r_alta_bd =  parent::alta_bd(); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al dar de alta accion en modelo '.$this->tabla,data: $r_alta_bd);
        }

        return $r_alta_bd;
    }


    public function modifica_bd(array $registro, int $id, bool $reactiva = false,
                                array $keys = array('codigo', 'dp_pais_id','descripcion')): array|stdClass
    {

        $r_modifica_bd = parent::modifica_bd(registro: $registro,id:  $id,reactiva:  $reactiva,keys:  $keys); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error('Error al modificar cat_sat_moneda', $r_modifica_bd);
        }
        return $r_modifica_bd;
    }

}