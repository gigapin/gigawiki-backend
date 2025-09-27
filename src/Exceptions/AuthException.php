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

namespace Src\Exceptions;

use Src\View;
use Exception;
use Throwable;

/**
 * @package GiGaFlow\Exceptions
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Exception
 */
class AuthException extends Exception
{
  /**
   * @throws Exception
   */
  public function __construct($message, $code = 0, ?Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
    return $this->redirectLoginPage($message, $code);
  }

  /**
   * @throws Exception
   */
  public function redirectLoginPage($message, $code)
  {
    return View::showExceptionWithRedirectToLogin($message, $code);
  }
}