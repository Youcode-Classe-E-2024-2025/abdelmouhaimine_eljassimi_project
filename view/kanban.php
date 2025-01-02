<?php include("header.php") ?>
    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 border-r border-gray-700 overflow-y-auto">
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-4">Projects</h2>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300  hover:text-white">Website Redesign</a></li>
                    <li><a href="#" class="text-gray-300  hover:text-white">Mobile App Development</a></li>
                    <li><a href="#" class="text-gray-300  hover:text-white">Marketing Campaign</a></li>
                </ul>
            </div>
            <div class="p-4 border-t border-gray-700">
                <h2 class="text-lg font-semibold mb-4">Team Members</h2>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <img class="h-8 w-8 rounded-full mr-2" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <span class="text-gray-300">John Doe</span>
                    </li>
                    <li class="flex items-center">
                        <img class="h-8 w-8 rounded-full mr-2" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <span class="text-gray-300">Jane Smith</span>
                    </li>
                    <li class="flex items-center">
                        <img class="h-8 w-8 rounded-full mr-2" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" alt="">
                        <span class="text-gray-300">Mike Johnson</span>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <header class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold">Task Board</h1>
                    <?php $id=$_GET["id"]; ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <a href="?action=create_task&id=<?=$id?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg flex items-center"> + Add New Task</a>
                    <?php endif; ?>
                </header>
                <!-- Kanban Board -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Todo Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                            Todo
                        </h2>
                        <?php $todoTasks = array_filter($tasks, function($task) { return $task['status'] === 'todo';}); ?>
                        <div class="space-y-4">
                            <?php foreach ($todoTasks as $todoTask):?>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="flex justify-between">
                                    <h3 class="font-medium mb-2"><?= $todoTask["title"] ?></h3>
                                    <div>
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                        <a href="?action=deleteTask&idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>"><i class='bx bx-trash text-red-600' ></i></a>
                                    <?php endif;?>
                                        <a href="view/task_edit_form.php?idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>"><i class='bx bxs-edit text-blue-600'></i></a>
                                    </div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Limit Date: <?= $todoTask["due_date"] ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Doing Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                            Doing
                        </h2>
                        <?php $doingTasks = array_filter($tasks, function($task) { return $task['status'] === 'doing';}); ?>
                        <div class="space-y-4">
                            <?php foreach ($doingTasks as $doingTask):?>
                            <div class="bg-gray-700 p-4 rounded-lg">
                            <div class="flex justify-between">
                                    <h3 class="font-medium mb-2"><?= $doingTask["title"] ?></h3>
                                    <div>
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                        <a href="?action=deleteTask&idTask=<?=$doingTask["id"]?>&idProject=<?=$id?>"><i class='bx bx-trash text-red-600' ></i></a>
                                    <?php endif;?>
                                        <a href="view/task_edit_form.php?idTask=<?=$doingTask["id"]?>&idProject=<?=$id?>"><i class='bx bxs-edit text-blue-600'></i></a>
                                    </div>                                
                            </div>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Limit Date: <?= $doingTask["due_date"] ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Review Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                            Review
                        </h2>
                        <?php $todoTasks = array_filter($tasks, function($task) { return $task['status'] === 'review';}); ?>
                        <div class="space-y-4">
                            <?php foreach ($todoTasks as $todoTask):?>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="flex justify-between">
                                    <h3 class="font-medium mb-2"><?= $todoTask["title"] ?></h3>
                                    <div>
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                        <a href="?action=deleteTask&idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>"><i class='bx bx-trash text-red-600' ></i></a>
                                    <?php endif;?>
                                        <a href="view/task_edit_form.php?idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>"><i class='bx bxs-edit text-blue-600'></i></a>
                                    </div>                                </div>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Limit Date: <?= $todoTask["due_date"] ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Done Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            Done
                        </h2>
                        <?php $todoTasks = array_filter($tasks, function($task) { return $task['status'] === 'done';}); ?>
                        <div class="space-y-4">
                            <?php foreach ($todoTasks as $todoTask):?>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="flex justify-between">
                                    <h3 class="font-medium mb-2"><?= $todoTask["title"] ?></h3>
                                    <div>
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                        <a href="?action=deleteTask&idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>"><i class='bx bx-trash text-red-600' ></i></a>
                                    <?php endif;?>
                                        <a href="view/task_edit_form.php?idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>"><i class='bx bxs-edit text-blue-600'></i></a>
                                    </div>                                
                                </div>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Limit Date: <?= $todoTask["due_date"] ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>