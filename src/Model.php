<?php
declare(strict_types=1);

namespace Src;

use Doctrine\ORM\EntityManager;
use Exception;

class Model
{
  /**
   * @var EntityManager|null
   */
  private static ?EntityManager $entityManager = null;

  /**
   * @throws Exception
   * @return EntityManager
   */
  public static function entityManager(): EntityManager
  {
      if (self::$entityManager === null) {
          self::$entityManager = (new DB())->connection();
      }

      return self::$entityManager;
  }
}