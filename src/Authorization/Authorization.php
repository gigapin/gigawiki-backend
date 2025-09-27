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

namespace Src\Authorization;

use Exception;
use Src\JWTCodec;
use Src\Session\Session;
use Src\Exceptions\AuthException;
use Src\Http\Request;

/**
 * 
 * @package GiGaFlow\Authorization
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see AuthorizationInterface
 */
class Authorization implements AuthorizationInterface
{
  /**
   * @inheritDoc
   */
  public function init(): void
  {
    try {
      if (is_null(Session::get('user'))) {
        if (Request::uri() !== '/login' && 
            Request::uri() !== '/register' && 
            Request::uri() !== '/sign-in' &&
            Request::uri() !== '/signup' &&
            Request::uri() !== '/'
          ) {
          throw new AuthException("You are not authorized to access! Please make log in if you are registered.", 403);
        }
      }

      if (Request::uri() !== '/login' && 
            Request::uri() !== '/register' && 
            Request::uri() !== '/sign-in' &&
            Request::uri() !== '/signup' &&
            Request::uri() !== '/'
        ) {
        // $role = new Role();
        
        // if (! $role->hasPermission(Session::get('user'), Request::uri())) {
        //   throw new AuthException('You cannot to access at this resource', 403);
        // }
        
        Session::get('user');
      }
    } catch (AuthException $exc) {
      printf('%s %d', $exc->getMessage(), $exc->getCode());
      exit();
    } 
  }

  public function authenticateAccessToken(): array|bool
  {
    $authHeader = $this->getAuthorizationHeader();

    if (! $authHeader) {
      http_response_code(400);
      echo json_encode(['message' => 'Authorization header must be provided.']);

      return false;
    }

    if (! preg_match('/^Bearer\s+(.*)$/', $authHeader, $matches)) {
      http_response_code(400);
      echo json_encode(['message' => 'Authorization header must be Bearer token.']);

      return false;
    }

    try {
      $codec = new JWTCodec();

      return $codec->decode($matches[1]);
    } catch (Exception $e) {
      http_response_code(401);
      echo json_encode(['message' => $e->getMessage()]);

      return false;
    }

  }

  private function getAuthorizationHeader(): ?string
  {
    // Try HTTP_AUTHORIZATION first
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
      return $_SERVER['HTTP_AUTHORIZATION'];
    }

    // Try REDIRECT_HTTP_AUTHORIZATION (common on Apache)
    if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
      return $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }

    // getallheaders fetch all http request headers
    if (function_exists('getallheaders')) {
      $headers = getallheaders();

      if (isset($headers['Authorization'])) {
        return $headers['Authorization'];
      }

      // Case-insensitive check
      foreach ($headers as $name => $value) {
        if (strtolower($name) === 'authorization') {
          return $value;
        }
      }
    }

    if (function_exists('apache_request_headers')) {
      $headers = apache_request_headers();

      if (isset($headers['Authorization'])) {
        return $headers['Authorization'];
      }

      foreach ($headers as $name => $value) {
        if (strtolower($name) === 'authorization') {
          return $value;
        }
      }
    }

    return null;
  }
}