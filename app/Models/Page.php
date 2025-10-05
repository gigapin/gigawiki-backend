<?php
declare(strict_types=1);

namespace App\Models;

use Exception;
use Src\Model;
use App\Entity\Page as PageEntity;

class Page extends Model
{
  /**
   * @throws Exception
   */
  public static function getLatestPages(int $userId): array
  {
    $repoPage = Model::entityManager()->getRepository(PageEntity::class);

    $pages = $repoPage->findBy(['createdBy' => $userId], ['createdAt' => 'DESC'], 3);

    return array_map(fn($page) => [
      'created_by' => $page->getCreatedBy(),
      'updated_by' => $page->getUpdatedBy(),
      'owned_by' => $page->getOwnedBy(),
      'project_id' => $page->getProjectId(),
      'section_id' => $page->getSectionId(),
      'page_type' => $page->getPageType(),
      'title' => $page->getTitle(),
      'slug' => $page->getSlug(),
      'content'=> $page->getContent(),
      'visibility' => $page->getVisibility(),
      'restricted' => $page->getRestricted(),
      'current_revision' => $page->getCurrentRevision(),
      'deleted_at' => $page->getDeletedAt(),
      'created_at' => $page->getCreatedAt(),
      'updated_at' => $page->getUpdatedAt()
    ], $pages);
  }
}