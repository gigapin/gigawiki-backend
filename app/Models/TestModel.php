<?php

namespace App\Models;

use App\Entity\Test;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
use Src\Model;

class TestModel extends Model
{
  private Test $test;

  public function __construct()
  {
    $this->test = new Test();
  }

  public function getTests(): array
  {
    return Model::db()->getRepository(Test::class)->findAll();
  }
  /**
   * @throws OptimisticLockException
   * @throws ORMException
   * @throws Exception
   */
  public function create(array $data): Test
  {
    $this->test->setName($data['name']);
    $this->test->setCity($data['city']);

    Model::db()->persist($this->test);
    Model::db()->flush();

    return $this->test;
  }

  /**
   * @throws Exception
   */
  public function show(int $id)
  {
    return Model::db()->getRepository(Test::class)->findOneBy(['id' => $id]);
  }

  public function update(int $id, array $data)
  {
    $test = Model::db()->find(Test::class, $id);
    $test->setName($data['name']);
    $test->setCity($data['city']);

    Model::db()->flush();

    return $test;
  }

  public function delete(int $id)
  {
    $test = Model::db()->find(Test::class, $id);
    Model::db()->remove($test);
    Model::db()->flush();

    return $test;
  }
}