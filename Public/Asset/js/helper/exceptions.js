const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    }, buttonsStyling: false
});

export function questionAlert(title, message, confirmText, onConfirm, onCancel) {
    swalWithBootstrapButtons.fire({
        title: title,
        text: message,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: "Batal!",
        reverseButtons: true
    })
        .then((result) => {
            if (result.isConfirmed) {
                if (onConfirm && typeof onConfirm === 'function') {
                    onConfirm();
                }
            } else if (onCancel && typeof onCancel === 'function') {
                onCancel();
            }
        });
}

export function successAlert(successMessage, response) {
    swalWithBootstrapButtons.fire({
        title: "Sukses!",
        text: successMessage,
        icon: "success"
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = response;
            }
        });
}

export function errorAlert(errorMessage) {
    swalWithBootstrapButtons.fire({
        title: "Gagal!",
        text: errorMessage,
        icon: "error"
    });
}

export function cancelAlert() {
    swalWithBootstrapButtons.fire({
        title: "Dibatalkan",
        text: "Data anda aman :)",
        icon: "error"
    });
}