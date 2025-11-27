<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VededoresController {
    public static function crear(Router $router){
        
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear un nuevo vendedor
            $vendedor = new Vendedor($_POST['vendedor']);

            //validar
            $errores = $vendedor->validar();

            //No hay errores
        if(empty($errores)){
            $vendedor->guardar();

            header('Location: /admin?resultado=1');
                exit;
        }
    }

         $router->render('vendedores/crear', [
            'vendedor'=> $vendedor,
            'errores'=> $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
            $vendedor = Vendedor::find($id);
            $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //asigar los valores
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args); 

            //Validacion
            $errores = $vendedor->validar();

            debuguear($vendedor);

            if(empty($errores)){
                $vendedor->guardar();
            }

        }
        
        $router->render('vendedores/actualizar', [
            'vendedor'=> $vendedor,
            'errores'=> $errores
        ]);
    }

    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //VALIDAR EL ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}