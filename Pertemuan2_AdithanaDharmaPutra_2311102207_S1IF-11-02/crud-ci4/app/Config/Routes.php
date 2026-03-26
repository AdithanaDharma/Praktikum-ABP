<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/barang', 'Barang::index');
$routes->get('/barang/getData', 'Barang::getData');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang/store', 'Barang::store');
$routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
$routes->post('/barang/update/(:num)', 'Barang::update/$1');
$routes->post('/barang/delete/(:num)', 'Barang::delete/$1'); // Map DataTables delete to post/ajax
$routes->delete('/barang/delete/(:num)', 'Barang::delete/$1');

$routes->get('/kasir', 'Kasir::index');
$routes->get('/kasir/getBarang', 'Kasir::getBarang');
$routes->post('/kasir/processTransaction', 'Kasir::processTransaction');

$routes->get('/transaksi/detail/(:num)', 'Transaksi::detail/$1');
$routes->get('/transaksi/edit/(:num)', 'Transaksi::edit/$1');
$routes->post('/transaksi/update/(:num)', 'Transaksi::update/$1');
$routes->post('/transaksi/delete/(:num)', 'Transaksi::delete/$1');
