<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Src\Model;

#[Entity]
#[Table('projects')]
class Project
{
  #[Id]
  #[GeneratedValue]
  #[Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[Column(name: 'user_id', type: Types::BIGINT, options: ['unsigned' => true])]
  private int $userId;

  #[Column(name: 'subject_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $subjectId;

  #[Column(type: Types::STRING, length: 100)]
  private string $name;

  #[Column(type: Types::STRING, length: 255)]
  private string $slug;

  #[Column(type: Types::TEXT, nullable: true)]
  private ?string $description = null;

  #[Column(name: 'image_id',type: Types::BIGINT, nullable: true, options: ['unsigned' => true])]
  private ?int $imageId;

  #[Column(type: Types::INTEGER, options: ['default' => 1])]
  private int $visibility = 1;

  #[Column(name: 'deleted_at', type: Types::DATETIME_MUTABLE, nullable: true)]
  private ?DateTime $deletedAt = null;

  #[Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
  private DateTime $createdAt;

  #[Column(name: 'updated_at', type: Types::DATETIME_MUTABLE)]
  private DateTime $updatedAt;

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

  public function getSubjectId(): int
  {
    return $this->subjectId;
  }

  public function setSubjectId(int $subjectId): void
  {
    $this->subjectId = $subjectId;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  public function getDescription(): string|null
  {
    return $this->description;
  }

  public function setDescription(string $description): void
  {
    $this->description = $description;
  }

  public function getImageId(): int|null
  {
    return $this->imageId;
  }

  public function setImageId(int $imageId): void
  {
    $this->imageId = $imageId;
  }

  public function getVisibility(): int
  {
    return $this->visibility;
  }

  public function setVisibility(int $visibility): void
  {
    $this->visibility = $visibility;
  }

  public function getDeletedAt(): DateTime|null
  {
    return $this->deletedAt;
  }

  public function setDeletedAt(DateTime $deletedAt): void
  {
    $this->deletedAt = $deletedAt;
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