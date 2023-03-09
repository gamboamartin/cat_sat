<?php

namespace gamboamartin\cat_sat\models;

use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_grupo_producto extends _modelo_parent
{
    public function __construct(PDO $link)
    {
        $tabla = 'cat_sat_grupo_producto';
        $columnas = array($tabla => false, "cat_sat_division_producto" => $tabla,
            "cat_sat_tipo_producto" => "cat_sat_division_producto");
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'cat_sat_division_producto_id';

        $columnas_extra['cat_sat_grupo_producto_n_clases'] = "(SELECT COUNT(*) FROM cat_sat_clase_producto 
        WHERE cat_sat_clase_producto.cat_sat_grupo_producto_id = cat_sat_grupo_producto.id)";

        $tipo_campos['codigo'] = 'cod_int_0_4_numbers';

        parent::__construct(link: $link, tabla: $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, columnas_extra: $columnas_extra, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Grupo Producto';


        if(!isset($_SESSION['init'][$tabla])) {

            if(isset($_SESSION['init']['cat_sat_division_producto'])){
                unset($_SESSION['init']['cat_sat_division_producto']);
            }

            new cat_sat_division_producto(link: $this->link);

            $catalogo[] = array('codigo'=>"5015", 'descripcion'=>'Aceites y grasas comestibles', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5019", 'descripcion'=>'Alimentos preparados y conservados', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5020", 'descripcion'=>'Bebidas', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5016", 'descripcion'=>'Chocolates, azúcares, edulcorantes y productos de confitería', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5017", 'descripcion'=>'Condimentos y conservantes', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5034", 'descripcion'=>'Fruta congelada', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5036", 'descripcion'=>'Fruta en lata o en frasco', 'cat_sat_division_producto_id'=>50);
	        $catalogo[] = array('codigo'=>"5030", 'descripcion'=>'Fruta fresca', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5035", 'descripcion'=>'Fruta orgánica congelada', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5037", 'descripcion'=>'Fruta orgánica en lata o en frasco', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5031", 'descripcion'=>'Fruta orgánica fresca', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5033", 'descripcion'=>'Fruta orgánica seca', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5032", 'descripcion'=>'Fruta seca', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5010", 'descripcion'=>'Frutos secos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5012", 'descripcion'=>'Pescados y mariscos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5011", 'descripcion'=>'Productos de carne y aves de corral', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5022", 'descripcion'=>'Productos de cereales y legumbres', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5018", 'descripcion'=>'Productos de panadería', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5013", 'descripcion'=>'Productos lácteos y huevos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5038", 'descripcion'=>'Puré de frutas', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5021", 'descripcion'=>'Tabaco y productos de fumar y substitutos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5044", 'descripcion'=>'Vegetales congelados', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5046", 'descripcion'=>'Vegetales en lata o en frasco', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5040", 'descripcion'=>'Vegetales frescos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5045", 'descripcion'=>'Vegetales orgánicos congelados', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5047", 'descripcion'=>'Vegetales orgánicos en lata o en frasco', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5041", 'descripcion'=>'Vegetales orgánicos frescos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5043", 'descripcion'=>'Vegetales orgánicos secos', 'cat_sat_division_producto_id'=>50);
            $catalogo[] = array('codigo'=>"5042", 'descripcion'=>'Vegetales secos', 'cat_sat_division_producto_id'=>50);

            foreach ($catalogo as $key=>$row){
                $catalogo[$key]['id'] = (int)$row['codigo'];
            }

            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }

    public function alta_bd(array $keys_integra_ds = array()): array|stdClass
    {
        $this->registro = $this->campos_base(data: $this->registro, modelo: $this);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al inicializar campo base', data: $this->registro);
        }

        $campos_limpiar[] = 'cat_sat_tipo_producto_id';
        $this->registro = $this->limpia_campos_extras(registro: $this->registro, campos_limpiar: $campos_limpiar);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al insertar grupo producto', data: $r_alta_bd);
        }
        return $r_alta_bd;
    }

    public function get_grupo(int $cat_sat_grupo_producto_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $cat_sat_grupo_producto_id);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al obtener grupo producto', data: $registro);
        }

        return $registro;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false, array $keys_integra_ds = array()): array|stdClass
    {
        $registro = $this->campos_base(data: $registro, modelo: $this, id: $id);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al inicializar campo base', data: $registro);
        }

        $campos_limpiar[] = 'cat_sat_tipo_producto_id';
        $registro = $this->limpia_campos_extras(registro: $registro, campos_limpiar: $campos_limpiar);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al limpiar campos', data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al modificar grupo producto', data: $r_modifica_bd);
        }
        return $r_modifica_bd;
    }
}