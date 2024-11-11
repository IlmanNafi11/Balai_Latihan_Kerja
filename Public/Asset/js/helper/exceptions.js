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

export function successAlert(successMessage, redirectUri, autoRedirect = true) {
    swalWithBootstrapButtons.fire({
        title: "Sukses!",
        text: successMessage,
        icon: "success"
    })
        .then((result) => {
            if (result.isConfirmed && autoRedirect) {
                window.location.href = redirectUri;
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

export function cancelAlert(message) {
    swalWithBootstrapButtons.fire({
        title: "Dibatalkan",
        text: message,
        icon: "error"
    });
}

export function warningAlert(warningMessage) {
    swalWithBootstrapButtons.fire({
        title: "Peringatan!",
        text: warningMessage,
        icon: "warning"
    })
}