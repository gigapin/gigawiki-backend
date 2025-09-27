<?php

namespace Src;

use App\Models\UserModel;
use Src\Authorization\Authorization;
use Exception;

class ApiAuth
{
  protected UserModel $userModel;
  protected Authorization $authorization;

  /**
   */
  public function __construct()
  {
    $this->userModel = new UserModel('api_users');
    $this->authorization = new Authorization();
  }

  protected static function headers(): void
  {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type, X-API-Key'); // Add this line
    header('Content-type: application/json; charset=utf-8');
  }

  /**
   * @throws Exception
   *
   */
  public function getAuthenticateByApiKey(): bool
  {
    // Debug to see all headers
    $headers = getallheaders();

    $api_key = $_SERVER['HTTP_X_API_KEY'] ?? null;

    if (empty($api_key)) {
      http_response_code(400);
      echo json_encode([
        'message' => 'API Key is required',
        'received_headers' => $headers // Include headers in response for debugging
      ]);

      return false;
    }

    return true;
  }

  /*public function authenticateAccessToken(): array|bool
  {
    if (! preg_match('/^Bearer\s+(.*)$/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
      http_response_code(400);
      echo json_encode([
        'message' => 'Authorization header must be provided',
      ]);

      return false;
    }
    $plain_text = base64_decode($matches[1], true);

    if ($plain_text === false) {
      http_response_code(400);
      echo json_encode([
        'message' => 'Invalid authorization header'
      ]);

      return false;
    }

    $data = json_decode($plain_text, true);

    if ($data === null) {
      http_response_code(400);
      echo json_encode([
        'message' => 'Invalid json'
      ]);

      return false;
    }

    return $data;
  }*/

  public function getUser()
  {
    if (! $this->authorization->authenticateAccessToken()) {
      return false;
    }

    try {
      $user = $this->authorization->authenticateAccessToken();
      $getUser = $this->userModel->getUserByEmail($user['email']);

      if (!$getUser) {
        throw new Exception('User not found');
      }

      return $getUser;
    } catch (Exception $exception) {
      http_response_code(404);
      return json_encode([
        'message' => $exception->getMessage(),
      ]);
    }

  }
}