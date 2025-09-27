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

namespace Src\Application;

use Exception;
use Src\Routing\Router;
use Src\Router\RouterFactory;
use Src\Session\SessionFactory;
use Src\Authorization\AuthorizationFactory;

/**
 * 
 * @package GiGaFlow\Application
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see Controller
 */
class Application
{
    /**
     * Load all methods to running the application.
     *
     * @return self
     * @throws Exception
     */
    public function run(): self
    {
        if (version_compare(PHP_VERSION, $appVersion = Config::$appVersion, '<')) {
            die(sprintf("Your PHP Version is %s, but for running correctly the application is needed the %s version.", PHP_VERSION, $appVersion));
        }
        
        $this->initSession();
        
        //$this->errorHandling();  
        //$this->initAuthorization();
        
        $this->initRouter();
        
        return $this;
    }

    /**
     * Handling errors and exceptions
     * 
     * @return void
     */
    private function errorHandling(): void
    {
        error_reporting(E_ALL);
        set_error_handler('Src\ErrorHandling\Error::errorHandler');
        set_exception_handler('Src\ErrorHandling\Error::exceptionHandler');
    }

    /**
     * Initialize a session
     * 
     * @return void
     */
    protected function initSession(): void
    {
        SessionFactory::build();
    }

    /**
     * Initialized routing class
     *
     * @return \Src\Router\Router
     *@throws Exception
     */
    protected function initRouter(): \Src\Router\Router
    {
      return RouterFactory::build();
      //$router = new Router();
      //return $router->init();
    }

  /**
   * Initialize Authorization class.
   *
   * @return AuthorizationFactory|null
   * @throws Exception
   */
    protected function initAuthorization(): ?AuthorizationFactory
    {
        return AuthorizationFactory::build();
    }

}
