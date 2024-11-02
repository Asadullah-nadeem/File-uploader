async function uploadImage() {
    const apiKey = document.getElementById('api_key').value;
    const image = document.getElementById('image').files[0];

    if (!apiKey || !image) {
        document.getElementById('responseMessage').textContent = "Please enter an API key and select an image.";
        return;
    }

    const formData = new FormData();
    formData.append("api_key", apiKey);
    formData.append("image", image);

    try {
        const response = await fetch('upload_api.php', {
            method: 'POST',
            headers: {
                'API_KEY': apiKey 
            },
            body: formData
        });

        const result = await response.json();
        if (response.ok) {
            document.getElementById('responseMessage').textContent = `Success: ${result.success}. File URL: ${result.file_url}`;
            document.getElementById('responseMessage').classList.add("text-green-500");
        } else {
            document.getElementById('responseMessage').textContent = `Error: ${result.error}`;
            document.getElementById('responseMessage').classList.add("text-red-500");
        }
    } catch (error) {
        document.getElementById('responseMessage').textContent = `Error: ${error.message}`;
        document.getElementById('responseMessage').classList.add("text-red-500");
    }
}