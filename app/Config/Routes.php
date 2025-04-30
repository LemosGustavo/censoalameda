<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// Ruta principal que muestra la página de bienvenida
$routes->get('/', 'Home::index');

// Ruta para el censo
$routes->get('home', 'Censo::dashboard/home');

$routes->group('censo', function ($routes) {
    $routes->post('ajax_save', 'Censo::ajax_save');
    $routes->post('preview', 'Censo::preview');
    $routes->post('confirm_save', 'Censo::confirm_save');
});

$routes->group('location', function ($routes) {
    $routes->get('get_states_by_country/(:segment)', 'Location::get_states_by_country/$1');
    $routes->get('get_districts_by_state/(:segment)', 'Location::get_districts_by_state/$1');
    $routes->get('get_localities_by_district/(:segment)', 'Location::get_localities_by_district/$1');
});

$routes->get('image/serve/(:segment)', 'Image::serve/$1');
