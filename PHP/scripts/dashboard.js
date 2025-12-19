document.addEventListener('DOMContentLoaded', (event) => {
            // This runs after the main HTML is parsed
            const photoContainer = document.getElementById('photo-container');
            fetch('../server/photo_grab.php')
                .then(response => response.json())
                .then(data => {
                    // Place the response from the PHP script into the page
                    //document.getElementById('photo-container').innerHTML = data;
                    for (let i = 0; i < data.length; i++) {
                        const img = document.createElement('img');
                        img.src = "../server/" + data[i]['filepath'];
                        photoContainer.innerHTML += `<a href="${img.src}" target="_blank"><img src="${img.src}" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.88); margin-bottom: 10%; width: 20vw; height: 20vh;"></img></a>`;
                    }
                    console.log(data[0]['filepath']);
                })
                .catch(error => {
                    console.error('Error fetching PHP script:', error);
                });
        });


function handleLogout() {
    if (confirm("Are you sure you want to logout?")) {
       window.location.href = "../server/logout_handler.php";
    }
}


const fileInput = document.querySelector('#file-upload');
const statusMsg = document.getElementById('uploadStatus');


fileInput.addEventListener('change', async (event) => {
    const files = event.target.files;
    if (!files) return;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
    }
    statusMsg.textContent = 'Uploading...';
    statusMsg.style.display = 'block';

    setTimeout(() => statusMsg.classList.add('show'), 10);

  try {
    const response = await fetch('../server/uploader.php', {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const result = await response.json();
      console.log('Upload successful:', result);
      statusMsg.textContent = 'Upload successful!';

      setTimeout(() => {
                statusMsg.classList.add('fade');
                
                // 4. Fully hide after fade animation ends (500ms)
                setTimeout(() => {
                    statusMsg.style.display = 'none';
                    statusMsg.classList.remove('show', 'fade');
                }, 500);
            }, 1500);

    } else {
      console.log('here');
      statusMsg.textContent = 'Upload failed.';
      console.error('Server error:', response.statusText);
      setTimeout(() => statusMsg.style.display = 'none', 2000);
    }
  } catch (error) {
    console.error('Network error:', error);
    statusMsg.textContent = "Error: Connection lost.";
    setTimeout(() => statusMsg.style.display = 'none', 2000);
  }

});