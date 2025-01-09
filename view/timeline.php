<?php include("header.php") ?>
<body class="bg-[#111827] text-gray-100 min-h-screen flex flex-col">

    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Recent Tasks</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-700 text-left">
                                <th class="p-3 font-semibold">Task</th>
                                <th class="p-3 font-semibold">Created</th>
                                <th class="p-3 font-semibold">Updated</th>
                                <th class="p-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($timelines as $timeline):?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="p-3"><?= $timeline["title"] ?></td>
                                <td class="p-3"><?= $timeline["created_at"] ?></td>
                                <td class="p-3"><?= $timeline["updated_at"] ?></td>
                                <td class="p-3"><span class="px-2 py-1 bg-green-500 text-green-900 rounded-full text-sm"><?= $timeline["status"] ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>