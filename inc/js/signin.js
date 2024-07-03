const canvas = document.getElementById('signature');
const ctx = canvas.getContext('2d');

let signin_form = document.getElementById('signin-form');
let password = document.getElementById('password');

let isPainting = false;

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function getCanvasPosition(event) {
    var rect = canvas.getBoundingClientRect();

    return {
        x: event.clientX - rect.left,
        y: event.clientY - rect.top
    };
}

function getCanvasPositionTouch(event) {
    var rect = canvas.getBoundingClientRect();

    return {
        x: event.touches[0].clientX - rect.left,
        y: event.touches[0].clientY - rect.top
    };
}

function draw(e) {
    if (isPainting) {
        var position = getCanvasPosition(e);
        ctx.lineTo(position.x, position.y);
        ctx.stroke();
    }
}

function drawTouch(e) {
    if (isPainting) {
        var position = getCanvasPositionTouch(e);
        ctx.lineTo(position.x, position.y);
        ctx.stroke();
    }
}

signin_form.addEventListener('submit', function(event){
    event.preventDefault();
    if (password.value.length < 8){
        alert("Votre mot de passe est inférieur à 8 caractères. Fournissez en un plus grand.");
    } else if (password.value !== document.getElementById('password-confirmation').value){
        alert("Le mot de passe de confirmation est différent du mot de passe.");
    } else {
        signin_form.submit();
    }
});

canvas.addEventListener('mousedown', function (e) {
    if (isPainting) {
        var position = getCanvasPosition(e);
        ctx.beginPath();
        ctx.moveTo(position.x, position.y);
        canvas.addEventListener('mousemove', draw);
        e.preventDefault();
    }
});

canvas.addEventListener('mouseup', function () {
    canvas.removeEventListener('mousemove', draw);
});


canvas.addEventListener('touchstart', function (e) {
    if (isPainting) {
        var position = getCanvasPositionTouch(e);
        ctx.beginPath();
        ctx.moveTo(position.x, position.y);
        canvas.addEventListener('touchmove', drawTouch);
        e.preventDefault();
    }
});

canvas.addEventListener('touchend', function () {
    canvas.removeEventListener('touchmove', drawTouch);
});
