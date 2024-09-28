<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Core UI css -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/css/themes/bootstrap/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-72sGGfjIx6qT6nqLY5JXJdwHV+8GR6BXqIJMnei1+xNtrRVP9GM/vFJ3+9345bt/"
        crossorigin="anonymous">

    <!--    Custom Css-->
    <link rel="stylesheet" href="../../Asset/css/style.css">

    <!-- Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <title>Instruktor | BLK</title>
</head>

<body>

    <!-- ROOT Container -->
    <div class="container-fluid main-root-container m-0 p-0 w-100 h-100">
        <!-- Navbar -->
        <?php require_once '../Layout/navbar.php' ?>
        <!-- Container Content -->
        <div class="container-fluid container-content d-flex flex-column">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                </ol>
            </nav>

            <!-- Hero -->
            <div
                class="hero-container-section h-auto d-flex flex-column align-items-center py-4 rounded row-gap-3">
                <div class="avatar avatar-profile-admin">
                    <img class="avatar-img w-100 h-100" src="../../Asset/images/me.jpg" alt="user@email.com">
                </div>
                <div class="subtitle-admin-profile d-flex flex-column">
                    <span>Fitri Meydayani</span>
                    <small>Administrator</small>
                </div>
            </div>

            <!-- Form -->
            <form action="" method="post" class="mt-3">
                <div class="form-profile-admin-container d-flex column-gap-4 row-gap-3">
                <div class="container-form-input flex-grow-1 d-flex flex-column column-gap-4 row-gap-3">
                    <div class="input-nama-admin">
                        <label for="nama-admin" class="form-label">Nama</label>
                        <input type="text" name="nama-admin" id="nama-admin" class="form-control" placeholder="Nama"
                            value="Fitri Meydayani" required>
                    </div>
                    <div class="input-no-hp-admin">
                        <label for="no-hp-admin" class="form-label">Nomor Telepon</label>
                        <input type="number" name="no-hp-admin" id="no-hp-admin" class="form-control"
                            placeholder="Nomor Telepon" value="085234232134" required>
                    </div>
                </div>
                <div class="container-form-input flex-grow-1 d-flex flex-column column-gap-4 row-gap-3">
                    <div class="input-email-admin">
                        <label for="email-admin" class="form-label">Email</label>
                        <input type="email" name="email-admin" id="email-admin" class="form-control" placeholder="Email"
                            value="fitri@gmail.com" required>
                    </div>
                    <div class="input-alamat-admin">
                        <label for="alamat-admin" class="form-label">Alamat</label>
                        <input type="text" name="alamat-admin" id="alamat-admin" class="form-control"
                            placeholder="Alamat" value="Nganjuk, Nganjuk, Jawa Timur" required>
                    </div>
                </div>
                </div>
                <div class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                    <a href="#"><button class="btn btn-primary">Perbarui</button></a>
                    <a href="#"><button class="btn btn-danger" type="button">Batal</button></a>
                </div>
            </form>
        </div>
    </div>

    <!--    Bootstrap Js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Core UI Js -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-i+Yu7CmJG/p8FA6Avyg4ZheFvxNjJQ5taj5ArZf94yQt1lWZiVwkXyPrgE/QqbJi"
        crossorigin="anonymous"></script>

    <!-- Custom Js-->
    <script src="../../Asset/js/script.js"></script>

</body>

</html>