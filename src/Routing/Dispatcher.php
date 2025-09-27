<?php

namespace Src\Routing;

use Exception;
use ReflectionException;
use ReflectionMethod;
use Src\Container;

class Dispatcher
{
  public function __construct(private readonly Router $router, private readonly Container $container) {}

  /**
   * @throws ReflectionException
   * @throws Exception
   */
  public function handle(string $path): void
  {
    //echo $path;
    $params = $this->router->init();

    if (!$params) {
      exit("No route found");
    }

    $action = $this->getActionName($params);
    $controller = $this->getControllerName($params);

    $obj = $this->container->get($controller);

    $args = $this->getActionArguments($controller, $action, $params);
    $obj->$action(...$args);
  }

  /**
   * @throws ReflectionException
   */
  private function getActionArguments(string $controller, string $action, array $params): array
  {
    $args = [];
    $method = new ReflectionMethod($controller, $action);

    foreach ($method->getParameters() as $parameter) {
      $name = $parameter->getName();
      $args[$name] = $params[$name];
    }

    return $args;
  }

  private function getControllerName(array $params)
  {
    return $params[0];
  }

  private function getActionName(array $params): string
  {
    $action = $params[1];

    return lcfirst(str_replace("-", "", ucwords(strtolower($action), "-")));
  }
}


