<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'role_user')]
class RoleUser
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT, options: ['unsigned', true])]
  private int $id;

  #[ORM\Column(name: 'user_id' ,type: Types::BIGINT, options: ['unsigned', true])]
  private int $userId;

  #[ORM\Column(name: 'role_id' ,type: Types::BIGINT, options: ['unsigned', true])]
  private int $roleId;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getUserId(): int
  {
    return $this->userId;
  }

  public function setUserId(int $userId): void
  {
    $this->userId = $userId;
  }

  public function getRoleId(): int
  {
    return $this->roleId;
  }

  public function setRoleId(int $roleId): void
  {
    $this->roleId = $roleId;
  }
}