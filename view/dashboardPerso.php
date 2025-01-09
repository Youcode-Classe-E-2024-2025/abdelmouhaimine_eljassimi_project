<?php include("header.php") ;
$tasksCreated = 0;
$tasksEdited = 0;
$tasksDeleted = 0;

foreach ($dataPerso as $activity) {
    if ($activity['action'] == 'create task') {
        $tasksCreated++;
    } elseif ($activity['action'] == 'edit task') {
        $tasksEdited++;
    } elseif ($activity['action'] == 'delete task') {
        $tasksDeleted++;
    }
}

?>
<body class="bg-gray-900 text-white min-h-screen p-6">

    <div class="max-w-7xl mx-auto mt-6 space-y-8">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="relative w-full sm:w-auto mt-4 sm:mt-0">
                <input type="search" placeholder="Search anything..." class="bg-gray-800 text-white w-full sm:w-64 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">Tasks Created</h2>
                <p class="text-3xl font-bold mb-2"><?= $tasksCreated ?>+</p>
                <p class="text-gray-400 mb-4">from last week</p>
                <div class="h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-purple-500 rounded-full" style="width: <?= ($tasksCreated / 10) * 100 ?>%;"></div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">Tasks Edited</h2>
                <p class="text-3xl font-bold mb-2"><?= $tasksEdited ?>+</p>
                <p class="text-gray-400 mb-4">from last week</p>
                <div class="h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full" style="width: <?= ($tasksEdited / 10) * 100 ?>%;"></div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">Tasks Deleted</h2>
                <p class="text-3xl font-bold mb-2"><?= $tasksDeleted ?>+</p>
                <p class="text-gray-400 mb-4">from last week</p>
                <div class="h-2 bg-gray-700 rounded-full">
                    <div class="h-2 bg-green-500 rounded-full" style="width: <?= ($tasksDeleted / 10) * 100 ?>%;"></div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-gray-800 rounded-lg p-6 chart-container">
            <h2 class="text-xl font-semibold mb-4">Task & Project Status</h2>
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <script>
        const tasksCreated = <?= json_encode($tasksCreated) ?>;
        const tasksEdited = <?= json_encode($tasksEdited) ?>;
        const tasksDeleted = <?= json_encode($tasksDeleted) ?>;

        const data = {
            labels: ['Tasks Created', 'Tasks Edited', 'Tasks Deleted', 'Projects Created', 'Projects Edited', 'Projects Deleted'],
            datasets: [
                {
                    label: 'Task & Project Status',
                    data: [tasksCreated, tasksEdited, tasksDeleted],
                    backgroundColor: ['#ffd800', '#3B82F6', '#ff3838'],
                    borderWidth: 1,
                    barThickness: 60,
                }
            ]
        };

        const ctx = document.getElementById('barChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });

        $(document).ready(function() {
            $('.chosen-select').chosen({
                width: '100%',
                placeholder_text_multiple: 'Select users'
            });
        });
    </script>

</body>
</html>
