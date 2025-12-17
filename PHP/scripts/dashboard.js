document.addEventListener('DOMContentLoaded', (event) => {
            // This runs after the main HTML is parsed
            fetch('../server/photo_grab.php')
                .then(response => response.text())
                .then(data => {
                    // Place the response from the PHP script into the page
                    document.getElementById('photo-container').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching PHP script:', error);
                });
        });