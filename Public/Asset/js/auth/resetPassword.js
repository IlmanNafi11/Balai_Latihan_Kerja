import {questionAlert, successAlert, errorAlert, warningAlert} from "../helper/exceptions.js";
import {onSaveValidate} from "../helper/validators.js";

const inputEmail = document.getElementById("input-email");
const btnSendOtp = document.getElementById("btn-send-otp");
const validEmail = document.getElementById("valid-email-feedback");
const invalidEmail = document.getElementById("invalid-email-feedback");
const regexEmail = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;

if (btnSendOtp) {
    btnSendOtp.addEventListener("click", (e) => {
        e.preventDefault()
        let isValid = onSaveValidate(inputEmail, "Input Email", validEmail, invalidEmail, null, regexEmail, 50);
        if (isValid) {
            let email = inputEmail.value;
            questionAlert(`Kirim kode OTP ke ${email}?`, "Pastikan anda memiliki akses terhadap akun anda.", "Ya, Kirim", () => {
                axios.post(`/password-reset/request`, {
                    'email': email
                })
                    .then(response => {
                        if (response.data.success && !response.data.isEmpty) {
                            successAlert(response.data.message, response.data.redirect);
                        } else {
                            errorAlert(response.data.message);
                        }
                    })
                    .catch(error => {
                        errorAlert(error.response.data.message);
                    })
            })
        }
    })
}

const resendButton = document.getElementById('resendOtp');

function startCountdown() {
    let countdownTime = 300;
    if (resendButton) {
        resendButton.classList.remove('enabled');
        let timer = setInterval(function () {
            let minutes = Math.floor(countdownTime / 60);
            let seconds = countdownTime % 60;

            resendButton.innerHTML = "Kirim ulang dalam " + minutes + "m " + seconds + "s";

            countdownTime--;

            if (countdownTime <= 0) {
                clearInterval(timer);
                resendButton.innerHTML = "Kirim Ulang";
                resendButton.classList.add('enabled');
                resendButton.addEventListener("click", resendOtp);
            }
        }, 1000);
    }
    return countdownTime;
}

function resendOtp() {
    axios.post(`/password-reset/resend`)
        .then(response => {
            if (response.data.success) {
                startCountdown();
            } else {
                errorAlert(response.data.message);
            }
        })
        .catch(error => {
            errorAlert(error.response.data.message);
        })
}

window.onload = () => {
    startCountdown();
};

const btnVerifyOtp = document.getElementById("btn-verify-otp");
if (btnVerifyOtp) {
    btnVerifyOtp.addEventListener("click", (e) => {
        e.preventDefault();
        const otpInputs = document.querySelectorAll('.otp-input');
        let otpCode = '';

        otpInputs.forEach(input => {
            otpCode += input.value;
        });
        if (otpCode.length === otpInputs.length) {
            axios.post(`/password-reset/verify`, {
                'otp': otpCode
            })
                .then(response => {
                    if (response.data.success) {
                        window.location.href = response.data.redirect_url;
                    } else {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.response.data.message);
                })
        } else {
            warningAlert("Kode OTP tidak boleh kosong!");
        }

    })
}

const newPassword = document.getElementById("input-new-password");
const validNewPassword = document.getElementById("valid-new-password");
const invalidPassword = document.getElementById("invalid-new-password");
const regexPassword = /^[a-zA-Z0-9]+$/;
const btnReset = document.getElementById('btn-reset');

if (btnReset) {
    btnReset.addEventListener("click", (e) => {
        e.preventDefault();
        let isValid = onSaveValidate(newPassword, "Kata Sandi", validNewPassword, invalidPassword, null, regexPassword, 15);

        if (isValid) {
            questionAlert("Perbarui Kata Sandi?", "Pastikan Kata sandi yang baru mudah diingat!", "Ya, Perbarui", () => {
                axios.put(`/password-reset/new`, {
                    'password': newPassword.value
                })
                    .then(response => {
                        if (response.data.success) {
                            successAlert("Kata Sandi berhasil diperbarui!", response.data.redirect);
                        } else {
                            errorAlert(response.data.message);
                        }
                    })
                    .catch(error => {
                        errorAlert(error.response.data.message);
                    })
            })
        }
    })
}

const backButton = document.getElementById('back-button');
if (backButton) {
    backButton.addEventListener("click", (e) => {
        axios.get(`/password-reset/reset-step`)
            .then(response => {
                if (response.data.success) {
                    window.location.href = response.data.redirect;
                }
            })
            .catch(error => {
                errorAlert(error.response.data.message);
            })
    })
}