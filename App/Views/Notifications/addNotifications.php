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
    <link rel="stylesheet" href="../../../Public/Asset/css/style.css">

    <!-- Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Saira:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">


    <title>Notifikasi | BLK</title>
</head>

<body>
    <!-- ROOT Container -->
    <div class="container-fluid main-root-container w-100 h-100 p-0 m-0">
        <!-- Navbar -->
        <?php require_once '../Layout/navbar.php' ?>

        <div class="container-fluid container-content d-flex flex-column h-auto">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="breadcrumb-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/dashboard.php">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="notifications.php">Notifikasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                </ol>
            </nav>

            <!-- Form -->
            <form action="" method="post" class="d-flex flex-column h-auto">
                <div class="form-instruktor-container container-form-input d-flex column-gap-4 row-gap-3 w-100 h-auto">
                    <div class="input-pesan-notifikasi input-deskripsi-form w-100 h-auto">
                        <label for="pesan-notifikasi" class="form-label">Pesan Notifikasi</label>
                        <textarea name="pesan-notifikasi" id="pesan-notifikasi" class="form-control" placeholder="Contoh : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." required></textarea>
                    </div>
                </div>
                <div class="button-action-container-form my-3 d-flex w-100 h-auto justify-content-end column-gap-2">
                    <a href="#"><button class="btn btn-primary">Simpan</button></a>
                    <a href="notifications.php"><button class="btn btn-danger" type="button">Batal</button></a>
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
    <script src="../../../Public/Asset/js/script.js"></script>

</body>

</html>