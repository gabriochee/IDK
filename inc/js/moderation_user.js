const banMenuBtns = document.querySelectorAll('.ban-menu-btn');
const deleteMenuBtns = document.querySelectorAll('.delete-menu-btn');
const banBtn = document.getElementById('ban-btn');
const deleteBtn = document.getElementById('delete-btn');
const usersTable = document.getElementById('users-table');

banMenuBtns.forEach((btn) => {
    btn.onclick = () => {
        banBtn.value = btn.value;
    }
})

deleteMenuBtns.forEach((btn) => {
    btn.onclick = () => {
        deleteBtn.value = btn.value;
    }
})