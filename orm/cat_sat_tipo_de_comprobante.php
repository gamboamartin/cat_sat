<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
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

        /*
        if(!isset($_SESSION['init'][$tabla])) {
            $catalago = array();
            $catalago[] = array('codigo' => 'I', 'descripcion' => 'Ingreso');
            $catalago[] = array('codigo' => 'E', 'descripcion' => 'Egreso');
            $catalago[] = array('codigo' => 'T', 'descripcion' => 'Traslado');
            $catalago[] = array('codigo' => 'N', 'descripcion' => 'Nómina');
            $catalago[] = array('codigo' => 'P', 'descripcion' => 'Pago');


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