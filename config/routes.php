<?php
/*
 * This file is part of the GiGaFlow package.
 *
 * (c) Giuseppe Galari <gigaprog@protonmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


use App\Controllers\Admin\DashboardController;
use App\Controllers\HomeController;
use Src\Routing\Router;

/** @var $route */

//Router::get('', [HomeController::class, 'index']);

$route->get('/', [HomeController::class, 'index']);

$route->get('/admin/dashboard', [DashboardController::class, 'index']);
$route->post('/admin/dashboard/create', [DashboardController::class, 'create']);
$route->get('/admin/dashboard/show/{id}', [DashboardController::class, 'show']);
$route->put('/admin/dashboard/update/{id}', [DashboardController::class, 'update']);
$route->delete('/admin/dashboard/delete/{id}', [DashboardController::class, 'delete']);