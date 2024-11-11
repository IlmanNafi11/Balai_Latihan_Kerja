import {cancelAlert, errorAlert, questionAlert, successAlert} from "../helper/exceptions.js";

window.deleteUser = deleteUser;
function deleteUser(id){
    questionAlert("Hapus Data Pengguna?", "Data termasuk akun, tidak dapat dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/user/${id}`)
            .then(response => {
                if (response.data.success) {
                    successAlert("Data Berhasil dihapus!", response.data.redirect);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch(error => {
                errorAlert(error.response.data.message);
            });
    }, () => {
        cancelAlert("Data Pengguna Aman :)")
    })
}