<?php
if (isset($_SESSION['user_id'])) {
    header('location: index.php?action=list');
    exit();

}

require_once "csrfToken.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background: linear-gradient(-45deg, #1a1a2e, #16213e, #1f3460, #24426e);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        .glass-effect {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(17, 25, 40, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }
        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center animate-gradient">
    <div class="w-full max-w-md glass-effect rounded-xl shadow-2xl p-8 hover-scale">
        <h2 id="authTitle" class="text-3xl font-bold text-white mb-4 text-center">Welcome Back</h2>
        <p id="authDescription" class="text-gray-300 text-center mb-8">Sign in to your account to continue</p>
        
        <form action="?action=signin" method="POST" id="authForm" class="space-y-6">
           <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" id="email" name="email" required 
                    class="mt-1 block h-12 w-full rounded-lg bg-gray-700 border-transparent text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500" 
                    placeholder=" john@example.com">
            </div>
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" name="password" required 
                    class="mt-1 h-12 block w-full rounded-lg bg-gray-700 border-transparent text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500" 
                    placeholder=" Your password">
            </div>
            <button type="submit" 
                class="w-full py-3 px-4 rounded-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 ease-in-out">
                Sign In
            </button>
        </form>

        <div class="mt-8">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 text-gray-300 bg-transparent">Or continue with</span>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <a href="view/login_google.php" 
                    class="w-full py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white border border-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center transition-all duration-300 ease-in-out">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                    </svg>
                    Sign in with Google
                </a>

                <a href="?action=visitor" 
                    class="w-full py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white border border-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center transition-all duration-300 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Enter as Visitor
                </a>
            </div>
        </div>

        <p class="mt-6 text-sm text-center">
            <span id="authToggleText" class="text-gray-300">Don't have an account?</span>
            <a href="?action=signupForm" type="button" id="authToggle" 
                class="ml-1 font-medium text-indigo-400 hover:text-indigo-300 focus:outline-none transition-colors duration-300">
                Sign Up
            </a>
        </p>
    </div>
    <script src="../javascript/main.js"></script>
</body>
</html>