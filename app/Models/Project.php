<?php
declare(strict_types=1);

namespace App\Models;

use Exception;
use Src\Model;
use App\Entity\Project as ProjectEntity;

class Project extends Model
{
  /**
   * @throws Exception
   */
  public static function getProjects(int $userId): array
  {
    $repoProjects = Model::entityManager()->getRepository(ProjectEntity::class);

    $projects = $repoProjects->findBy(['userId' => $userId]);
//var_dump($projects);
    return array_map(fn($project) => [
      'user_id' => $project->getUserId(),
      'subject_id' => $project->getSubjectId(),
      'name' => $project->getName(),
      'slug' => $project->getSlug(),
      'description' => $project->getDescription(),
      'image_id' => $project->getImageId(),
      'visibility' => $project->getVisibility(),
      'deleted_at' => $project->getDeletedAt(),
      'created_at' => $project->getCreatedAt(),
      'updated_at' => $project->getUpdatedAt()
    ], $projects);
  }

  /**
   * @throws Exception
   */
  public static function getLatestProjects(int $userId): array
  {
    $repoProjects = Model::entityManager()->getRepository(ProjectEntity::class);

    $projects = $repoProjects->findBy(['userId' => $userId], ['createdAt' => 'DESC'], 3);

    return array_map(fn($project) => [
      'user_id' => $project->getUserId(),
      'subject_id' => $project->getSubjectId(),
      'name' => $project->getName(),
      'slug' => $project->getSlug(),
      'description' => $project->getDescription(),
      'image_id' => $project->getImageId(),
      'visibility' => $project->getVisibility(),
      'deleted_at' => $project->getDeletedAt(),
      'created_at' => $project->getCreatedAt(),
      'updated_at' => $project->getUpdatedAt()
    ], $projects);
  }

  public static function getProject(int $id)
  {
    $repoProjects = Model::entityManager()->getRepository(ProjectEntity::class);
    $project = $repoProjects->find($id);

    return array_map(fn($project) => [
      'user_id' => $project->getUserId(),
      'subject_id' => $project->getSubjectId(),
      'name' => $project->getName(),
      'slug' => $project->getSlug(),
      'description' => $project->getDescription(),
      'image_id' => $project->getImageId(),
      'visibility' => $project->getVisibility(),
      'deleted_at' => $project->getDeletedAt(),
      'created_at' => $project->getCreatedAt(),
      'updated_at' => $project->getUpdatedAt()
    ], $project);
  }
}