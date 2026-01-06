
document.addEventListener('DOMContentLoaded', (event) => {
            const table = document.getElementById('mainTable');
            fetch('../server/fileGrab.php')
                .then(response => response.json())
                .then(data => {
                console.log(data);
                const newhtml = `<tr>
                <td name='root'>📁root</td>
                <td></td>
                <td></td>
                </tr>
                `
                table.insertAdjacentHTML('beforeend',newhtml)
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

        console.log(child.getAttribute('name'));


    }

})
