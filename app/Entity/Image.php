<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'images')]
class Image
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: TYPES::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(type: TYPES::STRING, length: 191)]
  private string $name;

  #[ORM\Column(type: TYPES::STRING, length: 191)]
  private string $url;

  #[ORM\Column(type: TYPES::STRING)]
  private string $path;

  #[ORM\Column(name: 'created_by',type: TYPES::INTEGER, options: ['unsigned' => true])]
  private int $createdBy;

  #[ORM\Column(name: 'updated_by',type: TYPES::INTEGER, options: ['unsigned' => true])]
  private int $updatedBy;

  #[ORM\Column(type: TYPES::STRING, length: 191)]
  private string $type;

  #[ORM\Column(name: 'created_at',type: TYPES::DATETIME_MUTABLE)]
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

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getUrl(): string
  {
    return $this->url;
  }

  public function setUrl(string $url): void
  {
    $this->url = $url;
  }

  public function getPath(): string
  {
    return $this->path;
  }

  public function setPath(string $path): void
  {
    $this->path = $path;
  }

  public function getCreatedBy(): int
  {
    return $this->createdBy;
  }

  public function setCreatedBy(int $createdBy): void
  {
    $this->createdBy = $createdBy;
  }

  public function getUpdatedBy(): int
  {
    return $this->updatedBy;
  }

  public function setUpdatedBy(int $updatedBy): void
  {
    $this->updatedBy = $updatedBy;
  }

  public function getType(): string
  {
    return $this->type;
  }

  public function setType(string $type): void
  {
    $this->type = $type;
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