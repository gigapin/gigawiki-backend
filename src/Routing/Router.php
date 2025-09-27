<?php

namespace Src\Routing;

use Exception;

class Router
{
  /**
   *
   * @var array
   */
  protected static array $routes = [];

  /**
   *
   * @var string
   */
  protected static string $controller;

  /**
   * Summary of action
   * @var string
   */
  protected static string $action;

  /**
   * List of the parameters to pass at the methods
   * @var array
   */
  protected static array $paramValues = [];

  /**
   * @throws Exception
   */
  public function init(): array|bool|null
  {
    if (! file_exists(__DIR__ . "/../../config/routes.php")) {
      throw new Exception("File not found");
    }

    require __DIR__ . "/../../config/routes.php";

    return self::match(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
  }

  protected static function map(string $route, array $params): array
  {
    self::$routes[] = [
      "path" => $route,
      "params" => $params
    ];

    return self::$routes;
  }

  /**
   * @throws Exception
   */
  public static function get(string $path, array $class): array
  {
    if ($_SERVER['REQUEST_METHOD'] !== "GET") {
      throw new Exception("Request method must be GET");
    }

    return self::map($path, $class);
  }

  public static function post(string $path, array $class): array
  {
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
      throw new Exception("Request method must be GET");
    }

    return self::map($path, $class);
  }

  public static function put(string $path, array $class): array
  {
    if ($_SERVER['REQUEST_METHOD'] !== "PUT") {
      throw new Exception("Request method must be GET");
    }

    return self::map($path, $class);
  }

  public static function patch(string $path, array $class): array
  {
    if ($_SERVER['REQUEST_METHOD'] !== "PATCH") {
      throw new Exception("Request method must be GET");
    }

    return self::map($path, $class);
  }

  public static function delete(string $path, array $class): array
  {
    if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {
      throw new Exception("Request method must be GET");
    }

    return self::map($path, $class);
  }

  public static function match(string $url): false|array
  {
    $url = urldecode($url);
    $url = trim($url, "/");

    foreach (self::$routes as $route) {
      $pattern = self::getPatternFromRoutePath($route["path"]);

      if (preg_match($pattern, $url, $matches)) {
        $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);

        return array_merge($matches, $route["params"]);
      }
    }

    return false;
  }

  private static function getPatternFromRoutePath(string $route_path): string
  {
    $route_path = trim($route_path, "/");
    $segments = explode("/", $route_path);

    $segments = array_map(function(string $segment) {
      if (preg_match("#^\{([a-z][a-z0-9]*)}$#", $segment, $matches)) {
        return "(?<" . $matches[1] . ">[^/]*)";
      }

      if (preg_match("#^\{([a-z][a-z0-9]*):(.+)}$#", $segment, $matches)) {
        return "(?<" . $matches[1] . ">" . $matches[2] . ")";
      }

      return $segment;
    }, $segments);

    return "#^" . implode("/", $segments) . "$#";
  }


  /*public static function dispatch(
    string $controller,
    string $action,
    string|null $params
  )
  {
    if (! class_exists($controller)) {
      throw new Exception("Class $controller not found");
    }

    $className = new ReflectionClass($controller);

    $obj = new $controller(new Test);

    if (! method_exists($className->getMethod($action), $action)) {
      throw new Exception("Method $action not found");
    }

    call_user_func_array([$obj, $action], [$params]);

  }*/
}