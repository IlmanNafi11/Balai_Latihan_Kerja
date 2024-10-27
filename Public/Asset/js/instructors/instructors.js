import {successAlert, errorAlert, questionAlert, cancelAlert} from "../helper/exceptions.js";

window.deleteInstructor = deleteInstructor;
function deleteInstructor(id) {
    questionAlert("Hapus data?", "Data tidak dapat dikembalikan setelah dihapus!", "Hapus", () => {
        axios.delete(`/instructor/deleteInstructor/${id}`)
            .then(response => {
                successAlert("Data berhasil dihapus!", response.data.redirect_url);
            })
            .catch((error) => {
                errorAlert(`Terjadi Kesalahan: ${error}`);
            });
    }, cancelAlert);
}