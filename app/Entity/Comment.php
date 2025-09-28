<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'comments')]
class Comment
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: TYPES::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(name: 'user_id',type: TYPES::BIGINT, options: ['unsigned' => true])]
  private int $userId;

  #[ORM\Column(name: 'page_id',type: TYPES::BIGINT, options: ['unsigned' => true])]
  private int $pageId;

  #[ORM\Column(name: 'page_type',type: TYPES::STRING, length: 191)]
  private string $pageType;

  #[ORM\Column(type: 'string')]
  private string $body;

  #[ORM\Column(name: 'parent_id',type: TYPES::BIGINT, nullable: true, options: ['unsigned' => true])]
  private ?int $parentId = null;

  #[ORM\Column(name: 'created_at',type: Types::DATETIME_MUTABLE)]
  private DateTime $createdAt;

  #[ORM\Column(name: 'updated_at',type: TYPES::DATETIME_MUTABLE)]
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

  public function getPageId(): int
  {
    return $this->pageId;
  }

  public function setPageId(int $pageId): void
  {
    $this->pageId = $pageId;
  }

  public function getPageType(): string
  {
    return $this->pageType;
  }

  public function setPageType(string $pageType): void
  {
    $this->pageType = $pageType;
  }

  public function getBody(): string
  {
    return $this->body;
  }

  public function setBody(string $body): void
  {
    $this->body = $body;
  }

  public function getParentId(): int
  {
    return $this->parentId;
  }

  public function setParentId(int $parentId): void
  {
    $this->parentId = $parentId;
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