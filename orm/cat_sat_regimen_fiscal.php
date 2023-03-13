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
            $catalogo = array();
            $catalogo[] = array('id'=>601,'codigo' => '601', 'descripcion' => 'General de Ley Personas Morales');
            $catalogo[] = array('id'=>603,'codigo' => '603', 'descripcion' => 'Personas Morales con Fines no Lucrativos');
            $catalogo[] = array('id'=>605,'codigo' => '605', 'descripcion' => 'Sueldos y Salarios e Ingresos Asimilados a Salarios');
            $catalogo[] = array('id'=>606,'codigo' => '606', 'descripcion' => 'Arrendamiento');
            $catalogo[] = array('id'=>607,'codigo' => '607', 'descripcion' => 'Régimen de Enajenación o Adquisición de Bienes');
            $catalogo[] = array('id'=>608,'codigo' => '608', 'descripcion' => 'Demás Ingresos');
            $catalogo[] = array('id'=>610,'codigo' => '610', 'descripcion' => 'Residentes en el Extranjero sin Establecimiento Permanente en México');
            $catalogo[] = array('id'=>611,'codigo' => '611', 'descripcion' => 'Ingresos por Dividendos (socios y accionistas)');
            $catalogo[] = array('id'=>612,'codigo' => '612', 'descripcion' => 'Personas Físicas con Actividades Empresariales y Profesionales');
            $catalogo[] = array('id'=>614,'codigo' => '614', 'descripcion' => 'Ingresos por intereses');
            $catalogo[] = array('id'=>615,'codigo' => '615', 'descripcion' => 'Régimen de los ingresos por obtención de premios');
            $catalogo[] = array('id'=>616,'codigo' => '616', 'descripcion' => 'Sin obligaciones fiscales');
            $catalogo[] = array('id'=>620,'codigo' => '620', 'descripcion' => 'Sociedades Cooperativa de Producción que optan por diferir de sus ingresos');
            $catalogo[] = array('id'=>621,'codigo' => '621', 'descripcion' => 'Incorporación Fiscal');
            $catalogo[] = array('id'=>622,'codigo' => '622', 'descripcion' => 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras');
            $catalogo[] = array('id'=>623,'codigo' => '623', 'descripcion' => 'Opcional para Grupos de Sociedades');
            $catalogo[] = array('id'=>624,'codigo' => '624', 'descripcion' => 'Coordinados');
            $catalogo[] = array('id'=>625,'codigo' => '625', 'descripcion' => 'Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas');
            $catalogo[] = array('id'=>626,'codigo' => '626', 'descripcion' => 'Régimen Simplificado de Confianza');


            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }*/
        
    }
}