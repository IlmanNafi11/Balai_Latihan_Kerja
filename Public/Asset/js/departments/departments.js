import {questionAlert, errorAlert, successAlert, cancelAlert} from "../helper/exceptions.js";

window.deleteDepartments = deleteDepartments;
function deleteDepartments(id) {
    questionAlert("Hapus data?", "Data tidak dapat dikembalikan setelah dihapus!", "Ya, Hapus", () => {
        axios.delete(`/department/delete/${id}`)
            .then((response) => {
                if (response.data.success) {
                    let row = document.getElementById(`row-${id}`);
                    if (row){
                        row.remove();
                    }
                    successAlert("Data berhasil dihapus!", response.data.redirect_url, false);
                } else {
                    errorAlert(response.data.message);
                }
            })
            .catch((error) => {
                errorAlert(error.message);
            });
    }, () => {
        cancelAlert("Data anda aman :)")
    });
}