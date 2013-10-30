<?php

Router::connect(
    '/', 
    array(
        'plugin' => 'Contents',
        'controller' => 'Contents'
    )
);

Router::connect(
    '/contents/:action', 
    array(
        'plugin' => 'Contents',
        'controller' => 'Contents'
    )
);


Router::connect(
    '/contents/:action/*', 
    array(
        'plugin' => 'Contents',
        'controller' => 'Contents'
    )
);


Router::connect(
    '/admin/contents', 
    array(
        'prefix' => 'admin',
        'plugin' => 'Contents',
        'controller' => 'Contents',
        'action' => 'index'
    )
);