<?php
declare(strict_types=1);

namespace App\Models;

use Exception;
use Src\Model;
use App\Entity\View as ViewEntity;

class View extends Model
{
  /**
   * @throws Exception
   */
  public static function showAllViews(int $userId): array
  {
    $repoViews = Model::entityManager()->getRepository(ViewEntity::class);

    $views = $repoViews->findBy(['userId' => $userId], ['views' => 'DESC'], 4);

    return array_map(fn($view) => [
      'user_id' => $view->getUserId(),
      'page_id' => $view->getPageId(),
      'page_type' => $view->getPageType(),
      'views' => $view->getViews()
    ], $views);
  }

  /**
   * @throws Exception
   */
  public static function getMoreViews(): array|string
  {
    $visited = self::showAllViews(1);

    $pageType = [];

    foreach ($visited as $view) {
      $model = "\App\Entity\\" . ucfirst($view['page_type']);
      $repo = Model::entityManager()
        ->getRepository($model)
        ->find($view['page_id']);
      $pageType[] = $repo;
    }

    return array_map(fn($type) => [
      "id" => $type->getId(),
      "name" => $type->getName(),
      "slug" => $type->getSlug()
    ], $pageType);
  }
}