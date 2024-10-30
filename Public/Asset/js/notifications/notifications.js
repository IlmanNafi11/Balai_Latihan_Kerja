import {questionAlert, cancelAlert, successAlert, errorAlert} from "../helper/exceptions.js";

window.deleteNotification = deleteNotification;

function deleteNotification(id) {
    questionAlert("Hapus Data?", "Data tidak bisa dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/notification/delete/${id}`)
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
            });
    }, () => {
        cancelAlert("Data anda aman :)");
    })
}