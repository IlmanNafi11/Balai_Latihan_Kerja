import {successAlert, errorAlert, questionAlert} from "../helper/exceptions.js";
import {blurValidate, onSaveValidate} from "../helper/validators.js";

const message = document.getElementById('pesan-notifikasi');
const btnSimpan = document.getElementById('btn-simpan');
const validMessage = message.nextElementSibling;
const invalidMessage = validMessage.nextElementSibling;
const regex = /^[a-zA-Z0-9 .,;()\-\/&"'!:]+$/;

blurValidate(message, "Pesan Notifikasi", validMessage, invalidMessage, null, regex, 255);
btnSimpan.addEventListener('click', e => {
    e.preventDefault();

    let isValid = onSaveValidate(message, "Pesan Notifikasi", validMessage, invalidMessage, null, regex, 255);
    if (isValid) {
        questionAlert("Simpan Data?", "Pastikan semua data telah diisi dengan benar!", "Ya, Simpan", () => {
            axios.post(`/notification/add`, {
                'message': message.value,
            })
                .then(response => {
                    if (response.data.success) {
                        successAlert(response.data.message, response.data.redirect);
                    }
                })
                .catch(error => {
                    errorAlert(error.message);
                });
        });
    }
});