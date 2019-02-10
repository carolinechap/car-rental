<?php

$routes = new Router;

$routes->get('/',  'PagesController@home');
// Routes Conducteurs
$routes->get('conducteurs',             'ConducteursController@index');
$routes->get('conducteurs/(\d+)',       'ConducteursController@show'); 
$routes->get('conducteurs/add',         'ConducteursController@add'); 
$routes->post('conducteurs/save',       'ConducteursController@save'); 
$routes->get('conducteurs/delete/(\d+)','ConducteursController@delete');

// Routes Voiture
$routes->get('voitures',             'VoituresController@index');
$routes->get('voitures/(\d+)',       'VoituresController@show'); 
$routes->get('voitures/add',         'VoituresController@add'); 
$routes->post('voitures/save',       'VoituresController@save'); 
$routes->get('voitures/delete/(\d+)','VoituresController@delete');

// Routes Employee
$routes->get('employees',             'EmployeesController@index');
$routes->get('employees/(\d+)',       'EmployeesController@show'); 
$routes->get('employees/add',         'EmployeesController@add'); 
$routes->post('employees/save',       'EmployeesController@save'); 
$routes->get('employees/delete/(\d+)','EmployeesController@delete');

// Routes Store
$routes->get('stores',                   'StoresController@index');
$routes->get('stores/(\d+)',             'StoresController@show');
$routes->get('stores/add',               'StoresController@add');
$routes->post('stores/save',             'StoresController@save');
$routes->get('stores/delete/(\d+)',      'StoresController@delete');

// Routes Locations
$routes->get('locations',                   'LocationsController@index');
$routes->get('locations/(\d+)',             'LocationsController@show');
$routes->get('locations/add',               'LocationsController@add');
$routes->post('locations/save',             'LocationsController@save');
$routes->get('locations/delete/(\d+)',      'LocationsController@delete');


// routes admin
$routes->get('admin',             'AdminController@index');



$routes->run();