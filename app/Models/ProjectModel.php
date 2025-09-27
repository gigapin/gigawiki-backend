<?php

namespace App\Models;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use Src\Model;
use Src\QueryBuilder;
use App\Entity\Project;

class ProjectModel extends Model
{
  protected Project $project;

  public function __construct()
  {
    $this->project = new Project();
  }
  /**
   * @throws \Exception
   * @throws ORMException
   */
  /*public function getProjects(): array
  {
    $stmt = Model::db()->prepare('SELECT * FROM projects');
    $result = $stmt->executeQuery();

    return $result->fetchAllAssociative();
  }*/

  public function getProjects(): array
  {
    $modelRepository = Model::db()->getRepository(\App\Entity\Project::class);

    return $modelRepository->findAll();
  }



  /**Ø
   * @throws ORMException
   * @throws \Exception
   */
  public function createProject(): void
  {
    $project = new Project();
    /*$project->setName('Andromeda');
    $project->setDescription('Project Test Description');
    $project->setUserId(1);
    $project->setCreatedAt(new \DateTime());
    $project->setUpdatedAt(new \DateTime());
    $project->setDeletedAt(new \DateTime());
    $project->setSubjectId(1);
    $project->setSlug('andromeda');
    $project->setImageId(1);
    $project->setVisibility(1);*/
    var_dump($project);

    Model::db()->persist($project);
    echo 'Project created!';
    Model::db()->flush();


  }
}