import {emptyValidate, regexValidate, lengthValidate, sliceUri} from "../helper/validators.js";
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
        if (response.data.success) {
            name.value = response.data.dataByID.nama;
            email.value = response.data.dataByID.email;
            address.value = response.data.dataByID.alamat;
            phone.value = response.data.dataByID.no_tlp;
        } else if (!response.data.success) {
            errorAlert(response.data.message);
        }

    })
    .catch(error => {
        errorAlert(error.response);
    })

btnPerbarui.addEventListener('click', (e) => {
    e.preventDefault();

    // empty validations
    let isNameValid = emptyValidate(name, "Bagus!", "Nama Instruktor tidak boleh kosong", validName, invalidName);
    let isEmailValid = emptyValidate(email, "Bagus!", "Email Instruktor tidak boleh kosong", validEmail, invalidEmail);
    let isPhoneValid = emptyValidate(phone, "Bagus!", "No Telephon Instructor tidak boleh kosong", validPhone, invalidPhone);
    let isAddressValid = emptyValidate(address, "Bagus!", "Alamat Instruktor tidak boleh kosong", validAddress, invalidAddress);

    // regex validation
    isNameValid = isNameValid && regexValidate(name, "Bagus!", "Nama Instructor tidak valid", validName, invalidName, regexNama);
    isEmailValid = isEmailValid && regexValidate(email, "Bagus!", "Email Instruktor tidak valid", validEmail, invalidEmail, regexEmail);
    isPhoneValid = isPhoneValid && regexValidate(phone, "Bagus!", "No Telephon Instructor tidak valid", validPhone, invalidPhone, regexNoTlp);
    isAddressValid = isAddressValid && regexValidate(address, "Bagus!", "Alamat Instruktor tidak boleh kosong", validAddress, invalidAddress, regexKombinasi);

    // length validation
    isNameValid = isNameValid && lengthValidate(name, "Bagus", "Nama Istruktor tidak boleh lebih dari 50 digit", validName, invalidName, 50);
    isEmailValid = isEmailValid && lengthValidate(email, "Bagus", "Email Istruktor tidak boleh lebih dari 50 digit", validEmail, invalidEmail, 50);
    isPhoneValid = isPhoneValid && lengthValidate(phone, "Bagus", "Nomor Hp Istruktor harus terdiri dari 12-13 digit", validPhone, invalidPhone, 13, 12);
    isAddressValid = isAddressValid && lengthValidate(address, "Bagus", "Alamat Istruktor tidak boleh lebih dari 150 digit", validAddress, invalidAddress, 150);

    let isAllValid = isNameValid && isEmailValid && isPhoneValid && isAddressValid;
    if (isAllValid) {
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar", "Ya, Simpan", ()=> {
            axios.post(`instructor/updateInstructor/${id}`,{
                'name': name.value,
                'email': email.value,
                'phone': phone.value,
                'address': address.value,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert('Data Berhasil disimpan!', response.data.redirect_url);
                    } else if (!response.data.success) {
                        errorAlert('Terjadi Kesalahan');
                    }
                })
                .catch(error => {
                    errorAlert(`Terjadi Kesalahan: ${error.message}`);
                });
        });
    }
});