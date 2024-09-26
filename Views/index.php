<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Core UI Css-->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/coreui.min.css" rel="stylesheet"
          integrity="sha384-lBISJVJ49zh34fnUuAaSAyuYzQ2ioGvhm4As4Z1JFde0kVpaC1FFWD3f9adpZrdD"
          crossorigin="anonymous">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="../Asset/css/style.css">
    <title>Login | BLK NGANJUK</title>
</head>

<body>
<!--        ROOT Container      -->
<div class="container-fluid m-0 p-0 w-100 h-100 d-flex">
    <div class="container-login d-flex flex-column align-items-center justify-content-center rounded py-4">
        <div class="inner-container">
            <div class="title-container">
                <h3>Selamat datang</h3>
                <span>Pilih salah satu opsi untuk masuk</span>
            </div>
            <form action="" class="mx-auto form-login d-flex flex-column">
                <div class="input-field-container w-100 p-0 m-0">
                    <div class="email-field w-100 mb-2">
                        <label for="email" id="email-label">email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="password-field w-100 mb-2">
                        <label for="password" id="password-label">Kata sandi</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="forgot-pass-field mb-3">
                        <span>Lupa kata sandi?</span>
                    </div>
                </div>

                <div class="action-form-login-container">
                    <div class="row">

                    </div>
                </div>
                <div class="sub-title d-flex align-items-center column-gap-2 mb-3">
                    <hr class="horizontal-rules flex-grow-1">
                    <span>atau lanjut dengan</span>
                    <hr class="horizontal-rules flex-grow-1">
                </div>
                <div class="log-with-google">
                    <button class="btn btn-log-with-google w-100 mb-4"
                            style="background-color: #F7F7F7;"><img width="28" height="28"
                                                                    src="https://img.icons8.com/color/48/google-logo.png"
                                                                    alt="google-logo"/>Google
                    </button>
                </div>
                <div class="login-btn-container w-100 d-flex justify-content-center">
                    <button class="btn btn-login" name="login"
                            style="background-color: #FF9228; width: 10rem">Masuk
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>

<!--    Script Js Core UI-->
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/coreui.bundle.min.js"
        integrity="sha384-yoEOGIfJg9mO8eOS9dgSYBXwb2hCCE+AMiJYavhAofzm8AoyVE241kjON695K1v5"
        crossorigin="anonymous"></script>
</body>

</html>