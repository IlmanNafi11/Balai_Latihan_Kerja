import {questionAlert} from "/Asset/js/helper/exceptions.js";

const hamburgerMenu = document.getElementById("hamburger-menu");
const sliderNavigation = document.getElementById("slider-navigation");

document.addEventListener("DOMContentLoaded", function () {
    const overlay = document.querySelector('.overlay-container');
    if (overlay) {
        setTimeout(function () {
            overlay.classList.add('overlay-hidden')
        }, 3000)
    }
})

if (hamburgerMenu) {
    hamburgerMenu.addEventListener("click", function () {
        hamburgerMenu.classList.toggle("active");
        sliderNavigation.classList.toggle("active");
    });
}


const inputs = document.querySelectorAll('.otp-field input');
if (inputs) {
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && index > 0 && input.value === '') {
                inputs[index - 1].focus();
            }
        });
    });
}

window.logOut = logOut;

function logOut() {
    questionAlert("Yakin keluar dari aplikasi?", "Anda harus login kembali jika sesi berakhir!", "Ya, Keluar", () => {
        window.location.href = "/logout"
    });
}


