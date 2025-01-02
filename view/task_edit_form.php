<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php?action=SignFrom");
    exit;
}
?>
<?php
require_once "../config.php";

$database = new Database();
$db = $database->getConnection();

$idTask = $_GET["idTask"];
$idProject = $_GET["idProject"] ;
$Task = $db->query("SELECT * FROM tasks WHERE id = $idTask")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Task</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Task</h1>
    <form action="http://localhost/abdelmouhaimine_eljassimi_project/index.php?action=EditTask" method="POST">
       <input type="hidden" name="taskid" value="<?=$idTask?>">
       <input type="hidden" name="projectid" value="<?=$idProject?>">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-medium mb-2">Task Title</label>
        <input type="text" id="name" name="name" 
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
               placeholder="Enter project name" value="<?=$Task['title']?>" required>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
        <textarea id="description" name="description" rows="4" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                  placeholder="Describe your project" required><?=$Task['description']?></textarea>
      </div>

      <div class="mb-4">
        <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
        <select name="status" class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select" id="status">
          <option value="todo">To Do</option>
          <option value="doing">Doing</option>
          <option value="review">Review</option>
          <option value="done">Done</option>
        </select>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-green-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-green-600 transition"> Edit Task </button>
      </div>
    </form>
  </div>
  <script>
    $(document).ready(function() {
        $('.chosen-select').chosen({
            width: '100%',
            placeholder_text_multiple: 'Select users'
        });
    });
  </script>
</body>
</html>
