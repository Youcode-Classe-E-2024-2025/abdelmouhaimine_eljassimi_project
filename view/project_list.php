<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projects</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen">
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

  <div class="container mx-auto py-8 p-10">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-white">Projects</h1>
      <a href="#"
         class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        + Add New Project
      </a>
    </div>
    <!-- Projects Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <!-- Static Card 1 -->
      <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
        <div>
          <h2 class="text-xl font-bold text-gray-800 mb-2">Project Alpha</h2>
          <p class="text-gray-600 mb-4">This is a brief description of Project Alpha.</p>
          <p class="text-sm text-gray-500">Deadline: 2024-12-31</p>
        </div>
        <div class="mt-4 flex space-x-2">
          <a href="#"
             class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition">
            View
          </a>
          <a href="#"
             class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
            Edit
          </a>
          <a href="#"
             class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition">
            Delete
          </a>
        </div>
      </div>

      <!-- Static Card 2 -->
      <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
        <div>
          <h2 class="text-xl font-bold text-gray-800 mb-2">Project Beta</h2>
          <p class="text-gray-600 mb-4">This is a brief description of Project Beta.</p>
          <p class="text-sm text-gray-500">Deadline: 2025-01-15</p>
        </div>
        <div class="mt-4 flex space-x-2">
          <a href="#"
             class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition">
            View
          </a>
          <a href="#"
             class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
            Edit
          </a>
          <a href="#"
             class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition">
            Delete
          </a>
        </div>
      </div>

      <!-- Static Card 3 -->
      <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
        <div>
          <h2 class="text-xl font-bold text-gray-800 mb-2">Project Gamma</h2>
          <p class="text-gray-600 mb-4">This is a brief description of Project Gamma.</p>
          <p class="text-sm text-gray-500">Deadline: 2025-02-01</p>
        </div>
        <div class="mt-4 flex space-x-2">
          <a href="#"
             class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition">
            View
          </a>
          <a href="#"
             class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
            Edit
          </a>
          <a href="#"
             class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition">
            Delete
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
