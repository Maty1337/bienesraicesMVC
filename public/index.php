<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\BlogControllers;
use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VededoresController;
use Controllers\PaginasController;
use Model\Propiedad;

$router = new Router();


$router->get('/admin', [PropiedadController::class,  'index']);

//propiedades
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear'] );
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

//vendedores

$router->get('/vendedores/crear', [VededoresController::class, 'crear']);
$router->post('/vendedores/crear', [VededoresController::class, 'crear']);
$router->get('/vendedores/actualizar', [VededoresController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VededoresController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VededoresController::class, 'eliminar']);

//blogs
$router->get('/blog/crear', [BlogControllers::class, 'crear']);
$router->post('/blog/crear', [BlogControllers::class, 'crear']);


//public
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

$router->get('/blog', [BlogControllers::class, 'blog']);
$router->get('/entrada', [BlogControllers::class, 'entrada']);


$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);




$router->comprobarRutas();