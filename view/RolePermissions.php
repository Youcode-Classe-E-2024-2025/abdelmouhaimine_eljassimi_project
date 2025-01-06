<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-900">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Task</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
        $userId = isset($_GET['idUser']) ? $_GET['idUser'] : null;
        $projectId = isset($_GET['idProject']) ? $_GET['idProject'] : null;
?>
<body class="h-full flex items-center justify-center bg-[#111827] text-white font-['Inter']">
    <form action="http://localhost/abdelmouhaimine_eljassimi_project/index.php?action=rolepermissions&userId=<?=$userId?>&projectId=<?=$projectId?>" method="POST" class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-xl shadow-2xl">
        <h1 class="text-3xl font-bold text-center text-blue-500">Gestion des Rôles et Permissions</h1>
        
        <div class="space-y-6">
            <div>
                <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Rôle de l'utilisateur</label>
                <select id="role" name="role" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="2">Chef de Projet</option>
                    <option value="3">Membre</option>
                </select>
            </div>

            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-blue-400">Permissions</h2>
                <select name="permissions[]" id="permissions" multiple required class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select">
                    <option value="1">Créer une tâche</option>
                    <option value="2">Éditer une tâche</option>
                    <option value="3">Supprimer une tâche</option>
               </select>
            </div>
        </div>
        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors duration-200">
            Enregistrer les modifications
        </button>
    </form>
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

