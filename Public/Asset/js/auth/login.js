import {blurValidate, onSaveValidate} from "../helper/validators.js";
import {errorAlert} from "../helper/exceptions.js";

const loginButton = document.getElementById('login-button');
const validEmail = document.getElementById('valid-feedback-email');
const invalidEmail = document.getElementById('invalid-feedback-email');
const validPassword = document.getElementById('valid-feedback-password');
const invalidPassword = document.getElementById('invalid-feedback-password');
let email = document.getElementById('input-email');
let password = document.getElementById('input-password');

blurValidate(email, "Email", validEmail, invalidEmail, null, null, 100);
blurValidate(password, "Password", validPassword, invalidPassword, null, null, 100);


loginButton.addEventListener('click', () => {
    let isValid = true;
    isValid = onSaveValidate(email, "Email", validEmail, invalidEmail, null, null, 100) && isValid;
    isValid = onSaveValidate(password, "Password", validPassword, invalidPassword, null, null, 100) && isValid;

    if (isValid) {
        axios.post('/login', {
            email: email.value,
            password: password.value
        })
            .then(response => {
                const data = response.data;
                if (data.status === 'success') {
                    window.location.href = data.redirect_url;
                } else {
                    errorAlert(data.message);
                }
            })
            .catch(error => {
                errorAlert(error.message);
            });
    }
});