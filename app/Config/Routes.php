<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');

$routes->get('product', 'ProductController::list'); // Product listing

$routes->get('/', 'ProductController::index');

$routes->get('product/create', 'ProductController::create'); // Form to create new product

$routes->post('product/create', 'ProductController::create'); // Handle product submission

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

$routes->post('auth/login', 'UserController::login');

$routes->get('logout', 'UserController::logout');

$routes->get('auth/register', 'UserController::register');

$routes->post('auth/register', 'UserController::register');

$routes->get('profile', 'UserController::getProfile');

$routes->post('profile/update', 'UserController::updateProfile');

$routes->get('profile/updatePassword', 'UserController::updatePassword');

$routes->post('profile/updatePassword', 'UserController::updatePassword');

$routes->get('profile/dashboard', 'UserController::mainDashboard');

$routes->get('profile/dashboard/design', 'UserController::designDashboard');

$routes->get('profile/dashboard/announcement', 'AnnouncementController::getAnnouncements');

$routes->get('profile/dashboard/editAnnouncement/(:num)', 'AnnouncementController::edit/$1');

$routes->post('profile/dashboard/editAnnouncement/(:num)', 'AnnouncementController::edit/$1');

$routes->get('profile/dashboard/deleteAnnouncement/(:num)', 'AnnouncementController::delete/$1');

$routes->post('orders/place', 'OrderController::placeOrder');

$routes->get('orders/history', 'OrderController::orderHistory');

$routes->post('wishlist/add/(:num)', 'WishlistController::addToWishlist/$1');

$routes->post('wishlist/remove/(:num)', 'WishlistController::removeFromWishlist/$1');

$routes->get('wishlist', 'WishlistController::viewWishlist');

$routes->get('cart', 'CartController::index');

$routes->post('cart/add', 'CartController::addToCart');

$routes->post('cart/update', 'CartController::updateCart');

$routes->post('cart/remove', 'CartController::removeFromCart');

$routes->get('checkout/process', 'CheckoutController::processCheckout');

$routes->post('checkout/process', 'CheckoutController::processCheckout');

$routes->get('banners', 'BannerController::getAllBanners');

$routes->post('banners/create', 'BannerController::create');

$routes->get('banners/edit/(:num)', 'BannerController::edit/$1');

$routes->post('banners/edit/(:num)', 'BannerController::edit/$1');

$routes->get('banners/delete/(:num)', 'BannerController::delete/$1');

$routes->post('announcements/create', 'AnnouncementController::create');

$routes->get('announcements/edit/(:num)', 'AnnouncementController::edit/$1');

$routes->post('announcements/edit/(:num)', 'AnnouncementController::edit/$1');

$routes->get('announcements/delete/(:num)', 'AnnouncementController::delete/$1');
