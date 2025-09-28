<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'tags')]
class Tag
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(name: 'user_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $userId;

  #[ORM\Column(name: 'page_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $pageId;

  #[ORM\Column(name: 'page_type',type: Types::STRING, nullable: true)]
  private ?string $pageType = null;

  #[ORM\Column(type: Types::STRING)]
  private string $name;

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

  public function getPageId(): int
  {
    return $this->pageId;
  }

  public function setPageId(int $pageId): void
  {
    $this->pageId = $pageId;
  }

  public function getPageType(): ?string
  {
    return $this->pageType;
  }

  public function setPageType(?string $pageType): void
  {
    $this->pageType = $pageType;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
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