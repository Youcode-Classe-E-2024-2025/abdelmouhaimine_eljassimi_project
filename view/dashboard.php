<?php include("header.php") ?>
<body class="bg-gray-900 text-white min-h-screen p-6">

    <div class="max-w-7xl mx-auto mt-6 space-y-8">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="relative w-full sm:w-auto mt-4 sm:mt-0">
                <input type="search" placeholder="Search anything..." class="bg-gray-800 text-white w-full sm:w-64 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">Task Completed</h2>
                <p class="text-3xl font-bold mb-2"><?= count($tasks) ?>+</p>
                <p class="text-gray-400 mb-4">from last week</p>
                <div class="h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-purple-500 rounded-full" style="width: 70%;"></div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">New Task</h2>
                <p class="text-3xl font-bold mb-2">10+</p>
                <p class="text-gray-400 mb-4">from last week</p>
                <div class="h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full" style="width: 60%;"></div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">Project Done</h2>
                <p class="text-3xl font-bold mb-2">08+</p>
                <p class="text-gray-400 mb-4">from last week</p>
                <div class="h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-green-500 rounded-full" style="width: 80%;"></div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-gray-800 rounded-lg p-6 chart-container">
            <h2 class="text-xl font-semibold mb-4">Task Status</h2>
            <canvas id="barChart"></canvas>
        </div>

        <!-- Task List -->
        <div class="bg-gray-800 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Task</h2>
            <div class="space-y-4">
                <?php foreach ($tasks as $Task): ?>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-semibold"><?= $Task["title"] ?></h3>
                        <p class="text-sm text-gray-400 mt-2"><?= $Task["description"] ?></p>
                        <p class="text-xs text-gray-500 mt-2">Started at <?= $Task["created_at"] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<div class="max-w-7xl mx-auto mt-6 space-y-8">
    <form class="mt-6 bg-gray-700 p-4 rounded-lg">
        <h3 class="font-semibold text-lg mb-4">Add Custom Role</h3>
        <div class="flex flex-col gap-4">
            <div>
                <label for="roleName" class="block text-sm font-medium text-gray-400 mb-1">Role : </label>
                <select name="role" class="select2-users block w-full bg-gray-700 border border-gray-600 rounded-lg text-white" id="role">
                 <option value="1">Chef de Projet</option>
                 <option value="2">Membre</option>
                </select>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-blue-400">Permissions</h2>
                <select name="permissions[]" id="permissions" multiple required class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select">
                    <option value="1">Créer une tâche</option>
                    <option value="2">Éditer une tâche</option>
                    <option value="3">Supprimer une tâche</option>
               </select>
            </div>
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
            Add Role
        </button>
    </form>
</div>

    <?php
        $todoTasks = array_filter($tasks, function($task) { return $task['status'] === 'todo';});
        $doingTasks = array_filter($tasks, function($task) { return $task['status'] === 'doing';});
        $reviewTasks = array_filter($tasks, function($task) { return $task['status'] === 'review';});
        $doneTasks = array_filter($tasks, function($task) { return $task['status'] === 'done';});
    ?>

    <script>
        const todoTasks = <?= json_encode(count($todoTasks)) ?>;
        const doingTasks = <?= json_encode(count($doingTasks)) ?>;
        const reviewTasks = <?= json_encode(count($reviewTasks)) ?>;
        const doneTasks = <?= json_encode(count($doneTasks)) ?>;

        const data = {
            labels: ['To Do', 'Doing', 'Review', 'Done'],
            datasets: [
                {
                    label: 'Task Status',
                    data: [todoTasks, doingTasks, reviewTasks, doneTasks],
                    backgroundColor: ['#ffd800', '#3B82F6', '#ff3838', '#10B981'],
                    borderWidth: 1,
                    barThickness: 60,
                }
            ]
        };

        const ctx = document.getElementById('barChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false, // Maintain ratio, preventing overflow
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });

        $(document).ready(function() {
        $('.chosen-select').chosen({
            width: '100%',
            placeholder_text_multiple: 'Select users'
        });
    });
    </script>
</body>
</html>
