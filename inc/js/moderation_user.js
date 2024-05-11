const banMenuBtns = document.querySelectorAll('.ban-menu-btn');
const banBtn = document.getElementById('ban-btn');
const usersTable = document.getElementById('users-table');

//new DataTable(usersTable);

banMenuBtns.forEach((btn) =>{
    btn.onclick = () => {
        banBtn.value = btn.value;
    }
})