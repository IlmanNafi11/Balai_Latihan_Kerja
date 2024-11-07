import {successAlert, errorAlert, cancelAlert, questionAlert} from "../helper/exceptions.js";
import {sliceUri} from "../helper/validators.js";

window.deletePrograms = deletePrograms;
function deletePrograms(id){
    questionAlert("Hapus Data?", "Data tidak dapat dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`programs/${id}`)
            .then(response => {
                if (response.data.success) {
                    const row = document.getElementById(`row-${id}`);
                    if (row) {
                        row.remove();
                    }
                    successAlert("Data Berhasil dihapus!", response.data.redirect_url, false);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch(error => {
                errorAlert(error.message);
            })
    }, () => {
        cancelAlert("Data anda aman :)")
    })
}