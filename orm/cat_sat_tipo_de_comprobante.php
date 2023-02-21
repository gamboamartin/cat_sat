<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_parent;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_tipo_de_comprobante extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_tipo_de_comprobante';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $tipo_campos['codigo'] = 'cod_1_letras_mayusc';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Tipo de comprobante';
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
}