<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'index' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'about' => [
        'controller' => 'main',
        'action' => 'about'
    ],
    'contact' => [
        'controller' => 'main',
        'action' => 'contact'
    ],
    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post'
    ],
    
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add'
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts'
    ],
    "admin/delete/{id:\d+}" => [
        'controller' => 'admin',
        'action' => 'delete'
    ],
    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit'
    ],
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login'
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],
];
