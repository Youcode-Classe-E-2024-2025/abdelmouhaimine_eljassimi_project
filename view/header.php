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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
                <?php if ($_SESSION['user_role'] == '1'  || $_SESSION['user_role'] == '2'):?>
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
                            <?php if($_SESSION['user_role'] == '1' || $_SESSION['user_role'] == '2'): ?>
                                <?php $id = isset($_GET["id"]) ? $_GET["id"] : ''; ?>
                            <a href="?action=dashboard&id=<?=$id?>" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <?php endif; ?>
                                <?php $id = isset($_GET["id"]) ? $_GET["id"] : ''; ?>
                            <a href="?action=dashboardPerso&id=<?=$id?>" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Personel Dashboard</a>
                            <?php if($_SESSION['user_role'] == '1' || $_SESSION['user_role'] == '2'): ?>
                            <a href="?action=permissions" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Permissions</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center gap-4 md:ml-6">
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
                        <a href="?action=logout" class="Btn flex items-center justify-start w-[30px] h-[30px] border-none rounded-full cursor-pointer relative overflow-hidden transition-all duration-300 shadow-[2px_2px_10px_rgba(0,0,0,0.2)] bg-[#ff4141]">
                        <!-- Sign (SVG) -->
                        <div class="sign w-full transition-all duration-300 flex items-center justify-center">
                        <svg viewBox="0 0 512 512" class="w-[17px]">
                            <path fill="white" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg>
                        </div>
                        <!-- Text -->
                        <div class="text absolute right-0 w-0 opacity-0 text-white text-[1.2em] font-semibold transition-all duration-300">Logout</div>
                      </a>
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

    const button = document.querySelector('.Btn');
    const sign = document.querySelector('.sign');
    const text = document.querySelector('.text');

    button.addEventListener('mouseenter', () => {
      button.classList.add('w-[125px]', 'rounded-[40px]');
      sign.classList.add('w-[30%]', 'pl-[20px]');
      text.classList.add('opacity-100', 'w-[70%]', 'pr-[10px]');
    });

    button.addEventListener('mouseleave', () => {
      button.classList.remove('w-[125px]', 'rounded-[40px]');
      sign.classList.remove('w-[30%]', 'pl-[20px]');
      text.classList.remove('opacity-100', 'w-[70%]', 'pr-[10px]');
    });

    button.addEventListener('mousedown', () => {
      button.classList.add('translate-x-[2px]', 'translate-y-[2px]');
    });

    button.addEventListener('mouseup', () => {
      button.classList.remove('translate-x-[2px]', 'translate-y-[2px]');
    });

</script>
</body>
</html>