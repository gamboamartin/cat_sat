<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class cat_sat_metodo_pago extends _modelo_parent {

    public function __construct(PDO $link){
        $tabla = 'cat_sat_metodo_pago';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        $tipo_campos['codigos'] = 'cod_1_letras_mayusc';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Metodo de Pago';

        if(!isset($_SESSION['init'][$tabla])) {
            $catalago = array();
            $catalago[] = array('codigo' => 'PPD', 'descripcion' => 'Pago en parcialidades o diferido');
            $catalago[] = array('codigo' => 'PUE', 'descripcion' => 'Pago en una sola exhibición');

            $r_alta_bd = (new _defaults())->alta_defaults(catalago: $catalago, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }
    }
}