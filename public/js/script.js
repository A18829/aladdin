// public/js/script.js
document.getElementById('pingButton').addEventListener('click', function() {
    const ip = document.getElementById('ip').value;
    fetch(`/ping?ip=${encodeURIComponent(ip)}`) // Sử dụng encodeURIComponent để mã hóa URL
        .then(response => response.json())
        .then(data => {
            const resultDiv = document.getElementById('result');
            if (data.status) {
                resultDiv.textContent = 'IP is reachable';
            } else {
                resultDiv.textContent = 'IP is not reachable';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});