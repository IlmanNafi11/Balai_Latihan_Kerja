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


    <title>Instruktor | BLK</title>
</head>

<body>
<!-- ROOT Container -->
<div class="container-fluid main-root-container w-100 h-100 p-0 m-0">
    <!-- Navbar -->
    <?php require_once '../App/Views/Layout/navbar.php' ?>

    <div class="container-fluid container-content d-flex flex-column h-auto">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/user">Data Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
            </ol>
        </nav>

        <!-- Form -->
        <form method="post" class="d-flex flex-column h-auto form-control">
            <div class="form-add-admin-container d-flex column-gap-4 row-gap-3 w-100 h-auto">
                <div class="container-form-input flex-grow-1 d-flex flex-column row-gap-3">
                    <div class="input-nama-admin">
                        <label for="nama-admin" class="form-label">Nama</label>
                        <input type="text" name="nama-admin" id="nama-admin" class="form-control"
                               placeholder="Contoh: Rigen">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-no-hp-admin">
                        <label for="no-hp-admin" class="form-label">Nomor Telepon</label>
                        <input type="text" name="no-hp-admin" id="no-hp-admin" class="form-control"
                               placeholder="Contoh : 08xxxxxx">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-email-admin">
                        <label for="email-admin" class="form-label">Email</label>
                        <input type="email" name="email-admin" id="email-admin" class="form-control"
                               placeholder="Contoh: rigen@gmail.com">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-kata-sandi-admin">
                        <label for="kata-sandi-admin" class="form-label">Kata Sandi</label>
                        <input type="password" name="kata-sandi-admin" id="kata-sandi-admin" class="form-control"
                               placeholder="Contoh: rigen12345">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-tanggal-lahir-admin">
                        <label for="tanggal-lahir-admin" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal-lahir-admin" id="tanggal-lahir-admin" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="container-form-input flex-grow-1 d-flex flex-column row-gap-3">
                    <div class="input-jenis-kelamin">
                        <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis-kelamin" id="jenis-kelamin" class="form-control">
                            <option value="default" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-alamat-admin">
                        <label for="alamat-admin" class="form-label">Alamat</label>
                        <input type="text" name="alamat-admin" id="alamat-admin" class="form-control"
                               placeholder="Contoh : Nganjuk, Nganjuk, Jawa Timur">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-pas-foto flex-grow-1 d-flex flex-column">
                        <label for="fileInput" class="form-label">Pas Foto</label>
                        <div class="upload-area w-100 m-0 p-3 flex-grow-1 d-flex flex-column align-items-center justify-content-center"
                             id="upload-area">
                            <img src="/Asset/images/upload_icons.png" alt="upload icon" id="uploadIcon"/>
                            <p id="uploadText">Upload file</p>
                            <small id="formatText">*jpg, png</small>
                            <input type="file" id="fileInput" accept=".jpg,.jpeg,.png" style="display: none"/>
                        </div>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                </div>
            </div>
            <div class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                <button class="btn btn-primary" id="btn-simpan">Simpan</button>
                <a href="/user">
                    <button class="btn btn-danger" type="button">Batal</button>
                </a>
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

<!-- AXIOS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom Js-->
<script type="module" src="/Asset/js/script.js"></script>

<!-- Logic Handler -->
<script type="module" src="/Asset/js/usersManagement/addAdmin.js"></script>

</body>

</html>