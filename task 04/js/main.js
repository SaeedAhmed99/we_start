


let all = document.querySelector("#allsection");
let app = document.querySelector("#app");
let photography = document.querySelector("#photography");
let web = document.querySelector("#web");
let print = document.querySelector("#print");

all.onclick = () => {
    document.querySelectorAll('.box').forEach((x) => {
        x.style.display = 'block';
    })
}


app.onclick = () => {
    document.querySelectorAll('.box').forEach((x) => {
        if (x.getAttribute('id') == 'appsection') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    })
}

photography.onclick = () => {
    document.querySelectorAll('.box').forEach((x) => {
        if (x.getAttribute('id') == 'photographysection') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    })
}

web.onclick = () => {
    document.querySelectorAll('.box').forEach((x) => {
        if (x.getAttribute('id') == 'websection') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    })
}

print.onclick = () => {
    document.querySelectorAll('.box').forEach((x) => {
        if (x.getAttribute('id') == 'printsection') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    })
}


let form = document.getElementById('form');
let namee = document.getElementById('inputName');
let email = document.getElementById('inputEmail');
let message = document.getElementById('inputMessage');
let submit = document.getElementById('submit');


form.addEventListener('submit', (e) => { 
    e.preventDefault();
    namee.value === '' || namee.value == null ? document.getElementById('inputNameError').style.display = 'block' : document.getElementById('inputNameError').style.display = 'none';
    email.value === '' || email.value == null ? document.getElementById('inputEmailError').style.display = 'block' : document.getElementById('inputEmailError').style.display = 'none';
    message.value === '' || message.value == null ? document.getElementById('inputMessageError').style.display = 'block' : document.getElementById('inputMessageError').style.display = 'none';
})



let span = document.querySelector(".up");

window.onscroll = function () {
    if (this.scrollY >= 300) {
        span.classList.add('show');
    } else {
        span.classList.remove('show');
    }
}

span.onclick = () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}


let sections = document.querySelectorAll('section');
// console.log(sections[0].offsetHeight);

window.onscroll = () => {
    let scrollHeghit = this.scrollY;
    if (scrollHeghit > (sections[0].offsetHeight - 58)) { 
        header.classList.add('back-color');
    } else {
        header.classList.remove('back-color');
    }
}

