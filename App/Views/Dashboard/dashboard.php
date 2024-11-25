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

    <title>Dashboard | BLK</title>
</head>

<body>
<!-- ROOT Container -->
<div class="container-fluid m-0 p-0 main-root-container h-100 w-100">
    <!--Top Navbar-->
    <?php
    require_once '../App/Views/Layout/navbar.php';
    ?>

    <!-- Container Content -->
    <div class="container-fluid container-content d-flex flex-column">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-beranda">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
        </nav>

        <!-- Hero Card Informations -->
        <div class="hero-card-dashboard-information d-flex p-0 m-0 column-gap-3">
            <?php if (!empty($summary) && !$summary['isEmpty']) {
                foreach ($summary['data'] as $data):
                    // Menentukan nilai yang akan ditampilkan berdasarkan nama tabel
                    $total = $data['total'];
                    $title = ''; // Inisialisasi judul
                    $iconSrc = ''; // Inisialisasi ikon gambar

                    // Menentukan judul dan ikon sesuai dengan table_name
                    switch ($data['table_name']) {
                        case 'departments':
                            $title = 'Total Kejuruan';
                            $iconSrc = '/Asset/images/kejuruan_icons.png';
                            break;
                        case 'programs':
                            $title = 'Total Program';
                            $iconSrc = '/Asset/images/program_icons.png';
                            break;
                        case 'instructors':
                            $title = 'Total Instruktor';
                            $iconSrc = '/Asset/images/instructor_icons.png';
                            break;
                        case 'buildings':
                            $title = 'Total Gedung';
                            $iconSrc = '/Asset/images/building_icons.png';
                            break;
                        case 'tools':
                            $title = 'Total Alat';
                            $iconSrc = '/Asset/images/tools_icons.png';
                            break;
                    }
                    ?>
                    <div class="card-items-dashboard-informations d-flex rounded align-items-center justify-content-between flex-grow-1 p-3">
                        <div class="card-items subtitle d-flex flex-column">
                            <span><?php echo $title; ?></span>
                            <span><?php echo $total; ?></span>
                        </div>
                        <div class="avatar card-items content-icon">
                            <img class="avatar-img object-fit-cover w-100 h-100" src="<?php echo $iconSrc; ?>"
                                 alt="content-icon">
                        </div>
                    </div>
                <?php endforeach;
            } ?>
        </div>

        <div class="chart-container mt-5 d-flex border rounded">
            <div class="chartbar-container flex-grow-1 mh-100 p-3">
                <canvas id="ChartBar"></canvas>
            </div>
            <div class="side-chart-container flex-grow-1 d-flex flex-column w-25 mh-100">
                <div class="chartpie-container d-flex justify-content-center p-3">
                    <canvas id="ChartPie"></canvas>
                </div>
                <div class="chartPolar-container d-flex justify-content-center p-3">
                    <canvas id="ChartPolar"></canvas>
                </div>
            </div>
        </div>
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

<!-- Custmo Js-->
<script type="module" src="/Asset/js/script.js"></script>

<!-- Chart Js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>

<!-- Logic Handler-->
<script type="module" src="/Asset/js/dashboard/dashboard.js"></script>
</body>

</html>