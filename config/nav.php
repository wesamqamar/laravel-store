<?php
return [
    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard.dashboard',
        'title'=>'dashboard',
        'active'=>'dashboard.dashboard'

    ],
    [
        'icon'=>'fa fa-file',
        'route'=>'dashboard.categorise.index',
        'title'=>'Categories',
        'badge' => 'New',
        'active'=>'dashboard.categorise.*'


    ]
    ,
    [
        'icon'=>' fa fa-house-user',
        'route'=>'dashboard.products.index',
        'title'=>'Products',
        'active'=>'dashboard.products.*'


    ]
    ,
    [
        'icon'=>'fa fa-sort',
        'route'=>'dashboard.dashboard',
        'title'=>'Orders',
        'active'=>'dashboard.orders'


    ]
];
