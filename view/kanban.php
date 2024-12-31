<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    <nav class="bg-gray-800 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-blue-500 font-bold text-2xl">OCTOM.</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Calendar</a>
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
                    </div>
                </div>
            </div>
        </div>
    </nav>

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
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Task
                    </button>
                </header>

                <!-- Kanban Board -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Todo Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                            Todo
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Research competitors</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>2 days left</span>
                                    <span>0/3</span>
                                </div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Brainstorm ideas</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>1 day left</span>
                                    <span>0/5</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doing Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                            Doing
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Design system</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>3 days left</span>
                                    <span>2/5</span>
                                </div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Create wireframes</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>1 day left</span>
                                    <span>3/7</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Review Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                            Review
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">User testing</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Due today</span>
                                    <span>1/1</span>
                                </div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Feedback implementation</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>2 days left</span>
                                    <span>0/3</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Done Column -->
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                            Done
                        </h2>
                        <div class="space-y-4">
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Project setup</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Completed</span>
                                    <span>5/5</span>
                                </div>
                            </div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium mb-2">Initial mockups</h3>
                                <div class="flex justify-between text-sm text-gray-400">
                                    <span>Completed</span>
                                    <span>3/3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>