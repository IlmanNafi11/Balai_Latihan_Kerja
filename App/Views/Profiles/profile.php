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
    <link rel="stylesheet" href="/Asset/css/style.css">

    <!-- Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <title>Profil | BLK</title>
</head>

<body>

    <!-- ROOT Container -->
    <div class="container-fluid main-root-container m-0 p-0 w-100 h-100">
        <!-- Navbar -->
        <?php require_once '../App/Views/Layout/navbar.php' ?>
        <!-- Container Content -->
        <div class="container-fluid container-content d-flex flex-column">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                </ol>
            </nav>

            <!-- Hero -->
            <div class="hero-container-section h-auto d-flex flex-column align-items-center py-4 rounded row-gap-3">
                <div class="avatar avatar-profile-admin position-relative">
                    <img class="avatar-img w-100 h-100" src="<?php $users ?? null;
                    echo $profile ?? null?>" alt="profile-picture">
                    <div class="changes-foto-profile-container position-absolute">
                        <div class="avatar avatar-camera-change">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" width="16" height="16"
                                class="bi bi-camera avatar-img h-auto w-auto overflow-visible" viewBox="0 0 16 16">
                                <path
                                    d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                                <path
                                    d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                            </svg>
                            <input type="file" id="fileInput" accept=".jpg,.jpeg,.png" style="display: none;" />
                        </div>
                    </div>
                </div>
                <div class="subtitle-admin-profile d-flex flex-column">
                    <span><?php echo $users['users']['nama'] ?? "Undefined"; ?></span>
                    <small><?php echo $users['users']['role'] ?? "Undefined"; ?></small>
                </div>
            </div>

            <!-- Form -->
            <form action="" method="post" class="mt-3">
                <div class="form-profile-admin-container d-flex column-gap-4 row-gap-3">
                    <div class="container-form-input flex-grow-1 d-flex flex-column column-gap-4 row-gap-3">
                        <div class="input-nama-admin">
                            <label for="nama-admin" class="form-label">Nama</label>
                            <input type="text" name="nama-admin" id="nama-admin" class="form-control" placeholder="Nama"
                                value="<?php echo $users['users']['nama'] ?? "Undefined"; ?>">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="input-no-hp-admin">
                            <label for="no-hp-admin" class="form-label">Nomor Telepon</label>
                            <input type="number" name="no-hp-admin" id="no-hp-admin" class="form-control"
                                placeholder="Nomor Telepon" value="<?php echo $users['users']['tlp'] ?? "Undefined"; ?>">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="container-form-input flex-grow-1 d-flex flex-column column-gap-4 row-gap-3">
                        <div class="input-email-admin">
                            <label for="email-admin" class="form-label">Email</label>
                            <input type="email" name="email-admin" id="email-admin" class="form-control"
                                placeholder="Email" value="<?php echo $users['users']['email'] ?? "Undefined"; ?>" disabled>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="input-alamat-admin">
                            <label for="alamat-admin" class="form-label">Alamat</label>
                            <input type="text" name="alamat-admin" id="alamat-admin" class="form-control"
                                placeholder="Alamat" value="<?php echo $users['users']['alamat'] ?? "Undefined"; ?>">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                    <button class="btn btn-primary" id="perbarui-profile">Perbarui</button>
                    <button class="btn btn-danger" type="button" onclick="history.back()">Batal</button>
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
    <script src="/Asset/js/script.js"></script>

    <!-- AXIOS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Logic Handler -->
    <script type="module" src="/Asset/js/profiles/updateProfiles.js"></script>

</body>

</html>