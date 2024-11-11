import {errorAlert, successAlert, questionAlert} from "../helper/exceptions.js";
import {onSaveValidate, blurValidate, sliceUri} from "../helper/validators.js";

const name = document.getElementById('nama-admin');
const phone = document.getElementById('no-hp-admin');
const email = document.getElementById('email-admin');
const address = document.getElementById('alamat-admin');
const profileContainer = document.querySelector('.changes-foto-profile-container');
const fileInput = document.getElementById('fileInput');
const profileImg = document.getElementById('profile-img');

const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validPhone = phone.nextElementSibling;
const invalidPhone = validPhone.nextElementSibling;
const validEmail = email.nextElementSibling;
const invalidEmail = validEmail.nextElementSibling;
const validAddress = address.nextElementSibling;
const invalidAddress = validAddress.nextElementSibling;
const id = sliceUri();

const regexName = /^[a-zA-Z ',.\s']+$/;
const regexNoTlp = /^08[0-9]+$/;
const regexEmail = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
const regexKombinasi = /^[a-zA-Z0-9 ,.]+$/;

blurValidate(name, "Input Nama", validName, invalidName, null, regexName, 50);
blurValidate(phone, "Input Nomor Hp", validPhone, invalidPhone, null, regexNoTlp, 13);
blurValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70);
blurValidate(address, "Input Alamat", validAddress, invalidAddress, null, regexKombinasi, 100);

profileContainer.addEventListener('click', () => {
    fileInput.click();
});

fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];
    if (file && file.size < 2 * 1024 * 1024) {
        const reader = new FileReader();
        reader.onload = function(e) {
            profileImg.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        errorAlert("Ukuran file maksimal 2 MB!");
    }
});

document.getElementById('perbarui-profile').addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;

    isValid = onSaveValidate(name, "Input Nama", validName, invalidName, null, regexName, 50) && isValid;
    isValid = onSaveValidate(phone, "Input Nomor Hp", validPhone, invalidPhone, null, regexNoTlp, 13) && isValid;
    isValid = onSaveValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70) && isValid;
    isValid = onSaveValidate(address, "Input Alamat", validAddress, invalidAddress, null, regexKombinasi, 100) && isValid;

    const file = fileInput.files[0];

    if (isValid) {
        questionAlert("Perbarui Profil?", "Pastikan semua data telah diisi dengan benar!", "Ya, Perbarui", () => {
            const formData = new FormData();
            formData.append('name', name.value);
            formData.append('phone', phone.value);
            formData.append('address', address.value);
            if (file) {
                formData.append('profile_picture', file);
            }

            axios.post(`profile/${id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert("Profil Berhasil diperbarui!", response.data.redirect);
                    } else {
                        errorAlert("Profil Gagal diperbarui!");
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                });
        });
    }
});