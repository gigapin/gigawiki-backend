<?php
/*
 * This file is part of the GiGaFlow package.
 *
 * (c) Giuseppe Galari <gigaprog@protonmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Controllers\HomeController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Auth\LoginController;

/** @var $route */

$route->get('/', [HomeController::class, 'index']);

$route->post('/api/v1/login/sign-in', [LoginController::class, 'signIn']);

$route->get('/api/v1/admin/dashboard', [DashboardController::class, 'index']);
