<?php

namespace Src\Exceptions;

use Throwable;

class ValidationException extends \Exception
{
  public function __construct(string $message = "Validation failed", int $code = 400, ?Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}