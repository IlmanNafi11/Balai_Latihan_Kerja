import {questionAlert, successAlert, errorAlert, cancelAlert} from "../helper/exceptions.js";

window.deleteBuilding = deleteBuilding;
function deleteBuilding(id) {
    questionAlert("Yakin Hapus data?", "Data tidak bisa dikembalikan setelah dihapus!", "Ya, Hapus!", () => {
        axios.delete(`/building/delete/${id}`)
            .then(response => {
                if (response.data.success) {
                    const row = document.getElementById(`row-${id}`);
                    if (row){
                        row.remove();
                    }
                    successAlert("Data Berhasil dihapus!", response.data.redirect_url, false);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch(error => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)");
    });
}