<!-- index.php -->
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload | CodeAxe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Apply the theme preference on page load
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-indigo-600 dark:bg-indigo-800 text-white py-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-4xl font-extrabold">Image Upload Service</h1>
                <p class="mt-2 text-lg">Upload your files seamlessly with ease.</p>
                <a href="documentation.php" target="_blank" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
                    View Documentation
                </a>
            </div>
            <button onclick="toggleTheme()" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
                Demo Website
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto px-6 py-12">
            <!-- Upload Form -->
            <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl transition-transform hover:scale-105">
                <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-gray-200 mb-6">Upload Your File</h2>
                <form id="uploadForm" enctype="multipart/form-data" class="space-y-6">
                    <div>
                        <label for="api_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300">API Key</label>
                        <input type="text" id="api_key" name="api_key" class="mt-2 px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md w-full focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your API Key" required>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select File</label>
                        <input type="file" id="image" name="image" class="mt-2 px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md w-full focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <button type="button" onclick="uploadImage()" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-2 px-4 rounded-md w-full shadow-lg transform transition-transform hover:scale-105">
                        Upload File
                    </button>
                </form>
                <div class="text-center mt-6">
                    <button onclick="toggleModal()" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-lg shadow-lg transform transition-transform hover:scale-105">
                        Subscribe for API Key
                    </button>
                </div>
                <div id="responseMessage" class="mt-6 text-center text-sm font-medium text-gray-700 dark:text-gray-300"></div>
            </div>
        </div>
    </main>

    <!-- Subscribe Modal -->
    <div id="subscribeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full relative">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200 text-center">Subscribe for an API Key</h2>
            <form action="subscribe.php" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-green-400 to-teal-500 text-white rounded-md shadow-lg transform transition-transform hover:scale-105">
                    Subscribe
                </button>
            </form>
            <button onclick="toggleModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                &times;
            </button>
        </div>
    </div>

    <footer class="bg-indigo-600 dark:bg-indigo-800 text-white py-4 shadow-lg">
        <div class="container mx-auto text-center">
            <p>
                &copy; <span id="currentYear"></span>
                <a href="#" id="currentURL" class="underline text-blue-300"></a>.<span id="ipAddress">Loading...</span>
            </p>
        </div>
    </footer>
    <script src="Script.js"></script>
</body>

</html>