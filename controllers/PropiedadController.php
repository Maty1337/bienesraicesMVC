<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores'=> $vendedores
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = NEW Propiedad;
        $vendedores = Vendedor::all();
        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            //SUBIDA DE ARCHIVOS

            //generar nombre unico
            $nombreImagen = md5( uniqid(rand(), true)). ".jpg";

            //setear la imagen
            //realiza un resize a la imagen con intervetion
            if($_FILES['propiedad']['tmp_name']['imagen']){      
             $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
             $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            //revisar que el arreglo de errores este vacio        
            if(empty($errores)){ 

             //CREAR CARPETA
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                //guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

             //GUARDA EN LA BASE DE DATOS
                $propiedad->guardar();

                header('Location: /admin?resultado=1');
                exit;

            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        // Ejecutar el codigo despues de que el usuario envia el mensaje
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        //Asignar los atributos
        $args =  $_POST['propiedad'];
        $propiedad->sincronizar($args);
        
        //Validacion
        $errores = $propiedad->validar();

        //subida de archivos
        //generar nombre unico
        $nombreImagen = md5( uniqid(rand(), true)). ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']){      
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
           }
    
        //revisar que el arreglo de errores este vacio
        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['imagen']){ 
                //GUARDAR IMAGEN
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();       
        }
   }
    

        $router->render('/propiedades/actualizar',[
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);

    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //VALIDAR EL ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
