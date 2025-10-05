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

/** @var $route */

$route->get('/', [HomeController::class, 'index']);

$route->get('/api/v1/admin/dashboard', [DashboardController::class, 'index']);
