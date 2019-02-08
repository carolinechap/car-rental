<?php

$routes = new Router;

$routes->get('/',  'PagesController@home');

$routes->run();