
let currentDirectory = null

document.addEventListener('DOMContentLoaded', (event) => {
            const table = document.getElementById('mainTable');
            fetch('../server/fileGrab.php')
                .then(response => response.json())
                .then(data => {
                currentDirectory = data['dir']
                console.log(data)
                files = data['files']
                total = ``
                for (const [key,value] of Object.entries(files)){
                    total += `<tr>
                <td name=${value}>📁${value}</td>
                <td></td>
                <td></td>
                </tr>
                `
                };

                table.insertAdjacentHTML('beforeend',total)

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


let row = null;
document.getElementById("mainTable").addEventListener('click', event => {
    if (event.detail === 1) {
        //console.log(event.target.parentNode)
        if (row == null){

        }
        else{
            row.blur()
            row.classList.remove('active-row')
        }
        console.log(event.target.tagName)
        if(event.target.tagName == 'TD'){
        row = event.target.parentNode
        row.setAttribute('tabindex','-1');

        row.focus()

        row.classList.add('active-row');
        }

    } else if (event.detail === 2) {
        const child = event.target.parentNode.firstElementChild;
        
        


    }

})

document.getElementById('addFolder').addEventListener('click', async event => {
        data = {"dir": currentDirectory}
    
        const response = await fetch("../server/createDir.php", {
      method: 'POST', // Specify the method
      headers: {
        'Content-Type': 'application/json' 
      },
      body: JSON.stringify(data) 
        });

   
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const responseData = await response.json(); 
    console.log('Success:', responseData);
    const newhtml = `<tr>
                <td name=${responseData}>📁${responseData}</td>
                <td></td>
                <td></td>
                </tr>
                `
    const table = document.getElementById('mainTable');
    table.insertAdjacentHTML('beforeend',newhtml);

})


