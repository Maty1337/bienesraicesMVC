<?php

namespace Controllers;

use Model\Entrada;
use Intervention\Image\ImageManagerStatic as Image;
use MVC\Router;



class BlogControllers{
public static function blog(Router $router){
    
        $entradas = Entrada::all();

        $router->render('paginas/blog' , [
        'entradas' => $entradas
     ]);
}
    

public static function crear(Router $router) {

    $entrada = new Entrada();
    $errores = Entrada::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mantener datos del formulario
        $entrada = new Entrada($_POST['entrada']);

        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Si hay imagen
        if ($_FILES['entrada']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800, 600);
            $entrada->setImagen($nombreImagen);
        }

        // Validación
        $errores = $entrada->validar();

        // Si no hay errores
        if (empty($errores)) {
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guardar imagen
            if (isset($image)) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            // Guardar entrada
            $entrada->guardar();

            header('Location: /admin?resultado=1');
            exit;
        }
    }

    // Siempre renderiza, ya sea GET o POST con errores
    $router->render('blog/crear', [
        'entrada' => $entrada,
        'errores' => $errores
    ]);
}


    public static function entrada(Router $router) {
    $id = $_GET['id'] ?? null;

    if (!$id || !is_numeric($id)) {
        header('Location: /blog');
        exit;
    }

    $entrada = Entrada::find($id);

    if (!$entrada) {
        header('Location: /blog');
        exit;
    }

    $router->render('paginas/entrada', [
        'entrada' => $entrada
    ]);
}



}