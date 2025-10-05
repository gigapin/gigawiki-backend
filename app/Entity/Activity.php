<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'activities')]
class Activity
{
  #[Id]
  #[GeneratedValue(strategy: 'AUTO')]
  #[Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[Column(name: 'user_id', type: TYPES::BIGINT, options: ['unsigned' => true])]
  private int $userId;

  #[Column(type: TYPES::STRING, length: 191)]
  private string $type;

  #[Column(name: 'page_id', type: TYPES::BIGINT, nullable: true, options: ['unsigned' => true])]
  private ?int $pageId = null;

  #[Column(name: 'page_type', type: TYPES::STRING, length: 191, nullable: true)]
  private ?string $pageType = null;

  #[Column(type: TYPES::STRING, length: 191, nullable: true)]
  private ?string $details = null;

  #[Column(type: TYPES::STRING, length: 30, nullable: true)]
  private ?string $ip = null;

  #[Column(name: 'created_at',type: Types::DATETIME_MUTABLE)]
  private DateTime $createdAt;

  #[Column(name: 'updated_at',type: TYPES::DATETIME_MUTABLE)]
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

  public function getType(): string
  {
    return $this->type;
  }

  public function setType(string $type): void
  {
    $this->type = $type;
  }

  public function getPageId(): int|null
  {
    return $this->pageId;
  }

  public function setPageId(int $pageId): void
  {
    $this->pageId = $pageId;
  }

  public function getPageType(): string|null
  {
    return $this->pageType;
  }

  public function setPageType(string $pageType): void
  {
    $this->pageType = $pageType;
  }

  public function getDetails(): string|null
  {
    return $this->details;
  }

  public function setDetails(string $details): void
  {
    $this->details = $details;
  }

  public function getIp(): string|null
  {
    return $this->ip;
  }

  public function setIp(string $ip): void
  {
    $this->ip = $ip;
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