<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'subjects')]
class Subject
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(name: 'user_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $userId;

  #[ORM\Column(type: Types::STRING)]
  private string $name;

  #[ORM\Column(type: Types::STRING)]
  private string $slug;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  private ?string $description = null;

  #[ORM\Column(name: 'image_id',type: Types::BIGINT, nullable: true, options: ['unsigned' => true])]
  private ?int $imageId = null;

  #[ORM\Column(type: Types::INTEGER, options: ['default' => 1])]
  private int $visibility = 1;

  #[ORM\Column(name: 'deleted_at',type: Types::DATETIME_MUTABLE, nullable: true)]
  private ?\DateTime $deletedAt = null;

  #[ORM\Column(name: 'created_at',type: Types::DATETIME_MUTABLE)]
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

  public function getUserId(): int
  {
    return $this->userId;
  }

  public function setUserId(int $userId): void
  {
    $this->userId = $userId;
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

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(?string $description): void
  {
    $this->description = $description;
  }

  public function getImageId(): ?int
  {
    return $this->imageId;
  }

  public function setImageId(?int $imageId): void
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

  public function getDeletedAt(): ?\DateTime
  {
    return $this->deletedAt;
  }

  public function setDeletedAt(?\DateTime $deletedAt): void
  {
    $this->deletedAt = $deletedAt;
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