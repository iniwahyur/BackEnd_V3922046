<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('readproduct', 'ProductController::readProduct');
$routes->get('insertproduct', 'ProductController::insertProduct');
$routes->get('edit-product/(:any)', 'ProductController::getProduct/$1');
$routes->post('update-product/(:any)', 'ProductController::updateProduct/$1');
$routes->get('delete-product/(:any)', 'ProductController::deleteProduct/$1');
$routes->post('insertproduct', 'ProductController::insertProduct');


$routes->group('api', function ($routes){
    $routes->get('products', 'ProductController::readProductApi');
    $routes->get('products/(:any)', 'ProductController::getProductApi');
    $routes->post('insert-product', 'ProductController::insertProductApi');
    $routes->put('update-product-api/(:num)', 'ProductController::updateProductApi/$1');
    $routes->delete('delete-product-api/(:num)', 'ProductController::deleteProductApi/$1');
});
