<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="a knaban app for taskflow enterprise" />
        <meta name="keywords" content="kanban,task manager, taskflow" />
        <meta name="author" content="Ibrahim Nidam" />
        <title>Task Flow || Kanban</title>
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="icon" href="assets/src/images/favicon/favicon-32x32.png" type="image/x-icon" />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=chevron_left"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=dark_mode"
        />

        <link href="assets/src/css/tailwind/output.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

        <style>
        .drag-over {
            background-color: rgba(0, 0, 0, 0.05) !important;
            border: 2px dashed #ccc !important;
            transition: all 0.2s ease-in-out;
        }

        .dragging {
            opacity: 0.6;
            transform: scale(1.02);
            cursor: grabbing !important;
        }

        .dragNdrop {
            transition: transform 0.2s ease-in-out;
        }

        .dragging-active .dragNdrop:not(.dragging) {
            transform: scale(0.98);
        }

        #todo-card-article,
        #doing-card-article,
        #review-card-article,
        #done-card-article {
            min-height: 200px;
            transition: background-color 0.3s ease, border 0.3s ease;
            padding: 8px;
            border: 2px solid transparent;
        }

    </style>

    </head>
    <body class="m-0 p-0 flex h-screen">
        <main class="flex-1 overflow-x-hidden">


<section id="form"class="items-center justify-center bg-gray-100 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">

<form method="POST" action="?action=create" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md md:max-w-lg space-y-6">
    <div class="flex items-center space-x-4">
        <label for="title" class="w-24 text-gray-700 font-semibold">Title:</label>
        <input
            type="text"
            name="title"
            id="title"
            maxlength="16"
            required
            class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <div class="flex items-center space-x-4">
        <label for="description" class="w-24 text-gray-700 font-semibold">Description:</label>
        <textarea
            name="description"
            id="description"
            maxlength="100"
            class="flex-1 px-4 py-2 border border-gray-300 rounded resize-none h-24 focus:outline-none focus:ring-2 focus:ring-blue-500"
        ></textarea>
    </div>

    <div class="flex items-center space-x-4">
        <label for="due_date" class="w-24 text-gray-700 font-semibold">Due Date:</label>
        <input
            type="date"
            name="due_date"
            id="due_date"
            required
            class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <div class="flex items-center space-x-4">
        <label class="w-24 text-gray-700 font-semibold">Time:</label>
        <div class="flex flex-1 space-x-2">
            <select
                name="due_time_hh"
                id="due_time_hh"
                required
                class="w-1/2 px-2 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="HH">HH</option>
                <?php for ($i = 0; $i < 24; $i++): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                <?php endfor; ?>
            </select>
            <select
                name="due_time_mm"
                id="due_time_mm"
                required
                class="w-1/2 px-2 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="MM">MM</option>
                <?php for ($i = 0; $i < 60; $i++): ?>
                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <label class="w-24 text-gray-700 font-semibold">Priority:</label>
        <div class="flex flex-1 justify-between">
            <input type="radio" name="priority" value="high" id="priority-high" required>
            <label for="priority-high" class="text-red-500">High</label>
            <input type="radio" name="priority" value="medium" id="priority-medium" required>
            <label for="priority-medium" class="text-orange-400">Medium</label>
            <input type="radio" name="priority" value="low" id="priority-low" required>
            <label for="priority-low" class="text-green-500">Low</label>
        </div>
    </div>
        <div class="flex items-center space-x-4">
            <label class="w-24 text-gray-700 font-semibold">Status:</label>
            <select
                name="status"
                id="status"
                required
                class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="To Do">To Do</option>
                <option value="Doing">Doing</option>
                <option value="Review">Review</option>
                <option value="Done">Done</option>
            </select>
        </div>

        <div class="flex items-center space-x-4">
            <label class="w-24 text-gray-700 font-semibold">Tags:</label>
            <select
                name="tag"
                id="tag"
                class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="" >Select a tag</option>
                <option value="Bug">Bug</option>
                <option value="Feature">Feature</option>
            </select>
        </div>

        <label for="users" class="w-24 text-gray-700 font-semibold mt-4">Users:</label>
        <select name="users[]" id="users" multiple required class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 chosen-select">
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
        <option value="<?= $user["id"] ?>"><?= $user["name"] ?></option>
        <?php endforeach; ?>
        <?php else: ?>
            <option value=""><?= "No users" ?></option>
        <?php endif; ?>

        </select>
    </div>

    <div class="flex justify-end mt-6">

        <button
            type="submit"
            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
        >
            Add Task
        </button>
    </div>
</form>
</section>
<?php include("sections/footer.php") ?>