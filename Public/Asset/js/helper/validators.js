
export function onSaveValidate(element, message, validFeedback, invalidFeedback, invalidOptions, regex, maxLength) {
    element.classList.remove('is-invalid', 'is-valid');
    if (element.tagName.toLowerCase() === 'select') {
        if (element.value === invalidOptions) {
            console.log("masuk");
            element.classList.add('is-invalid');
            invalidFeedback.textContent = `${message} Tidak boleh kosong!`;
            return false;
        }
    } else if (invalidOptions == null) {
        if (element.value.trim() === '') {
            element.classList.add('is-invalid');
            invalidFeedback.textContent = `${message} Tidak boleh kosong!`;
            return false;
        } else if (element.value.trim().length > maxLength) {
            element.classList.add('is-invalid');
            invalidFeedback.textContent = `${message} maksimum terdiri dari ${maxLength} digit.`;
            return false;
        } else if (regex != null && !regex.test(element.value.trim())) {
            element.classList.add('is-invalid');
            invalidFeedback.textContent = `${message} tidak valid!`;
            return false;
        }
    }
    element.classList.add('is-valid');
    validFeedback.textContent = `${message} terlihat baik!`;
    return true;
}

export function blurValidate(element, message, validFeedback, invalidFeedback, invalidOptions, regex, maxLength) {
    element.addEventListener('blur', () => {
        element.classList.remove('is-invalid', 'is-valid');
        if (element.tagName.toLowerCase() === 'select') {
            if (element.value === invalidOptions) {
                element.classList.add('is-invalid');
                invalidFeedback.textContent = `${message} Tidak boleh kosong!`;
                return false;
            }
        } else if (invalidOptions == null) {
            if (element.value.trim() === '') {
                element.classList.add('is-invalid');
                invalidFeedback.textContent = `${message} Tidak boleh kosong!`;
                return false;
            } else if (element.value.trim().length > maxLength) {
                element.classList.add('is-invalid');
                invalidFeedback.textContent = `${message} maksimum terdiri dari ${maxLength} digit.`;
                return false;
            } else if (regex != null && !regex.test(element.value.trim())) {
                element.classList.add('is-invalid');
                invalidFeedback.textContent = `${message} tidak valid!`;
                return false;
            }
        }
        element.classList.add('is-valid');
        validFeedback.textContent = `${message} terlihat baik!`;
        return true;
    });
}

export function sliceUri() {
    return window.location.pathname.split("/").pop();
}