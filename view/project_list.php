<?php include("header.php") ?>
    <div class="container mx-auto py-8 p-10">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white">Projects</h1>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="?action=create" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"> + Add New Project </a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($projects as $project): ?>
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2"><?= $project["name"] ?></h2>
                        <p class="text-gray-600 mb-4"><?= $project["description"] ?></p>
                        <p class="text-sm text-gray-500">Created at: <?= $project["created_at"] ?></p>
                    </div>
                    
                        <div class="mt-4 flex space-x-2">
                            <a href="?action=kanban&id=<?= $project["id"] ?>" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition"> View </a>
                            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <a href="view/project_edit_form.php?id=<?= $project["id"] ?>" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition"> Edit </a>
                            <a href="?action=delete_project&id=<?= $project["id"] ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition"> Delete </a>
                            <?php endif; ?>
                          </div>
                    
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
