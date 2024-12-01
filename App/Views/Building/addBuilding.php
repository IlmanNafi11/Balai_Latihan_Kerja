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

    <title>Gedung | BLK</title>
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
                <li class="breadcrumb-item"><a href="/building">Gedung</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>

        <!-- Form -->
        <form method="post" class="d-flex flex-column h-auto form-control">
            <div class="form-building-container container-form-input d-flex flex-column column-gap-4 row-gap-3 h-100 w-100">
                <div class="input-nama-gedung flex-grow-1">
                    <label for="nama-gedung" class="form-label">Nama</label>
                    <input type="text" name="nama-gedung" id="nama-gedung" class="form-control"
                           placeholder="Contoh: Kuli Merdeka">
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="input-deskripsi-form flex-grow-1">
                    <label for="deskripsi-gedung" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi-gedung" id="deskripsi-gedung" class="form-control"
                              placeholder="Contoh : Lorem Ipsum is simply dummy text of the printing and typesetting industry."></textarea>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                <a href="">
                    <button class="btn btn-primary" id="btn-simpan" type="button">Simpan</button>
                </a>
                <a href="/building">
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

<!-- Client side handler -->
<script type="module" src="/Asset/js/buildings/addBuildings.js"></script>

<!-- Custom Js-->
<script type="module" src="/Asset/js/script.js"></script>

</body>

</html>