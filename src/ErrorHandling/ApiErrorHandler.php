<?php

namespace Src\ErrorHandling;

use ErrorException;
use Throwable;

class ApiErrorHandler
{
  /**
   * @throws ErrorException
   */
  public static function errorHandler(
    int $errNumber,
    string $errString,
    string $errFile,
    int $errLine,
  )
  {
    throw new ErrorException($errString, 0, $errNumber, $errFile, $errLine);
  }

  public static function exceptionHandler(Throwable $exception): false|string
  {
    http_response_code(500);

    return json_encode([
      'code' => $exception->getCode(),
      'message' => $exception->getMessage(),
      'file' => $exception->getFile(),
      'line' => $exception->getLine(),
      'trace' => $exception->getTrace()
    ]);
  }
}