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

namespace Src;

use Exception;
use Src\Database\DatabaseConnectionException;

/**
 * @package GiGaFlow\View
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class View
{
  /**
   * Rendering of the application.
   *
   * @param string $path
   * @param array $data
   * @return mixed
   * @throws Exception
   */
  public static function render(string $path, array $data = []): mixed
  {
    extract($data, EXTR_SKIP);
    $realPath = realpath(__DIR__ . "/../resources/views/" . $path . ".php");

    try {
      if (! $realPath) {
        throw new Exception("$realPath not found");
      }
      if (file_exists($realPath) && is_readable($realPath)) {
          return require __DIR__ . "/../resources/views/$path.php";
      } else {
        throw new Exception("$realPath not found");
      }
    } catch (Exception $exc) {
      return printf("%s", $exc->getMessage());
    } 
  }

  /**
   * Rendering of a page that shows a 404 error message.
   *
   * @param string $exception
   * @static
   * @return mixed
   * @throws Exception
   */
  public static function show404(string $exception): mixed
  {
    return self::render('errors/404', compact('exception'));
  }

  /**
   * Rendering of a page that show a 500 error message.
   *
   * @param array $exception
   * @static
   * @return mixed
   * @throws Exception
   */
  public static function show500(array $exception = []): mixed
  {
    return self::render('errors/show500', ['exception' => $exception]);
  }

  /**
   * Rendering of a page that show a error message.
   *
   * @param array $errors
   * @static
   * @return mixed
   * @throws Exception
   */
  public static function showError(array $errors = []): mixed
  {
    return self::render('errors/error', ['errors' => $errors]);
  }

  /**
   * Rendering of a page that show a error message about an exception raised.
   *
   * @param Exception|Database\DatabaseConnectionException $exception
   * @static
   * @return mixed
   * @throws Exception
   */
  public static function showErrorException(
    Exception|DatabaseConnectionException $exception
  ): mixed
  {
    return self::render('errors/errorException', compact('exception'));
  }

  /**
   * Rendering of a page that show a message about an exception raised.
   *
   * @param string $exception
   * @static
   * @return mixed
   * @throws Exception
   */
  public static function showException(string $exception): mixed
  {
    return self::render('errors/showException', compact('exception'));
  }

  /**
   * Rendering of a page displayed when is not active an user session.
   *
   * @param string $exception
   * @param integer $code
   * @return mixed
   * @throws Exception
   */
  public static function showExceptionWithRedirectToLogin(
    string $exception,
    int $code
  ): mixed
  {
    return self::render('errors/showExceptionRedirectLogin', [
      'exception' => $exception,
      'code' => $code
    ]);
  }
}
