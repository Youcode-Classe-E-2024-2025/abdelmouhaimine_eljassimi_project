<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-md p-8">
        <h2 id="authTitle" class="text-2xl font-bold text-white mb-4 text-center">Sign In</h2>
        <p id="authDescription" class="text-white text-center mb-6">Sign in to your account to continue</p>
        
        <form id="authForm" class="space-y-4">
            <div id="nameField" class="hidden">
                <label for="name" class="block text-sm font-medium text-white">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block h-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="John Doe">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block h-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder=" john@example.com">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 h-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder=" Your password">
            </div>
            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign In
            </button>
        </form>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-900">Or continue with</span>
                </div>
            </div>

            <div class="mt-6">
                <button onclick="window.location.href='google_login.php'" class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-black bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                    </svg>
                    Sign in with Google
                   </button>
            </div>
        </div>

        <p class="mt-4 text-sm text-center">
            <span id="authToggleText ">Don't have an account?</span>
            <button type="button" id="authToggle" class="ml-1 font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none">
                Sign Up
            </button>
        </p>
    </div>
    <script src="../javascript/main.js"></script>
</body>
</html>

