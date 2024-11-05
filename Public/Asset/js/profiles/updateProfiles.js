import {errorAlert, successAlert, questionAlert} from "../helper/exceptions.js";
import {onSaveValidate, blurValidate, sliceUri} from "../helper/validators.js";

const name = document.getElementById('nama-admin');
const phone = document.getElementById('no-hp-admin');
const email = document.getElementById('email-admin');
const address = document.getElementById('alamat-admin');

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

document.getElementById('perbarui-profile').addEventListener('click', (e) => {
   e.preventDefault();
   let isValid = true;

   isValid = onSaveValidate(name, "Input Nama", validName, invalidName, null, regexName, 50) && isValid;
   isValid = onSaveValidate(phone, "Input Nomor Hp", validPhone, invalidPhone, null, regexNoTlp, 13) && isValid;
   isValid = onSaveValidate(email, "Input Email", validEmail, invalidEmail, null, regexEmail, 70) && isValid;
   isValid = onSaveValidate(address, "Input Alamat", validAddress, invalidAddress, null, regexKombinasi, 100) && isValid;

   if (isValid) {
       questionAlert("Perbarui Profil?", "Pastikan semua data telah diisi dengan benar!", "Ya, Perbarui", () => {
           axios.put(`profile/${id}`, {
               'name': name.value,
               'phone': phone.value,
               'address': address.value,
           })
               .then(response => {
                   if (response.data.success) {
                       successAlert("Profil Berhasil diperbarui!", "/dashboard")
                   } else {
                       errorAlert("Profil Gagal diperbarui!")
                   }
               })
               .catch(error => {
                   errorAlert(error.message);
               })
       })
   }
});