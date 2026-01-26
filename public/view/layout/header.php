<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= WEB_DESCRIPTION ?>">
    <meta name="keywords" content="<?= WEB_KEYWORD ?>">
    <title><?= $title ? WEB_NAME . ' | ' . $title : '' ?></title>
    <link rel="icon" href="<?= WEB_FAVICON ?>" type="image/png">
    <!-- CDN Bootstrap Icon-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <!-- CDN Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <!-- CDN Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CDN AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- CDN Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- CDN XLSX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <!-- Font Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- CSS Custom -->
    <link rel="stylesheet" href="<?= URL_P_V ?>css/main.css?v=1.0.1">
    <link rel="stylesheet" href="<?= URL_P_V ?>css/header.css?v=1.0.0">
    <link rel="stylesheet" href="<?= URL_P_V ?>css/footer.css">
</head>

<?= toast_show() ?>

<body class="">

    <div class="linear-bg"></div>

    <div style="top:25vh" class="position-absolute start-50 translate-middle title-gold col-12 text-center">
        <?= $title ?>
    </div>

    <div class="d-flex flex-wrap justify-content-end p-3 gap-2 mb-5  animate__animated animate__fadeIn">
        <a <?= !($page == 'home') ?: 'hidden' ?> href="/" class="btn btn-sm btn-danger text-warning border-warning shadow"> <i class="bi bi-gift"></i> <span class="d-none d-lg-block">Danh sách giải thưởng</span></a>
        <a <?= !($page == 'list-guest') ?: 'hidden' ?> href="/list-guest" class="btn btn-sm btn-danger text-warning border-warning shadow"> <i class="bi bi-person"></i> <span class="d-none d-lg-block">Danh sách tham dự</span></a>
    </div>