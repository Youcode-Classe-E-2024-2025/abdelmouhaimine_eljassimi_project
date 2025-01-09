<?php include("header.php");?>

<body class="bg-[#111827] text-gray-100 min-h-screen flex flex-col">
    <main class="flex-grow container mx-auto px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-8 text-center">Activity Timeline</h1>
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-700 text-left">
                                    <th class="p-3 font-semibold rounded-tl-lg">User</th>
                                    <th class="p-3 font-semibold">Action</th>
                                    <th class="p-3 font-semibold rounded-tr-lg">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($timelines as $index => $timeline): ?>
                                <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors <?= $index % 2 == 0 ? 'bg-gray-750' : '' ?>">
                                    <td class="p-4 flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">
                                            <?= strtoupper(substr($timeline["user"], 0, 1)) ?>
                                        </div>
                                        <span><?= htmlspecialchars($timeline["user"]) ?></span>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 bg-indigo-600 text-indigo-100 rounded-full text-sm">
                                            <?= htmlspecialchars($timeline["action"]) ?>
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-400">
                                        <time datetime="<?= htmlspecialchars($timeline["timestamp"]) ?>">
                                            <?= htmlspecialchars($timeline["timestamp"]) ?>
                                        </time>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

