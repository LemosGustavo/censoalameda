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

$routes->group('censo', function ($routes) {
    $routes->get('search', 'Censo::search');
    $routes->post('search_by_dni', 'Censo::search_by_dni');
    $routes->post('search_by_personal_data', 'Censo::search_by_personal_data');
    $routes->get('home', 'Censo::dashboard/home');
    $routes->post('preview', 'Censo::preview');
    $routes->post('confirm_save', 'Censo::confirm_save');
    $routes->get('edit/(:num)', 'Censo::edit/$1');
    $routes->post('prepare_edit', 'Censo::prepare_edit');
    $routes->get('edit_form', 'Censo::edit_form');
    $routes->post('update', 'Censo::update');
    $routes->post('search_conviviente', 'Censo::search_conviviente');
});

$routes->group('location', function ($routes) {
    $routes->get('get_states_by_country/(:segment)', 'Location::get_states_by_country/$1');
    $routes->get('get_districts_by_state/(:segment)', 'Location::get_districts_by_state/$1');
    $routes->get('get_localities_by_district/(:segment)', 'Location::get_localities_by_district/$1');
});

$routes->get('image/serve/(:segment)', 'Image::serve/$1');
