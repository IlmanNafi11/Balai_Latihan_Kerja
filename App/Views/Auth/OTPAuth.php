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
    <title>Lupa Kata Sandi | BLK NGANJUK</title>
</head>

<body>
<!--        ROOT Container      -->
<div class="container-fluid root-container-otp-verify main-root-container p-0 d-flex">
    <div class="container-otp-verify d-flex flex-column align-items-center justify-content-center rounded py-5 m-auto">
        <div class="inner-container h-100">
            <!-- Back Button -->
            <div class="back-button-container mb-3">
                <div>
                    <a href="/password-reset/request" class="text-decoration-none">
                        <img width="18" height="18" src="https://img.icons8.com/ios/50/back--v1.png" alt="back--v1"/>
                        <small class="title-back-button small-subtitle">Kembali</small>
                    </a>
                </div>
            </div>
            <!-- Title -->
            <div class="title-container mb-4 d-flex flex-column row-gap-3">
                <h3 class="m-0">Verifikasi Kode OTP</h3>
                <small class="subtitle-container">Masukan kode OTP yang telah dikirim ke email Anda.</small>
            </div>
            <form class="form-input-otp d-flex flex-column h-100 row-gap-4">
                <div class="input-field-container w-100 p-0 m-0 d-flex flex-column row-gap-3">
                    <div class="otp-field w-auto d-flex justify-content-center column gap-2">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                        <input type="text" maxlength="1" class="otp-input">
                    </div>
                    <div class="resend-container">
                        <small class="subtitle-resend-otp small-subtitle resend">Tidak menerima kode?</small>
                        <span class="otp-reSend-button text-decoration-none resend" id="resendOtp">Kirim Ulang</span>
                    </div>
                </div>
                <div class="verify-otp-btn-container w-100 d-flex justify-content-center">
                    <button type="button" class="btn btn-verify btn-credensial" name="verify" id="btn-verify-otp">
                        Selanjutnya
                    </button>
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

<script type="module" src="/Asset/js/auth/resetPassword.js"></script>

<script type="module" src="/Asset/js/script.js"></script>
</body>
</html>