<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
$routes->get('/', 'Login::index');

// Routes for 'Kategori' (Category)
$routes->get('/kategori', 'Kategori::index');
$routes->get('/kategori/hapus/(:any)', 'Kategori::hapus/$1');

// Routes for 'Satuan' (Unit)
$routes->get('/satuan', 'Satuan::index'); // Show list of units

// Routes for 'Barang' (Product)
$routes->get('/barang', 'Barang::index'); // Show list of products
$routes->get('/barang/hapus/(:any)', 'Barang::hapus/$1');
