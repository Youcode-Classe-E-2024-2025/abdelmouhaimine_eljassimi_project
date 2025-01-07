<?php include("header.php") ?>
<body class="bg-gray-900 text-white min-h-screen p-6">
    <div class="max-w-7xl mx-auto mt-6 space-y-8">
        <div class="max-w-7xl mx-auto mt-6 space-y-8">
            <form action="?action=editpermissions" method="POST" class="mt-6 bg-gray-700 p-4 rounded-lg">
                <h3 class="font-semibold text-lg mb-4">Edit Permissions</h3>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="roleName" class="block text-sm font-medium text-gray-400 mb-1">Role : </label>
                        <select name="role" class="select2-users block w-full bg-gray-700 border border-gray-600 rounded-lg text-white" id="role">
                        <option value="2">Chef de Projet</option>
                        <option value="3">Membre</option>
                        </select>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-blue-400">Permissions</h2>
                        <select name="permissions[]" id="permissions" multiple required class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select">
                            <option value="1">Créer une tâche</option>
                            <option value="2">Éditer une tâche</option>
                            <option value="3">Supprimer une tâche</option>
                    </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Edit Permissions
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-6 space-y-8">
        <div class="max-w-7xl mx-auto mt-6 space-y-8">
            <form action="?action=createRole" method="POST" class="mt-6 bg-gray-700 p-4 rounded-lg">
                <h3 class="font-semibold text-lg mb-4">Add Custum Role</h3>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="roleName" class="block text-sm font-medium text-gray-400 mb-1">Role : </label>
                         <input type="text" class="block text-sm font-medium text-gray-400 mb-1 w-full bg-gray-900">
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-blue-400">Permissions</h2>
                        <select name="permissions[]" id="permissions" multiple required class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select">
                            <option value="1">Créer une tâche</option>
                            <option value="2">Éditer une tâche</option>
                            <option value="3">Supprimer une tâche</option>
                    </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Add Role
                </button>
            </form>
        </div>
    </div>
    <script>
         $(document).ready(function() {
        $('.chosen-select').chosen({
            width: '100%',
            placeholder_text_multiple: 'Select users'
        });
    });
    </script>
</body>
</html>