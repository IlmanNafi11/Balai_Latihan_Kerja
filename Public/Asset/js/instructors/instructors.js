import {successAlert, errorAlert, questionAlert, cancelAlert} from "../helper/exceptions.js";

window.deleteInstructor = deleteInstructor;
function deleteInstructor(id) {
    questionAlert("Hapus data?", "Data tidak dapat dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/instructor/deleteInstructor/${id}`)
            .then(response => {
                const row = document.getElementById(`row-${id}`);
                if (row){
                    row.remove();
                }
                successAlert("Data berhasil dihapus!", response.data.redirect_url, false);
            })
            .catch((error) => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)");
    });
}