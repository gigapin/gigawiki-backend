<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use Exception;
use Src\ApiResponse;
use Src\Controller;
use App\Models\User;
use Src\Exceptions\AuthenticationException;
use Src\Exceptions\ValidationException;
use Src\JWTCodec;

class LoginController extends Controller
{
  /**
   * @throws Exception
   */
  public function signIn(): void
  {
    try {
      $data = ApiResponse::post();

      if (empty($data['email']) || empty($data['password'])) {
        throw new ValidationException('Email and password are required');
      }

      $user = User::getUserByEmail($data['email'], $data['password']);

      if (is_null($user)) {
        throw new AuthenticationException('Credentials are not valid, try again');
      }

      $jwt = new JWTCodec;
      $access_token = $jwt->encode($user);

      if (!$access_token) {
        throw new Exception('Failed to generate token', 500);
      }

      echo ApiResponse::jsonResponse([
        'user' => $user,
        'access_token' => $access_token
      ], 200);
    } catch(Exception $exc) {
      $status = $exc->getCode() >= 400 && $exc->getCode() < 600
        ? $exc->getCode()
        : 500;

      echo ApiResponse::jsonResponse([
        'message' => $exc->getMessage()
      ], $status);
    }
  }
}