<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('product', 'ProductController::list'); // Product listing

$routes->get('product/create', 'ProductController::create'); // Form to create new product

$routes->post('product/store', 'ProductController::store'); // Handle product submission

$routes->get('product/edit/(:num)', 'ProductController::edit/$1'); // Form to edit product

$routes->post('product/update/(:num)', 'ProductController::update/$1'); // Handle product update

$routes->post('product/delete/(:num)', 'ProductController::delete/$1'); // Handle product deletion

$routes->get('product/getAttributes/(:num)', 'ProductController::getAttributesByCategory/$1');

$routes->post('product/filter', 'ProductController::filterProducts');

$routes->get('product/filter-slider', 'ProductController::filter');

$routes->get('product/getProductDetails/(:num)', 'ProductController::getProductDetails/$1');

$routes->get('settings/description', 'SettingsController::description');

$routes->post('settings/add-category', 'SettingsController::addCategory');

$routes->get('settings/edit-category/(:num)', 'SettingsController::editCategory/$1');

$routes->post('settings/update-category/(:num)', 'SettingsController::updateCategory/$1');

$routes->post('settings/delete-category/(:num)', 'SettingsController::deleteCategory/$1');

$routes->post('settings/add-attribute', 'SettingsController::addAttribute');

$routes->get('settings/edit-attribute/(:num)', 'SettingsController::editAttribute/$1');

$routes->post('settings/update-attribute/(:num)', 'SettingsController::updateAttribute/$1');

$routes->post('settings/delete-attribute/(:num)', 'SettingsController::deleteAttribute/$1');

$routes->get('settings/assign_attributes', 'SettingsController::assignAttributes');

$routes->post('settings/saveAttributes', 'SettingsController::saveAttributes');

$routes->get('settings/getAttributesByCategory/(:num)', 'SettingsController::getAttributesByCategory/$1');

$routes->get('auth/login', 'UserController::login');

$routes->post('auth/login', 'UserController::auth');

$routes->get('auth/cadastre', 'UserController::cadastre');

$routes->post('auth/register', 'UserController::register');
