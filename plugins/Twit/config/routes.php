<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Twit',
    ['path' => '/twit'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
