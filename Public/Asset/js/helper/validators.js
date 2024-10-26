export function emptyValidate(element, validMessage,invalidMessage, validFeedback, invalidFeedback) {
    element.classList.remove('is-invalid', 'is-valid');
    if (element.value.trim() === '') {
        element.classList.add('is-invalid');
        invalidFeedback.textContent = invalidMessage;
        return false;
    }
    element.classList.add('is-valid');
    validFeedback.textContent = validMessage;
    return true;
}

export function regexValidate(element, validMessage,invalidMessage, validFeedback, invalidFeedback, regex) {
    element.classList.remove('is-invalid', 'is-valid');
    if (!regex.test(element.value.trim())) {
        element.classList.add('is-invalid');
        invalidFeedback.textContent = invalidMessage;
        return false;
    }
    element.classList.add('is-valid');
    validFeedback.textContent = validMessage;
    return true;
}

export function lengthValidate(element, validMessage,invalidMessage, validFeedback, invalidFeedback, maxLength, minLength = 0) {
    element.classList.remove('is-invalid', 'is-valid');
    if (element.value.trim().length > maxLength) {
        element.classList.add('is-invalid');
        invalidFeedback.textContent = invalidMessage;
        return false;
    }

    if (element.value.trim().length < minLength) {
        element.classList.add('is-invalid');
        invalidFeedback.textContent = invalidMessage;
        return false;
    }
    element.classList.add('is-valid');
    validFeedback.textContent = validMessage;
    return true;
}

export function sliceUri(){
    return window.location.pathname.split("/").pop();
}