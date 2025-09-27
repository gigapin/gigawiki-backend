<?php

namespace Src;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Exception;

class DB
{
  public function connection(): EntityManager
  {
    if (! file_exists(__DIR__ . "/../config/database.php")) {
      throw new Exception('File not found');
    }

    $paths = [__DIR__ . "/../app/Entity"];
    $isDevMode = true;

    $config = include __DIR__ . "/../config/database.php";

    $connectionParams = [
      'dbname' => $config['DB_DRIVERS']['MYSQL']['DB_NAME'],
      'user' => $config['DB_DRIVERS']['MYSQL']['DB_USER'],
      'password' => $config['DB_DRIVERS']['MYSQL']['DB_PASS'],
      'host' => $config['DB_DRIVERS']['MYSQL']['DB_HOST'],
      'driver' => 'pdo_mysql',
    ];

    $config = ORMSetup::createAttributeMetadataConfiguration(
      $paths,
      $isDevMode
    );

    $connection = DriverManager::getConnection($connectionParams, $config);

    return new EntityManager($connection, $config);
  }
}