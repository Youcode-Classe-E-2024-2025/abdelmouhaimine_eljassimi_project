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
                <p class="text-3xl font-bold mb-2">10+ more</p>
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
                    <div class="flex items-center">
                        <button class="mr-4 bg-blue-500 rounded-full p-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            </svg>
                        </button>
                        <div class="flex-grow">
                            <h3 class="font-semibold">Search Inspiration for project</h3>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <span class="mr-4">Start from 9:00 am</span>
                                <a href="#" class="text-blue-400 mr-4">www.uistore.com</a>
                                <span>8 comments</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-400">24% complete</p>
                            <div class="mt-2 h-2 w-24 bg-gray-600 rounded-full">
                                <div class="h-2 bg-blue-500 rounded-full" style="width: 24%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <button class="mr-4 bg-blue-500 rounded-full p-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            </svg>
                        </button>
                        <div class="flex-grow">
                            <h3 class="font-semibold">Design System for project</h3>
                            <div class="flex items-center text-sm text-gray-400 mt-2">
                                <span class="mr-4">Start from 3:00 pm</span>
                                <a href="#" class="text-blue-400 mr-4">www.uistore.org</a>
                                <span>5 comments</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-400">60% complete</p>
                            <div class="mt-2 h-2 w-24 bg-gray-600 rounded-full">
                                <div class="h-2 bg-blue-500 rounded-full" style="width: 60%;"></div>
                            </div>
                        </div>
                    </div>
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
                    tension: 0.1
                }
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