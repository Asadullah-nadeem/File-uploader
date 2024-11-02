<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Using API</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center">
<div class="container mx-auto p-4 md:p-8 lg:p-12">
<h1 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-8">Upload Any File Using an API Key (Less than 10 MB)</h1>

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl">
        <form id="uploadForm" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="api_key" class="block text-sm font-medium text-gray-700">API Key</label>
                <input type="text" id="api_key" name="api_key" class="mt-2 px-4 py-2 border border-gray-300 rounded-md w-full focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your API Key" required>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Select Image</label>
                <input type="file" id="image" name="image" class="mt-2 px-4 py-2 border border-gray-300 rounded-md w-full focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <button type="button" onclick="uploadImage()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md w-full transition duration-150 ease-in-out">
                Upload Image
            </button>
        </form>
        <a href="subscribe.html" class="text-blue-500 hover:text-blue-700 mt-4 block text-center underline">Get an API key</a>

        <div id="responseMessage" class="mt-6 text-center text-sm font-medium text-gray-700"></div>
    </div>

    <div class="mt-12 text-center text-gray-700">
        <h2 class="text-2xl font-semibold mb-6">How to Use This Page</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p class="mb-3">1. Enter your API key in the input field provided.</p>
            <p class="mb-3">2. Select the image you want to upload.</p>
            <p>3. Click on "Upload Image" to send your image and API key to the server. If successful, you'll receive a file URL.</p>
        </div>
    </div>
    <div class="mt-12 text-center text-gray-700">
        <h2 class="text-2xl font-semibold mb-6">How to Use Your API Key</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg text-left space-y-4">
            <p>Your API key is essential for authorizing your image uploads to the server. Here’s how to properly use your API key:</p>
            <ul class="list-disc list-inside mb-4 pl-6 text-gray-700">
                <li><strong>In the Request Header:</strong> Include your API key in the request header using the format: <code>API_KEY: your_api_key_here</code>.</li>
                <li><strong>Using JavaScript Fetch API:</strong> You can send the API key along with your request like this:</li>
            </ul>
            <pre class="bg-gray-100 p-4 rounded-lg text-gray-800 overflow-x-auto">
const response = await fetch('upload_api.php', {
    method: 'POST',
    headers: {
        'API_KEY': apiKey // Send the API key in the header
    },
    body: formData
});
        </pre>
            <li><strong>Direct Curl Command:</strong> Use the following command in your terminal to upload an image using your API key:</li>
            <pre class="bg-gray-100 p-4 rounded-lg text-gray-800 overflow-x-auto">
curl -X POST http://url.in/upload_api.php \
-H "API_KEY: your_api_key_here" \
-F "image=@/path/to/your/image.jpg"
        </pre>
            <p>A successful response will return a JSON object like this:</p>
            <pre class="bg-green-100 p-4 rounded-lg text-green-800 overflow-x-auto">
{
  "success": "Image uploaded successfully.",
  "file_url": "http://url.in/uploads/uniquekey/unique-image-name.jpg"
}
        </pre>
            <p>If the API key is invalid or missing, you will receive an error response like this:</p>
            <pre class="bg-red-100 p-4 rounded-lg text-red-800 overflow-x-auto">
{
  "error": "Unauthorized. Invalid API key."
}
        </pre>
            <p>Make sure to keep your API key secure and do not expose it in client-side code to prevent unauthorized access.</p>
        </div>
    </div>
    <script src="Script.js"></script>
</body>
</html>
