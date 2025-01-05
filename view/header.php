<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php?action=SignFrom");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            height: 400px;
        }
        #mobileMenu {
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
            visibility: hidden;
            opacity: 0;        
        }

        #mobileMenu.open {
            max-height: 200px; 
            visibility: visible;
            opacity: 1;
        }
</style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">
<div class="flex-1 flex overflow-hidden bg-gray-900 min-h-screen">
    <!-- Mobile Navigation Bar -->
    <nav class="lg:hidden fixed top-0 left-0 right-0 bg-gray-800 z-50">
        <div class="px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-white text-lg font-semibold">Task Manager</span>
                </div>
                <button type="button" id="mobileMenuButton" 
                        class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu Dropdown -->
        <div id="mobileMenu" class="px-2 pb-3 space-y-1">
                <a href="?action=list" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                    Projects
                </a>
                <?php $action = $_GET["action"]?>
                <?php if ($_SESSION['user_role'] === 'admin' || $action == "list"): ?>
                                <?php $id = $_GET["id"] ?>
                            <a href="?action=dashboard&id=<?=$id?>" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <?php endif; ?>
         </div>
    </nav>

    <!-- Ajuster le padding-top du main content pour la barre de navigation mobile -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 lg:pt-0 pt-16">
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
                            <?php if ($_SESSION['user_role'] === 'admin' || $action != "list"): ?>
                                <?php $id = isset($_GET["id"]) ? $_GET["id"] : ''; ?>
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
<script>

document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript loaded!'); // Debugging log
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    let isMobileMenuOpen = false;

    function toggleMobileMenu() {
        isMobileMenuOpen = !isMobileMenuOpen;
        console.log('Menu toggled:', isMobileMenuOpen); // Debugging log
        if (isMobileMenuOpen) {
            mobileMenu.classList.add('open');
        } else {
            mobileMenu.classList.remove('open');
        }
    }

    mobileMenuButton.addEventListener('click', toggleMobileMenu);

    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (isMobileMenuOpen) {
                toggleMobileMenu();
            }
        });
    });
});

</script>
</body>
</html>