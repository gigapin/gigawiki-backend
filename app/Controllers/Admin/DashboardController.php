<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\ProjectModel;
use App\Models\TestModel;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Src\ApiResponse;
use Src\Controller;
use Src\DB;
use Src\ErrorHandling\ApiErrorHandler;

class DashboardController extends Controller
{
  private ProjectModel $project;
  private TestModel $test;

  public function __construct()
  {
    $this->project = new ProjectModel();
    $this->test = new TestModel();
  }

  /**
   * @throws Exception
   * @throws ORMException
   */
  public function index(): void
  {
    $tests = $this->test->getTests();

    $data = array_map(fn($test) => [
      "id" => $test->getId(),
      "name" => $test->getName(),
      "city" => $test->getCity(),
    ], $tests);

    echo ApiResponse::get('/admin/dashboard', [
      "data" => $data,
    ]);
  }

  /**
   * @throws Exception
   */
  public function show(int $id)
  {
    $test = $this->test->show($id);

    echo ApiResponse::get('/admin/dashboard/show', [
      "name" => $test->getName(),
      "city" => $test->getCity(),
    ]);
  }

  /**
   * @throws ORMException
   * @throws Exception
   */
  public function create(): void
  {
    try {
      $data = ApiResponse::post();
      if ($data === null) {
        throw new Exception('Test not created');
      }

      if (empty($data['name'])) {
        throw new Exception('Name is required');
      }
      if (empty($data['city'])) {
        throw new Exception('City is required');
      }

      $test = $this->test->create($data);

      echo ApiResponse::jsonResponse([
        "message" => "Test created!",
        "id" => $test->getId(),
        "name" => $test->getName(),
        "city" => $test->getCity(),
      ]);
    } catch (Exception $exception) {
      echo ApiErrorHandler::exceptionHandler($exception);
    }
  }

  public function update(int $id)
  {
    $data = ApiResponse::put();
    if ($data === null) {
      throw new Exception('Test not updated');
    }

    if (!$data['id']) {
      throw new Exception('Test not found');
    }

    $test = $this->test->update($id, $data);
    if ($test->getName() === "") {
      throw new Exception('Test not updated');
    }

    echo ApiResponse::jsonResponse([
      "message" => "Test updated!",
      "name" => $test->getName(),
      "city" => $test->getCity(),
    ]);
  }

  public function delete(int $id)
  {
    try {
      $data = ApiResponse::delete();
      if ($data === null) {
        throw new Exception('Test not deleted');
      }
      var_dump($data);
      $test = $this->test->delete($id);
      var_dump($test);

      echo ApiResponse::jsonResponse([
        "message" => "Test deleted!",
      ]);
    } catch (Exception $exception) {
      echo ApiErrorHandler::exceptionHandler($exception);
    }

  }
}