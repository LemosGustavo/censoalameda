<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Censo::dashboard');

$routes->group('location', function($routes) {
    $routes->get('get_states_by_country/(:segment)', 'Location::get_states_by_country/$1');
    $routes->get('get_districts_by_state/(:segment)', 'Location::get_districts_by_state/$1');
    $routes->get('get_localities_by_district/(:segment)', 'Location::get_localities_by_district/$1');
});


