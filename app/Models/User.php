<?php
declare(strict_types=1);

namespace App\Models;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use PHPUnit\Framework\ExpectationFailedException;
use Src\ApiResponse;
use Src\Model;
use App\Entity\User as UserEntity;

class User extends Model
{
  private static EntityRepository $entity;

  /**
   * @throws Exception
   */
  public function __construct()
  {
    self::$entity = Model::entityManager()->getRepository(UserEntity::class);
  }
  /**
   * @throws Exception
   */
  public static function getUser(int $userId): array
  {
    $user = self::$entity->find($userId);

    return [
      'name' => $user->getName(),
      'email' => $user->getEmail(),
      'slug' => $user->getSlug(),
      'image_id' => $user->getImageId(),
      'created_at' => $user->getCreatedAt(),
      'updated_at' => $user->getUpdatedAt()
    ];
  }

  /**
   * @throws Exception
   */
  public static function getUserByEmail(string $email, string $password): array|string|null
  {
    $user = Model::entityManager()
      ->getRepository(UserEntity::class)
      ->findOneBy(['email' => $email]);

    if (is_null($user)) {
      throw new Exception('User not valid', 401);
    }

    if (! password_verify($password, $user->getPassword())) {
      throw new Exception('Password not valid', 401);
    }

    return [
      'sub' => $user->getId(),
      'email' => $user->getEmail(),
    ];
  }
}