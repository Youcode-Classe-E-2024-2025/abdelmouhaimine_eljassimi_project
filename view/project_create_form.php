<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php?action=SignFrom");
    exit;
}
require_once "csrfToken.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="bg-gray-900 min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="bg-gray-800 shadow-2xl rounded-2xl p-8 w-full max-w-xl">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Create Project</h1>
                <p class="text-gray-400 mt-2">Fill in the details to create a new project</p>
            </div>

            <form action="?action=create_project" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <!-- Project Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Project Name
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required
                               class="block w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               placeholder="Enter project name">
                    </div>
                </div>

                <!-- Project Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                        Description
                    </label>
                    <div class="relative">
                        <textarea id="description" 
                                  name="description" 
                                  rows="4" 
                                  required
                                  class="block w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                  placeholder="Describe your project"></textarea>
                    </div>
                </div>

                <!-- Project acces -->
                <div>
                    <label for="Accesibility" class="block text-sm font-medium text-gray-300 mb-2">
                    Accesibility
                    </label>
                    <select name="accesibility" id="accesibility" class="select2-users block w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                      <option value="0">Public</option>
                      <option value="1">Private</option>
                    </select>
                </div>

                <!-- Team Members -->
                <div>
                    <label for="users" class="block text-sm font-medium text-gray-300 mb-2">
                        Team Members
                    </label>
                    <select name="users[]" 
                            id="users" 
                            multiple 
                            required 
                            class="select2-users block w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user["id"] ?>"><?= $user["name"] ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled><?= "No users available" ?></option>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="?action=projects" 
                       class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2-users').select2({
                theme: 'default select2-custom',
                placeholder: 'Select team members',
                allowClear: true,
                width: '100%',
                dropdownParent: $('.select2-users').parent(),
                templateResult: formatUser,
                templateSelection: formatUser
            });

            // Custom formatting for users
            function formatUser(user) {
                if (!user.id) return user.text;
                
                return $(`
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center">
                            ${user.text.charAt(0).toUpperCase()}
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium">${user.text}</div>
                        </div>
                    </div>
                `);
            }
        });
    </script>

    <style>
        /* Custom Select2 Styles */
        .select2-container--default .select2-selection--multiple {
            background-color: rgb(55, 65, 81) !important;
            border-color: rgb(75, 85, 99) !important;
            border-radius: 0.5rem !important;
            min-height: 48px !important;
            padding: 4px 8px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgb(59, 130, 246) !important;
            border: none !important;
            border-radius: 0.375rem !important;
            padding: 4px 8px !important;
            color: white !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white !important;
            margin-right: 5px !important;
        }

        .select2-dropdown {
            background-color: rgb(31, 41, 55) !important;
            border-color: rgb(75, 85, 99) !important;
            border-radius: 0.5rem !important;
            margin-top: 4px !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rgb(59, 130, 246) !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: rgb(55, 65, 81) !important;
            border-color: rgb(75, 85, 99) !important;
            color: white !important;
            border-radius: 0.375rem !important;
            padding: 6px 12px !important;
        }

        .select2-results__option {
            padding: 8px 12px !important;
            color: white !important;
        }
    </style>
</body>
</html>