<?php
declare(strict_types=1);

namespace App\Models;

use Exception;
use Src\Model;
use App\Entity\Subject as SubjectEntity;

class Subject extends Model
{
  /**
   * @throws Exception
   */
  public static function getSubjects(int $userId): array
  {
    $repoSubjects = Model::entityManager()->getRepository(SubjectEntity::class);

    $subjects = $repoSubjects->findBy(['userId' => $userId], ['createdAt' => 'DESC'], 5);

    return array_map(fn($subject) => [
      'user_id' => $subject->getUserId(),
      'name' => $subject->getName(),
      'slug' => $subject->getSlug(),
      'description' => $subject->getDescription(),
      'image_id' => $subject->getImageId(),
      'visibility' => $subject->getVisibility(),
      'deleted_at' => $subject->getDeletedAt(),
      'created_at' => $subject->getCreatedAt(),
      'updated_at' => $subject->getUpdatedAt()
    ], $subjects);
  }
}