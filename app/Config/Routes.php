<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Announcement::index');
$routes->get('announcements', 'Announcement::index');
