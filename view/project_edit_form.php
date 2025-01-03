<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php?action=SignFrom");
    exit;
}
require_once "../config.php";
$database = new Database();
$db = $database->getConnection();

$id = $_GET["id"];
$name = $db->query("SELECT name FROM projects WHERE id = $id")->fetchColumn();
$description = $db->query("SELECT description FROM projects WHERE id = $id")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Project</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Project</h1>
    <form action="http://localhost/abdelmouhaimine_eljassimi_project/index.php?action=edit_project" method="POST">

      <div class="mb-4">
       
        <input type="hidden" name="id" value="<?= $id ?>">
        <label for="name" class="block text-gray-700 font-medium mb-2">Project Name</label>
        <input type="text" id="name" name="name" 
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
               placeholder="Enter project name" value="<?=$name?>" required>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
        <textarea id="description" name="description" rows="4" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                  placeholder="Describe your project" required><?=$description?></textarea>
      </div>

      <div class="flex justify-end">
        <button type="submit" 
                class="bg-green-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-green-600 transition"> Edit Project </button>
      </div>
    </form>
  </div>
</body>
</html>
