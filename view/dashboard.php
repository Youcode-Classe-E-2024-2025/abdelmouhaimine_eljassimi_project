<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-6">
<nav class="bg-gray-800 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-blue-500 font-bold text-2xl">OCTOM.</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="?action=kanban&id=11" class="text-white px-3 py-2 rounded-md text-sm font-medium">Tasks</a>
                            <a href="?action=list" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                <?php $id = $_GET["id"] ?>
                            <a href="?action=dashboard&id=<?=$id?>" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <div class="ml-3 relative">
                            <div>
                                <button class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </button>
                            </div>
                        </div>
                        <a href="?action=logout"><i class='bx bx-log-out text-gray-300 text-2xl ml-4'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="relative">
                <input type="search" placeholder="Search anything..." class="bg-gray-800 text-white rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">Task Completed</h2>
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold mb-2"><?= count($tasks) ?>+ more</p>
                <p class="text-gray-400">from last week</p>
                <div class="mt-4 h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-purple-500 rounded-full" style="width: 70%;"></div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">New Task</h2>
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold mb-2">10+ more</p>
                <p class="text-gray-400">from last week</p>
                <div class="mt-4 h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full" style="width: 60%;"></div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">Project Done</h2>
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold mb-2">08+ more</p>
                <p class="text-gray-400">from last week</p>
                <div class="mt-4 h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-green-500 rounded-full" style="width: 80%;"></div>
                </div>
            </div>
        </div>

        <!-- Task Chart -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Task Done</h2>
                <div class="flex space-x-4">
                    <button class="text-gray-400 hover:text-white">Daily</button>
                    <button class="text-gray-400 hover:text-white">Weekly</button>
                    <button class="text-blue-500">Monthly</button>
                </div>
            </div>
            <div class="h-64 bg-gray-700 rounded-lg">
            <canvas id="myChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Task List -->
        <div class="bg-gray-800 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">Task</h2>
            <div class="space-y-4">
                <div class="bg-gray-700 rounded-lg p-4">
                    <?php foreach ($tasks as $Task): ?>
                    <div class="flex items-center">
                        <button class="mr-4 bg-blue-500 rounded-full p-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            </svg>
                        </button>
                        <div class="flex-grow">
                            <h3 class="font-semibold"><?= $Task["title"] ?></h3>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <span class="mr-4">Start from <?= $Task["created_at"] ?></span>
                                <a href="#" class="text-blue-400 mr-4"><?= $Task["description"] ?></a>
                            </div>
                        </div>
                        <div class="text-right">
                        <?php $por = rand(0,100)?>
                            <p class="text-sm text-gray-400"><?= $por ?>% complete</p>
                            <div class="mt-2 h-2 w-24 bg-gray-600 rounded-full">
                                <div class="h-2 bg-blue-500 rounded-full" style="width: <?= $por ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
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
            borderColor: '#A855F7',
            backgroundColor: 'rgba(168, 85, 247, 0.2)',
            tension: 0.1,
            fill: false
        },
    ]
};

const ctx = document.getElementById('myChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                stepSize: 1,
            }
        }
    }
});

const canvas = document.getElementById('myChart');
canvas.style.width = "100%";
canvas.style.height = "400px";

    </script>
    </body>
    </html>