<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Censo::dashboard');
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
