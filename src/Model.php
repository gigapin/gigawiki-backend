<?php

namespace Src;

use Doctrine\ORM\EntityManager;
use Exception;

class Model
{
    private static ?EntityManager $entityManager = null;

  /**
   * @throws Exception
   */
  public static function db(): EntityManager
    {
        if (self::$entityManager === null) {
            self::$entityManager = (new DB())->connection();
        }

        return self::$entityManager;
    }
}