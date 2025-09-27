<?php
namespace Resources\Views\Dashboard;

/* @var $projects array */
?>

<?php include '../resources/views/layout/base.php'; ?>

<h2 class="text-white">Dashboard</h2>

<h3>Projects</h3>
<div>
  <?php foreach ($projects as $project): ?>
  <p><?= $project->name; ?></p>
<?php endforeach; ?>
</div>

<?php include '../resources/views/layout/footer.php'; ?>