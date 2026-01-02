document.addEventListener('DOMContentLoaded', (event) => {
            // This runs after the main HTML is parsed
            const photoContainer = document.getElementById('photo-container');
            const videoContainer = document.getElementById('video-container');
            fetch('../server/photo_grab.php')
                .then(response => response.json())
                .then(data => {
                  const imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.svg', '.bmp'];
                  const videoExtensions = ['.mp4', '.mkv', '.avi', '.mov', '.wmv', '.flv', '.webm', '.mpg', '.mpeg'];

                  const photoFragment = document.createDocumentFragment();
                    const videoFragment = document.createDocumentFragment();
                data.forEach(item => {
                const fullSrc = "../server/" + item.filepath;
                const extension = "." + item.filepath.split('.').pop().toLowerCase();

                if (videoExtensions.includes(extension)) {
                    const videoDiv = document.createElement('div');
                    videoDiv.innerHTML = `<video loading="lazy" class="video-item" muted style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.88); margin-bottom: 10px; width: 20vw; height: 20vh; background-color: #24292e;"><source src="${fullSrc}"></video>`;
                    videoFragment.appendChild(videoDiv.firstChild);
                } 
                else if (imageExtensions.includes(extension)) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'image-container';
                    wrapper.innerHTML = `
                        <input class='check-box' type='checkbox' style='position: absolute; top: 3%; left: 3%; z-index: 10; cursor: pointer;' />
                        <img class="photo-item" loading="lazy" src="${fullSrc}" alt="Photo" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.88); margin-bottom: 10px; width: 20vw; height: 20vh; object-fit: cover;">
                    `;
                    photoFragment.appendChild(wrapper);
                }
                })

                    photoContainer.appendChild(photoFragment);
                    videoContainer.appendChild(videoFragment);
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

var currentView = 'photos';
function switchView(view) {
    document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
    
    if (view === 'photos') {
        document.getElementById('view-photos').classList.add('active');
        document.getElementById('photo-container').style.display = 'flex';
        document.getElementById('video-container').style.display = 'none';
        currentView = 'photos';
    } else {
      currentView = 'videos';
        document.getElementById('view-videos').classList.add('active');
        document.getElementById('photo-container').style.display = 'none';
        document.getElementById('video-container').style.display = 'flex';
    }
    //console.log("Switching view to: " + view);

}


const fileInput = document.querySelector('#file-upload');
const statusMsg = document.getElementById('uploadStatus');


fileInput.addEventListener('change', async (e) => {
    
    const files = e.target.files;
    const acceptedTypes = ['image/', 'video/'];
    if (!files) return;


    statusMsg.textContent = '0 files uploaded.';
    statusMsg.style.display = 'block';
    setTimeout(() => statusMsg.classList.add('show'), 10);

    total = 0;

    for (let i = 0; i < files.length; i++) {
        const fileType = files[i].type;
        if (!acceptedTypes.some(type => fileType.startsWith(type))) {
          continue; // Skip unsupported file types
        }
        else{

            const formData = new FormData();
            formData.append('files[]', files[i]);
            try {
            const response = await fetch('../server/uploader.php', {
              method: 'POST',
              body: formData,
            });

            if (response.ok) {
              const result = await response.json();
              total += 1;
              if (total == 1) {
              statusMsg.textContent = '1 file uploaded... Continuing upload.';
              }
              else {
              statusMsg.textContent = total + ' files uploaded... Continuing upload.';
              }
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
    }
    
  }

  statusMsg.textContent = 'Upload complete. Reloading...';

   setTimeout(() => {
        statusMsg.classList.add('fade');
        window.location.reload();
        setTimeout(() => {
            statusMsg.style.display = 'none';
            statusMsg.classList.remove('show', 'fade');
        }, 300);
    }, 500);

});


document.getElementById('sync-upload').addEventListener('change', async (e) => {
   
    const files = e.target.files;
    const acceptedTypes = ['image/', 'video/'];
    if (!files) return;


    statusMsg.textContent = '0 files uploaded.';
    statusMsg.style.display = 'block';
    setTimeout(() => statusMsg.classList.add('show'), 10);

    total = 0;

    for (let i = 0; i < files.length; i++) {
        const fileType = files[i].type;
        if (!acceptedTypes.some(type => fileType.startsWith(type))) {
          continue; // Skip unsupported file types
        }
        else{

            const formData = new FormData();
            formData.append('files[]', files[i]);
            try {
            const response = await fetch('../server/uploader.php', {
              method: 'POST',
              body: formData,
            });

            if (response.ok) {
              const result = await response.json();
              total += 1;
              if (total == 1) {
              statusMsg.textContent = '1 file uploaded... Continuing upload.';
              }
              else {
              statusMsg.textContent = total + ' files uploaded... Continuing upload.';
              }
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
    }
    
  }

  statusMsg.textContent = 'Upload complete. Reloading...';

   setTimeout(() => {
        statusMsg.classList.add('fade');
        window.location.reload();
        setTimeout(() => {
            statusMsg.style.display = 'none';
            statusMsg.classList.remove('show', 'fade');
        }, 300);
    }, 500);
    


});



const modal = document.getElementById("photo-viewer");
const fullImg = document.getElementById("full-image");
const captionText = document.getElementById("caption");
const closeBtn = document.querySelector(".close-viewer");
var longClick = false;

document.getElementById('photo-container').addEventListener('click', function(e) {

    if (e.target.tagName === 'IMG') {
        
        modal.style.display = "flex";
        document.getElementById('full-video').style.display = "none";
        document.getElementById('full-image').style.display = "block";
        fullImg.src = e.target.src; 
        
        document.getElementById('image-video-title').innerText = e.target.alt.split('/').pop();
    }

});

const fullVideo = document.getElementById("full-video");
const videoSource = document.getElementById("videoSource");

document.getElementById('video-container').addEventListener('click', function(e) {
  console.log(e.target.tagName);

    if (e.target.tagName === 'VIDEO') {
        
        modal.style.display = "flex";
        fullVideo.src = e.target.querySelector('source').src; 
        document.getElementById('full-video').style.display = "block";
        document.getElementById('full-image').style.display = "none";
        
        /*
        const parent = e.target.closest('.post');
        const title = parent.querySelector('h2').innerText;
        captionText.innerHTML = title;
        */
    }

});


let checkboxSrc = {};
let filePathHolder = {};
const container = document.querySelector('#photo-container'); 

container.addEventListener('change', (e) => {
    if (e.target.classList.contains('check-box')) {
        const checkbox = e.target;
        
        const imgElement = checkbox.nextElementSibling;
        const imgSrc = imgElement.src;

        document.getElementById('sync').style.display = 'none';
        document.getElementById('multi-btn').style.display = 'none';
        document.getElementById('delete-multi').style.display = 'flex';
        document.getElementById('download-multi').style.display = 'flex';

        if (checkbox.checked) {
            filePathHolder[imgSrc] = imgSrc;
        } else {
            delete filePathHolder[imgSrc];
        }

        if (Object.keys(filePathHolder).length === 0) {
            document.getElementById('delete-multi').style.display = 'none';
            document.getElementById('download-multi').style.display = 'none';
            document.getElementById('sync').style.display = 'flex';
          document.getElementById('multi-btn').style.display = 'flex';
        }

        console.log("Selected Files:", filePathHolder);
    }
});
        
        



closeBtn.onclick = function() {
    modal.style.display = "none";
    fullVideo.pause();
}

modal.onclick = function(e) {
    if (e.target === modal) {
        modal.style.display = "none";
        fullVideo.pause();
    }
}

document.addEventListener('keydown', (e) => {
    if (e.key === "Escape"){ 
      modal.style.display = "none";
      fullVideo.pause();
    }
});


document.getElementById('btn-download').addEventListener('click', (e) => {
    if (currentView === 'photos') {
    const link = document.createElement('a');
    link.href = fullImg.src;
    link.download = fullImg.src.substring(fullImg.src.lastIndexOf('/') + 1);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    } else if (currentView === 'videos') {
      const link = document.createElement('a');
      link.href = fullVideo.src;
      link.download = fullVideo.src.substring(fullVideo.src.lastIndexOf('/') + 1);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
});


document.getElementById('btn-delete').addEventListener('click', async (e) => {

    if (confirm("Are you sure you want to delete this photo? This action cannot be undone.")) {
        try {

          srcToDelete = '';
          if (currentView === 'photos') {
            srcToDelete = fullImg.src;
          } else {
            srcToDelete = fullVideo.src;
          }
            const response = await fetch('../server/delete_photo.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ filepath: srcToDelete }),
            });
            if (response.ok) {
                const result = await response.json();
                console.log('Delete successful:', result);
                alert('Photo deleted successfully.');
                modal.style.display = "none";
                window.location.reload();
            } else {
                console.error('Server error:', response.statusText);
                alert('Failed to delete photo.');
            }
        } catch (error) {
            console.error('Network error:', error);
            alert('Error: Connection lost.');
        }
    }

});


document.getElementById('button-delete-select').addEventListener('click', async (e) => {

    if (confirm("Are you sure you want to delete this photo? This action cannot be undone.")) {

        for (const src in filePathHolder) {
            try {

              const response = await fetch('../server/delete_photo.php', { 
                  method: 'POST',
                  headers: { 'Content-Type': 'application/json' },
                  body: JSON.stringify({ filepath: src }),
              });
              if (response.ok) {
                  const result = await response.json();
                  console.log('Delete successful:', result);
              } else {
                  console.error('Server error:', response.statusText);
              }
          } catch (error) {
              console.error('Network error:', error);
          }

        }

        window.location.reload();
      }

});

document.getElementById('download-multi').addEventListener('click', async (e) => {
    if (currentView === 'photos') {
      const fileUrls = Object.values(filePathHolder);

      downloadMultipleFiles(fileUrls, 'source_photos.zip');

      //window.location.reload();

    } else if (currentView === 'videos') {
      const link = document.createElement('a');
      link.href = fullVideo.src;
      link.download = 'downloaded_video';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

});


async function downloadMultipleFiles(fileUrls, zipFilename = 'source_files.zip') {
    const zip = new JSZip();
    const promises = fileUrls.map(async (url, index) => {
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error(`Could not fetch file: ${url}`);
            const blob = await response.blob();
            const filename = url.substring(url.lastIndexOf('/') + 1) || `file_${index + 1}.js`;
            zip.file(filename, blob);
        } catch (error) {
            console.error(error);
        }
    });

    await Promise.all(promises);

    zip.generateAsync({ type: "blob" }).then(function(content) {
        saveAs(content, zipFilename);
    })

    setTimeout(function() {
    window.location.reload();
    }, 1000);

}