<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index'); // o servidor (http://localhost:8080) redireciona 
$routes->setAutoRoute(true);
