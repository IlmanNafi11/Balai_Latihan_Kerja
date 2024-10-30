import {successAlert, errorAlert, questionAlert, cancelAlert} from "../helper/exceptions.js";

window.deleteTools = deleteTools;

function deleteTools(id) {
    questionAlert("Hapus Data?", "Data tidak dapat dikembalikan setelah dihapus!", "Ya Hapus", () => {
        axios.delete(`/tools/delete/${id}`)
            .then(response => {
                if (response.data.success) {
                    const row = document.getElementById(`row-${id}`);
                    if (row) {
                        row.remove();
                    }
                    successAlert("Data Berhasil dihapus!", response.data.redirect_url, false)
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch(error => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)")
    });
}