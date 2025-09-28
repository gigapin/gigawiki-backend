<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'settings')]
class Setting
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(type: Types::STRING)]
  private string $key;

  #[ORM\Column(type: Types::STRING)]
  private string $value;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getKey(): string
  {
    return $this->key;
  }

  public function setKey(string $key): void
  {
    $this->key = $key;
  }

  public function getValue(): string
  {
    return $this->value;
  }

  public function setValue(string $value): void
  {
    $this->value = $value;
  }
}