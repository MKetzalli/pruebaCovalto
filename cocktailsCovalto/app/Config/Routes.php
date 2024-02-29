<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //para acceder a los controladores y sus metodos (es algo asi como una guia telefonica), se uso restful para practicidad
$routes->get('/', 'Home::index');
$routes->resource('cocktails', ['placeholder'=> '(:num)','except'=>'show']);
$routes->post('cocktails/importFromApi', 'Cocktails::importFromApi');
