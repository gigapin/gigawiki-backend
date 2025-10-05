<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Activity;
use App\Models\View;
use Exception;
use Src\ApiResponse;
use Src\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Page;
use App\Models\Subject;

class DashboardController extends Controller
{
  /**
   * @throws Exception
   */
  public function index(): void
  {
   echo ApiResponse::get('/api/v1/admin/dashboard', [
      'projects' => Project::getProjects(1),
      'activities' => Activity::showAllActivities(2),
      'views' => View::showAllViews(1),
      'user' => User::getUser(1),
      'project_latest' => Project::getLatestProjects(1),
      'pages' => Page::getLatestPages(1),
      'projects_all' => Project::getProjects(1),
      'rows' => Subject::getSubjects(1),
      'url' => View::getMoreViews()
    ]);
  }
}