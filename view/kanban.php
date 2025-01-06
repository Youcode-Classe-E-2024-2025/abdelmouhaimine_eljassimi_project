<?php 
require_once("model/tagModel.php");
$tags = new tag();

 ?>
<?php include("header.php") ?>
<div class="flex-1 flex overflow-hidden bg-gray-900 min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 border-r border-gray-700 overflow-y-auto hidden lg:block">
        <div class="p-6">
            <h2 class="text-xl font-bold text-white mb-6">Projects</h2>
            <nav class="space-y-3">
                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Website Redesign
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Mobile App Development
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    Marketing Campaign
                </a>
            </nav>
        </div>
        <div class="p-6 border-t border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6">Team Members</h2>
            <div class="space-y-4">
            <?php forEach($members as $member): ?>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                    <div class="relative h-10 w-10 rounded-full ring-2 ring-gray-700 flex items-center justify-center bg-gray-900 text-white font-bold">
                        <img class="h-full w-full rounded-full object-cover" src=""  alt=""   onerror="this.style.display='none';">
                        <span>
                            <?=preg_match('/[a-zA-Z]/', $member["name"], $matches) ? $matches[0] : ''?>
                        </span>
                    </div>                      
                      <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full ring-2 ring-gray-800"></span>
                    </div>
                    <div class="w-full flex justify-between">
                        <p class="text-sm font-medium text-white"><?=$member["name"]?></p>
                        <div>
                            <a href="?action=deleteUser&idUser=<?=$member["id"]?>&idProject=<?=$id?>" class="text-red-400 hover:text-red-300 transition-colors">
                                <i class='bx bx-trash text-xl'></i>
                            </a>
                            <a href="view/RolePermissions.php?idUser=<?=$member["id"]?>&idProject=<?=$id?>" class="text-blue-400 hover:text-blue-300 transition-colors">
                                <i class='bx bxs-edit text-xl'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">
        <div class="max-w-7xl mx-auto p-6">
            <!-- Header -->
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Task Board</h1>
                    <p class="text-gray-400 mt-1">Track your project's progress</p>
                </div>
                <?php $id=$_GET["id"]; ?>
                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="?action=create_task&id=<?=$id?>" 
                   class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Task
                </a>
                <?php endif; ?>
            </header>

            <!-- Kanban Board -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Todo Column -->
                <?php
                $todoTasks = array_filter($tasks, function($task) { return $task['status'] === 'todo';}); ?>
                <div class="bg-gray-800/50 rounded-xl p-4" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>Todo
                        </h2>
                        <div class="w-8 h-6 bg-yellow-500 text-white flex justify-center items-center rounded-full text-xl font-bold shadow-md">
                          <?= count($todoTasks) ?>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php foreach ($todoTasks as $todoTask):?>
                            <?php   $tag = $tags->getTaskTag($todoTask['id']); ?>
                        <div class="group bg-gray-700 hover:bg-gray-600 rounded-lg p-4 transition-all mb-4" draggable="true" ondragstart="drag(event)" id="task-<?= $todoTask['id'] ?>">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-white mb-2"><?= $todoTask["title"] ?></h3>
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="?action=deleteTask&idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-red-400 hover:text-red-300 transition-colors">
                                        <i class='bx bx-trash text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                    <?php if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'member' ): ?>
                                    <a href="view/task_edit_form.php?idTask=<?=$todoTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <i class='bx bxs-edit text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Due: <?= $todoTask["due_date"] ?></span>
                            </div>
                            <?php if ($tag): ?>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                        style="background-color: <?= $tag['color'] ?>">
                                        <?= $tag["name"] ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Doing Column -->
                <?php $doingTasks = array_filter($tasks, function($task) { return $task['status'] === 'doing';}); ?>
                <div class="bg-gray-800/50 rounded-xl p-4" ondrop="drop(event)" ondragover="allowDrop(event)">
                <div class="flex justify-between">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>In Progress
                        </h2>
                        <div class="w-8 h-6 bg-blue-500 text-white flex justify-center items-center rounded-full text-xl font-bold shadow-md">
                          <?= count($doingTasks) ?>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php foreach ($doingTasks as $doingTask):?>
                          <?php   $tag = $tags->getTaskTag($doingTask['id']); ?>
                        <div class="group bg-gray-700 hover:bg-gray-600 rounded-lg p-4 transition-all mb-4" draggable="true" ondragstart="drag(event)" id="task-<?= $doingTask['id'] ?>">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-white mb-2"><?= $doingTask["title"] ?></h3>
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="?action=deleteTask&idTask=<?=$doingTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-red-400 hover:text-red-300 transition-colors">
                                        <i class='bx bx-trash text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                    <?php if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'member' ): ?>
                                    <a href="view/task_edit_form.php?idTask=<?=$doingTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <i class='bx bxs-edit text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Due: <?= $doingTask["due_date"] ?></span>
                            </div>
                            <?php if ($tag): ?>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                        style="background-color: <?= $tag['color'] ?>">
                                        <?= $tag["name"] ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Review Column -->
                <?php $reviewTasks = array_filter($tasks, function($task) { return $task['status'] === 'review';}); ?>
                <div class="bg-gray-800/50 rounded-xl p-4" ondrop="drop(event)" ondragover="allowDrop(event)">
                     <div class="flex justify-between">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>Review
                        </h2>
                        <div class="w-8 h-6 bg-red-500 text-white flex justify-center items-center rounded-full text-xl font-bold shadow-md">
                          <?= count($reviewTasks) ?>
                        </div>
                    </div>
                    <?php $reviewTasks = array_filter($tasks, function($task) { return $task['status'] === 'review';}); ?>
                    <div class="space-y-4">
                        <?php foreach ($reviewTasks as $reviewTask):?>
                            <?php   $tag = $tags->getTaskTag($reviewTask['id']); ?>
                        <div class="group bg-gray-700 hover:bg-gray-600 rounded-lg p-4 transition-all mb-4" draggable="true" ondragstart="drag(event)" id="task-<?= $reviewTask['id'] ?>">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-white mb-2"><?= $reviewTask["title"] ?></h3>
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="?action=deleteTask&idTask=<?=$reviewTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-red-400 hover:text-red-300 transition-colors">
                                        <i class='bx bx-trash text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                    <?php if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'member' ): ?>
                                    <a href="view/task_edit_form.php?idTask=<?=$reviewTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <i class='bx bxs-edit text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Due: <?= $reviewTask["due_date"] ?></span>
                            </div>
                            <?php if ($tag): ?>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                        style="background-color: <?= $tag['color'] ?>">
                                        <?= $tag["name"] ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Done Column -->
                <?php $doneTasks = array_filter($tasks, function($task): bool { return $task['status'] === 'done';}); ?>
                <div class="bg-gray-800/50 rounded-xl p-4" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>Done
                        </h2>
                        <div class="w-8 h-6 bg-green-500 text-white flex justify-center items-center rounded-full text-xl font-bold shadow-md">
                          <?= count($doneTasks) ?>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php foreach ($doneTasks as $doneTask):?>
                            <?php   $tag = $tags->getTaskTag($doingTask['id']); ?>
                        <div class="group bg-gray-700 hover:bg-gray-600 rounded-lg p-4 transition-all mb-4" draggable="true" ondragstart="drag(event)" id="task-<?= $doneTask['id'] ?>">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-white mb-2"><?= $doneTask["title"] ?></h3>
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="?action=deleteTask&idTask=<?=$doneTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-red-400 hover:text-red-300 transition-colors">
                                        <i class='bx bx-trash text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                    <?php if ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'member' ): ?>
                                    <a href="view/task_edit_form.php?idTask=<?=$doneTask["id"]?>&idProject=<?=$id?>" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <i class='bx bxs-edit text-xl'></i>
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Due: <?= $doneTask["due_date"] ?></span>
                            </div>
                            <?php if ($tag): ?>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                        style="background-color: <?= $tag['color'] ?>">
                                        <?= $tag["name"] ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button (visible only on mobile) -->
            <button type="button" 
                    class="lg:hidden fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-full shadow-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>
    </main>
</div>

<script>
    function allowDrop(event) {
        event.preventDefault(); // Allow dropping
    }

    function drag(event) {
        // Set the dragged element's ID in the data transfer object
        event.dataTransfer.setData("text", event.target.id);
    }

    function drop(event) {
        event.preventDefault();
        // Get the dragged element's ID
        const taskId = event.dataTransfer.getData("text");
        const taskElement = document.getElementById(taskId);

        // Append the dragged task to the new container
        event.target.appendChild(taskElement);
    }
</script>