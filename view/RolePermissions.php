<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rôles et Permissions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
</head>
<body class="h-full flex items-center justify-center bg-[#111827] text-white font-['Inter']">
    <form action="?action" class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-xl shadow-2xl">
        <h1 class="text-3xl font-bold text-center text-blue-500">Gestion des Rôles et Permissions</h1>
        
        <div class="space-y-6">
            <div>
                <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Rôle de l'utilisateur</label>
                <select id="role" name="role" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="manager">Chef de Projet</option>
                    <option value="member">Membre</option>
                </select>
            </div>

            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-blue-400">Permissions</h2>
                <div class="space-y-2">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input name="createTask" value="1" type="checkbox" class="form-checkbox h-5 w-5 text-blue-500 rounded focus:ring-blue-500 focus:ring-offset-gray-800" checked>
                        <span class="text-gray-300">Créer une tâche</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input name="editTask" value="2" type="checkbox" class="form-checkbox h-5 w-5 text-blue-500 rounded focus:ring-blue-500 focus:ring-offset-gray-800" checked>
                        <span class="text-gray-300">Éditer une tâche</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input name="deleteTask" value="3" type="checkbox" class="form-checkbox h-5 w-5 text-blue-500 rounded focus:ring-blue-500 focus:ring-offset-gray-800">
                        <span class="text-gray-300">Supprimer une tâche</span>
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors duration-200">
            Enregistrer les modifications
        </button>
    </form>
    <script>
    </script>
</body>
</html>

