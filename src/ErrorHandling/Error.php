<?php
/*
 * This file is part of the GiGaFlow package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Src\ErrorHandling;

use Exception;
use Src\View;

/**
 * 
 * @package GiGaFlow\ErrorHandling
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class Error
{
    /**
     * * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $severity The severity of the exception
     * @param string $message Error message
     * @param string $file Filename the error was raised in
     * @param int $line Line number in the file
     * @throws Exception
     */
    public static function errorHandler(int $severity, string $message, string $file, int $line): bool
    {
        if (!(error_reporting() & $severity)) {
            return false;
        }
        $errorMsg = [
            'severity' => $severity,
            'message' => $message,
            'file' => $file,
            'line' => $line
        ];

        if (in_array($severity, [E_USER_ERROR, E_USER_WARNING, E_ERROR, E_WARNING])) {
            View::showError($errorMsg);
        }

        return true;
    }

    /**
     * Exception handler.
     *
     * @param $exception
     *
     * @return mixed
     * @throws Exception
     */
    public static function exceptionHandler($exception): mixed
    {
        $config = include __DIR__ . '/../../config/app.php';

        if ($config['env'] === 'development' && $exception->getCode() === 404) {
            http_response_code(404);
            self::errorLog($exception);

            return View::show404($exception);
        } elseif ($config['env'] === 'development' && $exception->getCode() === 500) {
            http_response_code(500);
            self::errorLog($exception);
            
            return View::show500($exception);
        } elseif ($config['env'] === 'production') {
            self::errorLog($exception);
        } else {
            self::errorLog($exception);
            return View::showException($exception);
        }
    }

    /**
     * Writing errors log.
     * 
     * @param $exception
     * @throws Exception
     */
    public static function errorLog($exception): void
    {
        $log = dirname(__DIR__) . '/../storage/logs/' . date('Y-m-d') . '.txt';
        $dir = dirname(__DIR__) . '/../storage/logs/';
        ini_set('error_log', $dir);
        /*if (false == chmod($log, 0777)) {
            throw new Exception('Please set write file permissions to storage/logs directory to allow creation errors log file.');
        }*/
        $message = "Uncaught exception: '" . get_class($exception) . "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= "\nStack trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();
        error_log($message, 3, $log);
    }
}
