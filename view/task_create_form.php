<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php?action=SignFrom");
    exit;
}

require_once "csrfToken.php";

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
<body class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create a New Task</h1>
        <?php $id = $_GET["id"] ?>
        <form action="http://localhost/abdelmouhaimine_eljassimi_project/index.php?action=createTask&id=<?=$id?>" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
            
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">Task Title</label>
                <input type="text" id="name" name="name" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" 
                       placeholder="Enter task name" required>
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" name="description" rows="4" 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" 
                          placeholder="Describe your task" required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select transition duration-200" id="status">
                        <option value="todo">To Do</option>
                        <option value="doing">Doing</option>
                        <option value="review">Review</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div>
                    <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select transition duration-200" id="category">
                        <?php foreach ($Categorys as $Category): ?>
                            <option value="<?=htmlspecialchars($Category["id"])?>"><?=htmlspecialchars($Category["name"])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="tag" class="block text-gray-700 font-medium mb-2">Tag</label>
                    <select name="tag" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select transition duration-200" id="tag">
                        <?php foreach ($Tags as $Tag): ?>
                            <option value="<?=htmlspecialchars($Tag["id"])?>"><?=htmlspecialchars($Tag["name"])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="due_date" class="block text-gray-700 font-medium mb-2">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                </div>
            </div>

            <div>
                <label for="users" class="block text-gray-700 font-medium mb-2">Members</label>
                <select name="users[]" id="users" multiple required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select transition duration-200">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <option value="<?=htmlspecialchars($user["id"])?>"><?=htmlspecialchars($user["name"])?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value=""><?=htmlspecialchars("No users")?></option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-500 text-white font-medium px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                    Create Task
                </button>
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
