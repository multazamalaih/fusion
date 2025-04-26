<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

// auth view
$routes->get('/login', 'Auth::login', ['filter' => 'redirectIfAuthenticated']);
$routes->get('/register', 'Auth::register', ['filter' => 'redirectIfAuthenticated']);

// auth proses
$routes->post('/login', 'Auth::loginProses');
$routes->post('/register', 'Auth::registerProses');
