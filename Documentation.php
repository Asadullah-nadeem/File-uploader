<!-- Documentation.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation - Upload Image Using API</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 min-h-screen">
    <header class="bg-indigo-600 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold">Image Upload Documentation</h1>
            <p class="mt-2 text-lg">Learn how to use the API for seamless file uploads.</p>
            <a href="index.php" target="_blank" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
        Home
    </a>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <!-- How to Use This Page -->
        <section class="mb-12">
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 text-center">How to Use This Page</h2>
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <ul class="list-decimal list-inside space-y-4 text-gray-700">
                    <li>Enter your <strong>API key</strong> in the input field provided.</li>
                    <li>Select the <strong>file</strong> you want to upload (image or other files).</li>
                    <li>Click the <strong>"Upload Image"</strong> button to send your file and API key to the server.</li>
                    <a href="index.php" target="_blank" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
        Home
    </a>
                </ul>
                <p class="mt-4 text-green-600 font-medium">
                    If successful, the server will return a URL to access the uploaded file.
                </p>
            </div>
        </section>

        <!-- How to Use Your API Key -->
        <section class="mb-12">
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 text-center">How to Use Your API Key</h2>
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <p class="mb-4 text-gray-700">
                    Your <strong>API key</strong> is essential for authorizing uploads. Follow these instructions to use your API key correctly:
                </p>
                <ol class="list-decimal list-inside space-y-6 text-gray-700">
                    <!-- Using API Key in Headers -->
                    <li>
                        <strong>In the Request Header:</strong>
                        <p class="mt-2">Include your API key as a header in your HTTP request. For example:</p>
                        <pre class="bg-gray-100 p-4 rounded-lg text-gray-800 overflow-x-auto">
API_KEY: your_api_key_here
                        </pre>
                    </li>

                    <!-- Using Fetch API -->
                    <li>
                        <strong>Using JavaScript Fetch API:</strong>
                        <p class="mt-2">You can send the API key with the request like this:</p>
                        <pre class="bg-gray-100 p-4 rounded-lg text-gray-800 overflow-x-auto">
const response = await fetch('upload_api.php', {
    method: 'POST',
    headers: {
        'API_KEY': 'your_api_key_here' // Send the API key in the header
    },
    body: formData
});
                        </pre>
                    </li>

                    <!-- Using Curl -->
                    <li>
                        <strong>Direct Curl Command:</strong>
                        <p class="mt-2">Use this command in your terminal to upload a Image:</p>
                        <pre class="bg-gray-100 p-4 rounded-lg text-gray-800 overflow-x-auto">
curl -X POST https://bucket.codeaxe.co.in/upload_api.php \
-H "API_KEY: your_api_key_here" \
-F "image=@/path/to/your/image.png"
                        </pre>
                    </li>
                </ol>

                <!-- Success Response -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-green-600 mb-2">Successful Response</h3>
                    <pre class="bg-green-100 p-4 rounded-lg text-green-800 overflow-x-auto">
{
  "success": "Image uploaded successfully.",
  "file_url": "https://bucket.codeaxe.co.in/uploads/uniquekey/image.png"
}
                    </pre>
                </div>

                <!-- Error Response -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-red-600 mb-2">Error Response</h3>
                    <pre class="bg-red-100 p-4 rounded-lg text-red-800 overflow-x-auto">
{
  "error": "Unauthorized. Invalid API key."
}
                    </pre>
                </div>

                <p class="mt-6 text-gray-700">
                    <strong>Note:</strong> Keep your API key secure and avoid exposing it in client-side code to prevent unauthorized access.
                </p>
            </div>
        </section>
    </main>
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
