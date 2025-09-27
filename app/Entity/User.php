<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
#[Table(name: 'users')]
class User
{
  #[Id]
  #[Column,GeneratedValue]
  private int $id;

  #[Column]
  private string $name;

  #[Column]
  private string $email;

  #[Column(name: 'email_verified_at', type: Types::DATE_MUTABLE, nullable: true)]
  private DateTime $emailVerifiedAt;

  #[Column(name: 'email_confirmed', type: Types::BOOLEAN)]
  private bool $emailConfirmed;

  #[Column]
  private string $password;

  #[Column]
  private string $slug;

  #[Column(name: 'image_id', nullable: true)]
  private int $imageId;

  #[Column(name: 'remember_token', type: Types::STRING, length: 100, nullable: true)]
  private string $rememberToken;

  #[Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
  private DateTime $createdAt;

  #[Column(name: 'updated_at', type: Types::DATETIME_MUTABLE)]
  private DateTime $updatedAt;

  /*#[OneToMany(targetEntity: Project::class, mappedBy: 'userId')]
  private Collection $projects;*/

  public function __construct()
  {
    $this->projects = new ArrayCollection();
  }

  public function getProjects(): Collection
  {
    return $this->projects;
  }

  public function setProjects(Collection $projects): void
  {
    $this->projects = $projects;
  }


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

  public function getEmailVerifiedAt(): DateTime
  {
    return $this->emailVerifiedAt;
  }

  public function setEmailVerifiedAt(DateTime $emailVerifiedAt): void
  {
    $this->emailVerifiedAt = $emailVerifiedAt;
  }

  public function isEmailConfirmed(): bool
  {
    return $this->emailConfirmed;
  }

  public function setEmailConfirmed(bool $emailConfirmed): void
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

  public function getImageId(): int
  {
    return $this->imageId;
  }

  public function setImageId(int $imageId): void
  {
    $this->imageId = $imageId;
  }

  public function getRememberToken(): string
  {
    return $this->rememberToken;
  }

  public function setRememberToken(string $rememberToken): void
  {
    $this->rememberToken = $rememberToken;
  }

  public function getCreatedAt(): DateTime
  {
    return $this->createdAt;
  }

  public function setCreatedAt(DateTime $createdAt): void
  {
    $this->createdAt = $createdAt;
  }

  public function getUpdatedAt(): DateTime
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(DateTime $updatedAt): void
  {
    $this->updatedAt = $updatedAt;
  }


}