<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'pages')]
class Page
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT)]
  private int $id;

  #[ORM\Column(name: 'created_by',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $createdBy;

  #[ORM\Column(name: 'updated_by',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $updatedBy;

  #[ORM\Column(name: 'owned_by',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $ownedBy;

  #[ORM\Column(name: 'project_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $projectId;

  #[ORM\Column(name: 'section_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $sectionId;

  #[ORM\Column(name: 'page_type',type: Types::STRING, length: 100)]
  private string $pageType;

  #[ORM\Column(type: Types::STRING)]
  private string $title;

  #[ORM\Column(type: Types::STRING)]
  private string $slug;

  #[ORM\Column(type: Types::TEXT)]
  private string $content;

  #[ORM\Column(type: Types::INTEGER, options: ['default' => 1])]
  private int $visibility = 1;

  #[ORM\Column(type: TYPES::INTEGER, options: ['default' => 0])]
  private int $restricted = 0;

  #[ORM\Column(name: 'current_revision',type: TYPES::INTEGER, options: ['default' => 0])]
  private int $currentRevision = 0;

  #[ORM\Column(name: 'deleted_at',type: Types::DATETIME_MUTABLE, nullable: true)]
  private ?\DateTime $deletedAt;

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

  public function getOwnedBy(): int
  {
    return $this->ownedBy;
  }

  public function setOwnedBy(int $ownedBy): void
  {
    $this->ownedBy = $ownedBy;
  }

  public function getProjectId(): int
  {
    return $this->projectId;
  }

  public function setProjectId(int $projectId): void
  {
    $this->projectId = $projectId;
  }

  public function getSectionId(): int
  {
    return $this->sectionId;
  }

  public function setSectionId(int $sectionId): void
  {
    $this->sectionId = $sectionId;
  }

  public function getPageType(): string
  {
    return $this->pageType;
  }

  public function setPageType(string $pageType): void
  {
    $this->pageType = $pageType;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  public function getVisibility(): int
  {
    return $this->visibility;
  }

  public function setVisibility(int $visibility): void
  {
    $this->visibility = $visibility;
  }

  public function getRestricted(): int
  {
    return $this->restricted;
  }

  public function setRestricted(int $restricted): void
  {
    $this->restricted = $restricted;
  }

  public function getCurrentRevision(): int
  {
    return $this->currentRevision;
  }

  public function setCurrentRevision(int $currentRevision): void
  {
    $this->currentRevision = $currentRevision;
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