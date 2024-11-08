<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Core UI Css-->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/coreui.min.css" rel="stylesheet"
          integrity="sha384-lBISJVJ49zh34fnUuAaSAyuYzQ2ioGvhm4As4Z1JFde0kVpaC1FFWD3f9adpZrdD" crossorigin="anonymous">

    <!-- Google Font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet">

    <link rel="stylesheet" href="/Asset/css/style.css">
    <title>Login | BLK NGANJUK</title>
</head>

<body>
<!--        ROOT Container      -->
<div class="container-fluid root-container-login main-root-container p-0 d-flex">
    <div class="container-login d-flex flex-column align-items-center justify-content-center rounded py-5 m-auto">
        <div class="inner-container h-100">
            <!-- Title -->
            <div class="title-container mb-4">
                <h3 class="m-0">Selamat Datang</h3>
                <small>Silahkan login untuk akses penuh.</small>
            </div>
            <form action="/login" method="post" class="my-2 form-login d-flex flex-column h-100">
                <div class="input-field-container w-100 p-0 m-0 d-flex flex-column row-gap-3">
                    <div class="email-field form-floating w-100 mb-2">
                        <input type="email" name="email" class="form-control" placeholder="Masukan email anda"
                               id="input-email">
                        <label for="email" id="email-label" class="form-label">Email</label>
                        <div class="valid-feedback" id="valid-feedback-email"></div>
                        <div class="invalid-feedback" id="invalid-feedback-email"></div>
                    </div>
                    <div class="password-field form-floating w-100 mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Masukan kata sandi"
                               id="input-password">
                        <label for="password" id="password-label" class="form-label">Kata sandi</label>
                        <div class="valid-feedback" id="valid-feedback-password"></div>
                        <div class="invalid-feedback" id="invalid-feedback-password"></div>
                    </div>
                    <div class="forgot-pass-field mb-4">
                        <small><a href="/password-reset/request" class="text-decoration-none label-reference-credensial">Lupa kata
                                sandi?</a></small>
                    </div>
                </div>
                <div class="login-btn-container w-100 d-flex justify-content-center">
                    <a>
                        <button type="button" class="btn btn-login btn-credensial" name="login" id="login-button">
                            Masuk
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--    Script Js Core UI-->
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/coreui.bundle.min.js"
        integrity="sha384-yoEOGIfJg9mO8eOS9dgSYBXwb2hCCE+AMiJYavhAofzm8AoyVE241kjON695K1v5"
        crossorigin="anonymous"></script>

<!-- AXIOS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="module" src="/Asset/js/auth/login.js"></script>

</body>
</html>