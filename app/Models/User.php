<?php
declare(strict_types=1);

namespace App\Models;

use Src\Model;
use App\Entity\User as UserEntity;

class User extends Model
{
  /**
   * @throws \Exception
   */
  public static function getUser(int $userId): array
  {
    $repoUser = Model::entityManager()->getRepository(UserEntity::class);

    $user = $repoUser->findOneBy(['id' => $userId]);

    return [
      'name' => $user->getName(),
      'email' => $user->getEmail(),
      'slug' => $user->getSlug(),
      'image_id' => $user->getImageId(),
      'created_at' => $user->getCreatedAt(),
      'updated_at' => $user->getUpdatedAt()
    ];
  }
}