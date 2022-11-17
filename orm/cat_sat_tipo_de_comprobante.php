<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_tipo_de_comprobante extends modelo{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_tipo_de_comprobante';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $tipo_campos['codigo'] = 'cod_1_letras_mayusc';

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

        $r_alta_bd =  parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar tipo de comprobante', data: $r_alta_bd);
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

    public function get_tipo_comprobante_predeterminado(): array|stdClass
    {
        $filtro['cat_sat_tipo_de_comprobante.predeterminado'] = "activo";
        $predeterminado =  $this->filtro_and(filtro: $filtro);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al obtener tipo de comprobante predeterminado',
                data: $predeterminado);
        }

        if ($predeterminado->n_registros === 0){
            return $this->error->error(mensaje: 'Error no exite un tipo de comprobante predeterminado',
                data: $predeterminado);
        }

        if ($predeterminado->n_registros > 1){
            return $this->error->error(mensaje: 'Error exite mas de un tipo de comprobante predeterminado',
                data: $predeterminado);
        }

        return $predeterminado;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
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