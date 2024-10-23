const loginButton = document.getElementById('login-button');
const validEmail = document.getElementById('valid-feedback-email');
const invalidEmail = document.getElementById('invalid-feedback-email');
const validPassword = document.getElementById('valid-feedback-password');
const invalidPassword = document.getElementById('invalid-feedback-password');
let email = document.getElementById('input-email');
let password = document.getElementById('input-password');

function validate() {


    email.addEventListener('blur', () => {
        email.classList.remove('is-valid', 'is-invalid');
        if (email.value.trim() === '') {
            email.classList.add('is-invalid');
            invalidEmail.textContent = 'Email tidak boleh kosong';
            isValid = false;
        }
    });

    password.addEventListener('blur', () => {
        password.classList.remove('is-invalid', 'is-valid');
        if (password.value.trim() === '') {
            password.classList.add('is-invalid');
            invalidPassword.textContent = 'Password tidak boleh kosong';
            isValid = false;
        }
    });
}

loginButton.addEventListener('click', () => {
    let isValid = true;
    if (email.value.trim() === '') {
        email.classList.add('is-invalid');
        invalidEmail.textContent = 'Email tidak boleh kosong';
        isValid = false;
    }

    if (password.value.trim() === '') {
        password.classList.add('is-invalid');
        invalidPassword.textContent = 'Password tidak boleh kosong';
        isValid = false;
    }
    validate();

    if (isValid) {
        // Logika login
        // Mengirim request login menggunakan Axios
        axios.post('/login', {
            email: email.value,
            password: password.value
        })
            .then(response => {
                const data = response.data;
                console.log(data);
                if (data.status === 'success') {
                    window.location.href = data.redirect_url;
                } else {
                    alert(data.message); // Tampilkan pesan error
                }
            })
            .catch(error => {
                console.error(error);
                alert("Terjadi kesalahan saat mencoba login. Silakan coba lagi.");
            });
    }
});