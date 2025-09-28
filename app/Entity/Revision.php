<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'revisions')]
class Revision
{
  #[ORM\Id]
  #[ORM\GeneratedValue(strategy: 'AUTO')]
  #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
  private int $id;

  #[ORM\Column(name: 'project_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $projectId;

  #[ORM\Column(name: 'section_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $sectionId;

  #[ORM\Column(name: 'page_id',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $pageId;

  #[ORM\Column(type: Types::STRING, length: 191)]
  private string $title;

  #[ORM\Column(type: Types::TEXT)]
  private string $content;

  #[ORM\Column(name: 'created_by',type: Types::BIGINT, options: ['unsigned' => true])]
  private int $createdBy;

  #[ORM\Column(type: Types::STRING)]
  private string $slug;

  #[ORM\Column(type: Types::STRING, nullable: true)]
  private ?string $summary = null;

  #[ORM\Column(name: 'revision_number', type: Types::INTEGER)]
  private int $revisionNumber;

  #[ORM\Column(name: 'created_at' ,type: Types::DATETIME_MUTABLE)]
  private DateTime $createdAt;

  #[ORM\Column(name: 'updated_at' ,type: Types::DATETIME_MUTABLE)]
  private DateTime $updatedAt;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
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

  public function getPageId(): int
  {
    return $this->pageId;
  }

  public function setPageId(int $pageId): void
  {
    $this->pageId = $pageId;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  public function getCreatedBy(): int
  {
    return $this->createdBy;
  }

  public function setCreatedBy(int $createdBy): void
  {
    $this->createdBy = $createdBy;
  }

  public function getSlug(): string
  {
    return $this->slug;
  }

  public function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  public function getSummary(): ?string
  {
    return $this->summary;
  }

  public function setSummary(?string $summary): void
  {
    $this->summary = $summary;
  }

  public function getRevisionNumber(): int
  {
    return $this->revisionNumber;
  }

  public function setRevisionNumber(int $revisionNumber): void
  {
    $this->revisionNumber = $revisionNumber;
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