<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class cat_sat_regimen_fiscal extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_regimen_fiscal';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        $tipo_campos['codigo'] = 'cod_int_0_3_numbers';


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Regimen Fiscal';

        /*
        if(!isset($_SESSION['init'][$tabla])) {
            $catalago = array();
            $catalago[] = array('codigo' => '601', 'descripcion' => 'General de Ley Personas Morales');
            $catalago[] = array('codigo' => '603', 'descripcion' => 'Personas Morales con Fines no Lucrativos');
            $catalago[] = array('codigo' => '605', 'descripcion' => 'Sueldos y Salarios e Ingresos Asimilados a Salarios');
            $catalago[] = array('codigo' => '606', 'descripcion' => 'Arrendamiento');
            $catalago[] = array('codigo' => '607', 'descripcion' => 'Régimen de Enajenación o Adquisición de Bienes');
            $catalago[] = array('codigo' => '608', 'descripcion' => 'Demás Ingresos');
            $catalago[] = array('codigo' => '610', 'descripcion' => 'Residentes en el Extranjero sin Establecimiento Permanente en México');
            $catalago[] = array('codigo' => '611', 'descripcion' => 'Ingresos por Dividendos (socios y accionistas)');
            $catalago[] = array('codigo' => '612', 'descripcion' => 'Personas Físicas con Actividades Empresariales y Profesionales');
            $catalago[] = array('codigo' => '614', 'descripcion' => 'Ingresos por intereses');
            $catalago[] = array('codigo' => '615', 'descripcion' => 'Régimen de los ingresos por obtención de premios');
            $catalago[] = array('codigo' => '616', 'descripcion' => 'Sin obligaciones fiscales');
            $catalago[] = array('codigo' => '620', 'descripcion' => 'Sociedades Cooperativa de Producción que optan por diferir de sus ingresos');
            $catalago[] = array('codigo' => '621', 'descripcion' => 'Incorporación Fiscal');
            $catalago[] = array('codigo' => '622', 'descripcion' => 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras');
            $catalago[] = array('codigo' => '623', 'descripcion' => 'Opcional para Grupos de Sociedades');
            $catalago[] = array('codigo' => '624', 'descripcion' => 'Coordinados');
            $catalago[] = array('codigo' => '625', 'descripcion' => 'Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas');
            $catalago[] = array('codigo' => '626', 'descripcion' => 'Régimen Simplificado de Confianza');


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
}