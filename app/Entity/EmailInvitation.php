<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'email_invitations')]
class EmailInvitation
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(type: Types::STRING)]
  private string $name;

  #[ORM\Column(type: Types::STRING)]
  private string $email;

  #[ORM\Column(name: 'email_verified_at',type: Types::DATETIME_MUTABLE, nullable: true)]
  private ?\DateTime $emailVerifiedAt = null;

  #[ORM\Column(type: Types::INTEGER, options: ['default' => 0])]
  private int $emailConfirmed = 0;

  #[ORM\Column(type: Types::STRING)]
  private string $password;

  #[ORM\Column(type: Types::STRING)]
  private string $slug;

  #[ORM\Column(name:  'created_at', type: Types::DATETIME_MUTABLE)]
  private \DateTime $createdAt;

  #[ORM\Column(name: 'updated_at',type: Types::DATETIME_MUTABLE)]
  private \DateTime $updatedAt;

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

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function getEmailVerifiedAt(): ?\DateTime
  {
    return $this->emailVerifiedAt;
  }

  public function setEmailVerifiedAt(?\DateTime $emailVerifiedAt): void
  {
    $this->emailVerifiedAt = $emailVerifiedAt;
  }

  public function getEmailConfirmed(): int
  {
    return $this->emailConfirmed;
  }

  public function setEmailConfirmed(int $emailConfirmed): void
  {
    $this->emailConfirmed = $emailConfirmed;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): void
  {
    $this->password = $password;
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  public function getCreatedAt(): \DateTime
  {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTime $createdAt): void
  {
    $this->createdAt = $createdAt;
  }

  public function getUpdatedAt(): \DateTime
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTime $updatedAt): void
  {
    $this->updatedAt = $updatedAt;
  }
}