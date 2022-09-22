<?php
namespace models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_regimen_fiscal extends modelo{
    public function __construct(PDO $link){
        $tabla = __CLASS__;
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }

    public function alta_bd(): array|stdClass
    {

        $valida = $this->valida_predetermiando();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar predeterminado',data:  $valida);
        }

        $r_alta_bd = parent::alta_bd(); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al dar de alta registro', data: $r_alta_bd);
        }
        return $r_alta_bd;
    }

    private function existe_predeterminado(): bool|array
    {
        $filtro['cat_sat_regimen_fiscal.predeterminado'] = 'activo';
        $existe = $this->existe(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al verificar si existe',data:  $existe);
        }
        return $existe;
    }

    public function id_predeterminado(): array|int
    {
        $filtro['cat_sat_regimen_fiscal.predeterminado'] = 'activo';

        $r_cat_sat_regimen_fiscal = $this->filtro_and(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener dp_calle_pertenece',data:  $r_cat_sat_regimen_fiscal);
        }

        if($r_cat_sat_regimen_fiscal->n_registros === 0){
            return $this->error->error(mensaje: 'Error no existe regimen predeterminado',data:  $r_cat_sat_regimen_fiscal);
        }
        if($r_cat_sat_regimen_fiscal->n_registros > 1){
            return $this->error->error(
                mensaje: 'Error existe mas de una regimen predeterminado predeterminada',data:  $r_cat_sat_regimen_fiscal);
        }

        return (int) $r_cat_sat_regimen_fiscal->registros[0]['cat_sat_regimen_fiscal_id'];

    }


    private function valida_predetermiando(): bool|array
    {
        if(isset($this->registro['predeterminado']) && $this->registro['predeterminado'] === 'activo'){
            $existe = $this->existe_predeterminado();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al verificar si existe',data:  $existe);
            }
            if($existe){
                return $this->error->error(mensaje: 'Error ya existe elemento predeterminado',data:  $this->registro);
            }
        }
        return true;
    }
}