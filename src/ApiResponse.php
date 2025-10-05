<?php

namespace Src;

use Exception;
use PDO;

class ApiResponse
{
  protected static function headers(): void
  {
    // Handle preflight OPTIONS request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type, X-API-Key');
      header('Access-Control-Max-Age: 86400'); // Cache preflight for 24 hours
      http_response_code(200);
      exit();
    }

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type, X-API-Key');
    header('Content-type: application/json; charset=utf-8');
  }

  /**
   * @throws Exception
   */
  public static function url(string $route): false|int|array|string|null
  {
    $http = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $server = $http . $_SERVER['HTTP_HOST'];
    var_dump($server, $_ENV['APP_URL']);
    if ($server != $_ENV['APP_URL']) {

      http_response_code(303);
      return json_encode([
        'message' => 'URL not valid',
        'status' => 303,
      ]);
    }

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', $path);

    if ($parts[1] != 'api' || $parts[2] != $_ENV['API_VERSION']) {
      http_response_code(303);
      return json_encode([
        'message' => 'This is not the api url',
        'status' => 303,
      ]);
    }

    if ($parts[3] != $route) {
      var_dump($route);
      http_response_code(404);
      return json_encode([
        'message' => 'This route does not exist',
        'status' => 404,
      ]);
    }

    return true;
  }

  public static function setMessage(string $message, int $status): string|false
  {
    self::headers();

    http_response_code($status);

    return json_encode([
      'message' => $message
    ]);
  }

  /**
   * @throws Exception
   */
  public static function get(string $route, array $data): false|string
  {
    self::headers();

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
      http_response_code(405);
      return json_encode([
        'message' => 'Method Not Allowed',
        'status' => 405
      ]);
    }

    try {
      if (!$data) {
        throw new Exception("An error occurred during the fetching data");
      }

      return json_encode($data);
    } catch (Exception $exception) {
      http_response_code(500);
      return json_encode([
        'message' => $exception->getMessage(),
        'status' => 500
      ]);
    }
  }

  /**
   * @throws Exception
   */
  public static function post()
  {
    // Get header
    self::headers();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      return json_encode([
        'message' => 'Method Not Allowed',
        'status' => 405
      ]);
    }

    return json_decode(file_get_contents('php://input'), true);
  }

  public static function put()
  {
    self::headers();

    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
      http_response_code(405);
      return json_encode([
        'message' => 'Method Not Allowed',
        'status' => 405
      ]);
    }

    return json_decode(file_get_contents('php://input'), true);
  }

  public static function delete()
  {
    self::headers();

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
      http_response_code(405);
      return json_encode([
        'message' => 'Method Not Allowed',
      ]);
    }

    return json_decode(file_get_contents('php://input'), true);
  }

  public static function jsonResponse(array $data): string
  {
    self::headers();
    http_response_code(200);
    header('Content-Type: application/json');

    return json_encode($data);
  }
}