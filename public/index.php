<?php
/*
 * This file is part of the GiGaFlow package.
 *
 * (c) Giuseppe Galari <gigaprog@protonmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
ini_set('display_errors', 1);

$root = realpath(dirname(__FILE__));
require  $root . "/../vendor/autoload.php";
require $root . "/../helpers/functions.php";

set_error_handler('Src\ErrorHandling\ApiErrorHandler::errorHandler');
set_exception_handler('Src\ErrorHandling\ApiErrorHandler::exceptionHandler');

use Src\Application\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

try {
  ((new Application())->run());
} catch (Exception $e) {
  printf("Error: %s\n", $e->getMessage());
}


