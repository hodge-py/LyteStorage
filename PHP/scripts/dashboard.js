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


function handleLogout() {
    if (confirm("Are you sure you want to logout?")) {
       window.location.href = "../server/logout_handler.php";
    }
}


const fileInput = document.querySelector('#file-upload');


fileInput.addEventListener('change', async (event) => {
    const files = event.target.files;
    if (!files) return;
    //console.log(files);
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        formData.append('photos[]', files[i]);
    }

    //console.log(formData.getAll('photos[]'));

  try {
    // 4. Execute the POST request
    const response = await fetch('../server/uploader.php', {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      const result = await response.json();
      console.log('Upload successful:', result);
    } else {
        console.log('here');
      console.error('Server error:', response.statusText);
    }
  } catch (error) {
    console.error('Network error:', error);
  }

});