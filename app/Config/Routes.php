<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route - redirects to login page
$routes->get('/', 'Auth::index');

// Auth routes
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Announcements
$routes->get('announcements', 'Announcement::index');

// Teacher routes
$routes->group('teacher', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
    $routes->post('submit-grade', 'Teacher::submitGrade');
});

// Admin routes
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->match(['get', 'post'], 'create-announcement', 'Admin::createAnnouncement');
});

// Student routes
$routes->group('student', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Student::index');
});
