<?php
declare(strict_types=1);

namespace App\Models;

use Exception;
use Src\Model;
use App\Entity\Activity as ActivityEntity;

class Activity extends Model
{
  /**
   * @throws Exception
   */
  public static function showAllActivities(int $userId): array
  {
    $repoActivity = Model::entityManager()->getRepository(ActivityEntity::class);

    $activities = $repoActivity->findBy(['id' => $userId] , ['updatedAt' => 'DESC'], 4);

    return array_map(fn($activity) => [
      'user_id' => $activity->getUserId(),
      'type' => $activity->getType(),
      'page_id' => $activity->getPageId(),
      'details' => $activity->getDetails()
    ], $activities);
  }
}