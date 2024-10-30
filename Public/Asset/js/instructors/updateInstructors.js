import {sliceUri, blurValidate, onSaveValidate} from "../helper/validators.js";
import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";

const name = document.getElementById('nama-instruktor');
const email = document.getElementById('email-instruktor');
const address = document.getElementById('alamat-instruktor');
const phone = document.getElementById('no-hp-instruktor');

const validName = name.nextElementSibling;
const invalidName = validName.nextElementSibling;
const validEmail = email.nextElementSibling;
const invalidEmail = validEmail.nextElementSibling;
const validPhone = phone.nextElementSibling;
const invalidPhone = validPhone.nextElementSibling;
const validAddress = address.nextElementSibling;
const invalidAddress = validAddress.nextElementSibling;

const regexNama = /^[a-zA-Z ,.']+$/;
const regexNoTlp = /^08[0-9]+$/;
const regexEmail = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
const regexKombinasi = /^[a-zA-Z0-9 ,.]+$/;

let id = sliceUri();

const btnPerbarui = document.getElementById('btn-perbarui');

axios.get(`instructor/getInstructor/${id}`)
    .then(response => {
        if (response.data.success && !response.data.isEmpty) {
            name.value = response.data.instructor.nama;
            email.value = response.data.instructor.email;
            address.value = response.data.instructor.alamat;
            phone.value = response.data.instructor.no_tlp;
        } else {
            errorAlert(response.data.message);
        }
    })
    .catch(error => {
        errorAlert(error.message);
    })

blurValidate(name, "Nama Instruktor", validName, invalidName, null, regexNama, 50);
blurValidate(email, "Email Instruktor", validEmail, invalidEmail, null, regexEmail, 50);
blurValidate(phone, "Nomor Hp Instruktor", validPhone, invalidPhone, null, regexNoTlp, 13);
blurValidate(address, "Alamat Instruktor", validAddress, invalidAddress, null, regexKombinasi, 150);

btnPerbarui.addEventListener('click', (e) => {
    e.preventDefault();
    let isValid = true;

    isValid = onSaveValidate(name, "Nama Instruktor", validName, invalidName, null, regexNama, 50) && isValid;
    isValid = onSaveValidate(email, "Email Instruktor", validEmail, invalidEmail, null, regexEmail, 50) && isValid;
    isValid = onSaveValidate(phone, "Nomor Hp Instruktor", validPhone, invalidPhone, null, regexNoTlp, 13) && isValid;
    isValid = onSaveValidate(address, "Alamat Instruktor", validAddress, invalidAddress, null, regexKombinasi, 150) && isValid;

    if (isValid) {
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar", "Ya, Simpan", () => {
            axios.post(`instructor/updateInstructor/${id}`, {
                'name': name.value,
                'email': email.value,
                'phone': phone.value,
                'address': address.value,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert('Data Berhasil diperbarui!', response.data.redirect_url);
                    } else {
                        errorAlert(response.data.message);
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                });
        });
    }
});