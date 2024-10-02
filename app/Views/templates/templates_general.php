<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url("/assets/img/logo.png") ?>">
    <title>Iglesia Alameda | Censo</title>

    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/fontawesome-free/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/daterangepicker/daterangepicker.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/select2/css/select2.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/bs-stepper/css/bs-stepper.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/dropzone/min/dropzone.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/frames/dist/css/adminlte.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/assets/customize/css/censo.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("/assets/frames/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") ?>" />

    <script src="<?= base_url('/assets/frames/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url("/assets/frames/plugins/moment/moment.min.js") ?>"></script>
    <script src="<?= base_url("/assets/frames/plugins/moment/locale/es-mx.js") ?>"></script>
    <script src="<?= base_url("/assets/frames/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") ?>"></script>
    <script src="<?= base_url("/assets/frames/plugins/select2/js/select2.min.js") ?>"></script>
    
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?= base_url('/assets/frames/plugins/dropzone/min/dropzone.min.css') ?>">
    
</head>

<body class="hold-transition layout-top-nav">



    <!-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= base_url("/assets/img/as_logo.png") ?>" alt="AlamedaLogo" height="60" width="60">
    </div> -->

    <script src="<?= base_url("/assets/frames/plugins/jquery-ui/jquery-ui.min.js") ?>"></script>

    <?= view($content[0], $content[1]) ?>

    <script src="<?= base_url("assets/frames/plugins/bs-stepper/js/bs-stepper.min.js") ?>"></script>
    <script src="<?= base_url("/assets/frames/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url("/assets/frames/dist/js/adminlte.js") ?>"></script>
    <script src="<?= base_url("/assets/customize/js/censo.js") ?>"></script>
    
    <script src="<?= base_url('/assets/frames/plugins/dropzone/min/dropzone.min.js') ?>"></script>

</body>

</html>