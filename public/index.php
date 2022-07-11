<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\PaginadorController;
use Controllers\ResidenteController;
use MVC\Router;

$router = new Router();


//CRUD de Los residente mediante una api
$router->get('/api/residentes', [APIController::class, 'index']);
$router->post('/api/crear', [APIController::class, 'guardar']);
$router->post('/api/actualizar', [APIController::class, 'actualizar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

//Buscar y filtrar Los registro
$router->get('/nombre', [ResidenteController::class, 'nombre']);
$router->get('/correo', [ResidenteController::class, 'correo']);
$router->get('/find', [ResidenteController::class, 'find']);
$router->get('/desc', [ResidenteController::class, 'down']);
$router->get('/letra', [ResidenteController::class, 'filter']);

//Paginador
$router->get('/Pagina', [PaginadorController::class, 'paginador']);






// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();