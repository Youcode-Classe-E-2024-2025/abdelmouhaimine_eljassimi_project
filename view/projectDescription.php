<?php include("header.php") ;
?>
<body class="bg-gray-900 text-white min-h-screen py-8">
    <div class="container mx-auto px-4">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-white text-center">Project README</h1>
        </header>
        <main>
            <section class="bg-gray-800 rounded-lg shadow-xl p-6">
                <div class="prose max-w-none">
                    <h2 class="text-2xl font-semibold mb-4 text-white"><?= $description["name"] ?></h2>
                    <p class="mb-4 text-gray-400">
                        This is a brief description of your project. Replace this text with the actual content of your README file.
                    </p>
                    <h3 class="text-xl font-semibold mb-2 text-white">Installation</h3>
                    <pre class="bg-gray-700 p-2 rounded"><code class="text-gray-200"><?= htmlspecialchars_decode($description["description"]) ?></code></pre>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
