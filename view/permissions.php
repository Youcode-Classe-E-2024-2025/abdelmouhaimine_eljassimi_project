<?php include("header.php") ?>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-white min-h-screen p-6">
    <div class="max-w-7xl mx-auto mt-6 space-y-12">
        <h1 class="text-4xl font-bold text-center mb-12">Role Management</h1>
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Edit Permissions Section -->
            <div class="bg-gray-700 p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-semibold mb-6 text-blue-400 border-b border-blue-400 pb-2">Edit Permissions</h2>
                <form action="?action=editpermissions" method="POST">
                    <div class="space-y-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Select Role</label>
                            <select name="role" id="role" class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="2">Chef de Projet</option>
                                <option value="3">Membre</option>
                            </select>
                        </div>
                        <div>
                            <label for="permissions" class="block text-sm font-medium text-gray-300 mb-1">Permissions</label>
                            <select name="permissions[]" id="permissions" multiple required class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select">
                                <?php foreach ($permissions as $permission): ?>
                                <option value="<?= htmlspecialchars($permission["id"]) ?>"><?= htmlspecialchars($permission["name"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors duration-300">
                        Update Permissions
                    </button>
                </form>
            </div>


            <div class="bg-gray-700 p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-semibold mb-6 text-green-400 border-b border-green-400 pb-2">Add Custom Role</h2>
                <form action="?action=createRole" method="POST">
                    <div class="space-y-4">
                        <div>
                            <label for="rolename" class="block text-sm font-medium text-gray-300 mb-1">Role Name</label>
                            <input type="text" name="rolename" id="rolename" required class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="new-permissions" class="block text-sm font-medium text-gray-300 mb-1">Permissions</label>
                            <select name="permissions[]" id="new-permissions" multiple required class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 chosen-select">
                                <?php foreach ($permissions as $permission): ?>
                                <option value="<?= htmlspecialchars($permission["id"]) ?>"><?= htmlspecialchars($permission["name"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors duration-300">
                        Create New Role
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.chosen-select').chosen({
                width: '100%',
                placeholder_text_multiple: 'Select permissions'
            });
        });
    </script>
</body>
</html>

