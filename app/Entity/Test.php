<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'tests')]
class Test
{
  #[Id]
  #[Column(type: 'integer', options: ['unsigned' => true]), GeneratedValue]
  private int $id;

  #[Column(type: 'string', length: 191)]
  private string $name;

  #[Column(type: 'string', length: 191)]
  private string $city;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getCity(): string
  {
    return $this->city;
  }

  public function setCity(string $city): void
  {
    $this->city = $city;
  }
}