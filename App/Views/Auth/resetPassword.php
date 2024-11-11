
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
<div class="container-fluid root-container-reset-password main-root-container p-0 d-flex">
    <div class="container-reset-password d-flex flex-column align-items-center justify-content-center rounded py-5 m-auto">
        <div class="inner-container h-100">
            <!-- Back Button -->
            <div class="back-button-container mb-3">
                <div>
                    <a class="text-decoration-none" id="back-button">
                        <img width="18" height="18" src="https://img.icons8.com/ios/50/back--v1.png" alt="back--v1"/>
                        <small class="title-back-button small-subtitle">Kembali</small>
                    </a>
                </div>
            </div>
            <!-- Title -->
            <div class="title-container mb-4 d-flex flex-column row-gap-3">
                <h3 class="m-0">Tetapkan Kata Sandi</h3>
                <small class="subtitle-container">Silakan atur kata sandi baru untuk akun Anda.</small>
            </div>
            <form class="form-reset-password d-flex flex-column h-100 row-gap-4">
                <div class="input-field-container w-100 p-0 m-0 d-flex flex-column row-gap-3">
                    <div class="password-field form-floating w-100 mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Kata Sandi"
                               id="input-new-password">
                        <label for="password" id="password-label" class="form-label">Kata Sandi Baru</label>
                        <div class="valid-feedback" id="valid-new-password"></div>
                        <div class="invalid-feedback" id="invalid-new-password"></div>
                    </div>
                </div>
                <div class="reset-password-btn-container w-100 d-flex justify-content-center">
                    <button type="button" class="btn btn-reset btn-credensial" name="reset" id="btn-reset">Perbarui</button>
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

</body>
</html>