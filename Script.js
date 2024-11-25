document.getElementById('currentYear').textContent = new Date().getFullYear();

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
                'API_KEY': apiKey,
            },
            body: formData,
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

function toggleModal() {
    const modal = document.getElementById('subscribeModal');
    modal.classList.toggle('hidden');
}

function toggleTheme() {
    const html = document.documentElement;
    html.classList.toggle('dark');
    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
}
async function fetchIpAddress() {
    try {
        const response = await fetch('https://api.ipify.org?format=json');
        const data = await response.json();
        document.getElementById('ipAddress').textContent = data.ip;
    } catch (error) {
        document.getElementById('ipAddress').textContent = 'Unable to fetch IP';
    }
}
fetchIpAddress();


const currentURL = window.location.href;
    const urlElement = document.getElementById('currentURL');
    urlElement.textContent = currentURL;
    urlElement.href = currentURL;