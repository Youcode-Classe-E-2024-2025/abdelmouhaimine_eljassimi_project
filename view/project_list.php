<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php?action=SignFrom");
    exit;
}
?>
<?php include("header.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
<div class="min-h-screen bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-3xl font-bold text-white">Projects</h1>
        <p class="mt-2 text-gray-400">Manage and track your ongoing projects</p>
      </div>
      <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <a href="?action=create" 
           class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition duration-150 ease-in-out">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Add New Project
        </a>
      <?php endif; ?>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($projects as $project): ?>
        <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden hover:ring-2 hover:ring-blue-500 transition duration-300">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-xl font-bold text-white truncate"><?= $project["name"] ?></h2>
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                Active
              </span>
            </div>
            
            <p class="text-gray-400 mb-4 line-clamp-2"><?= $project["description"] ?></p>
            
            <div class="flex items-center text-sm text-gray-500">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <span>Created: <?= $project["created_at"] ?></span>
            </div>
          </div>

          <div class="px-6 py-4 bg-gray-700 bg-opacity-50">
            <div class="flex justify-between items-center space-x-3">
              <a href="?action=kanban&id=<?= $project["id"] ?>" 
                 class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md transition">
                View Board
              </a>
              
              <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="view/project_edit_form.php?id=<?= $project["id"] ?>" 
                   class="inline-flex justify-center items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition">
                  Edit
                </a>
                <a href="?action=delete_project&id=<?= $project["id"] ?>" 
                   class="inline-flex justify-center items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition">
                  Delete
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
