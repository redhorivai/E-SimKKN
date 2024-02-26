<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="refresh" content="1800">
    <meta name="description" content="Panel Admin">
    <meta name="author" content="@binarykid">
    <title>Panel Admin</title>
    <link href="<?= base_url(); ?>/assets-admin/panel/images/logo/Logo-UMPalembang-2019-Mini.ico" rel="shortcut icon">

    <!-- FAVICON -->
    <link href="javascript:void(0)" rel="shortcut icon">
    <!-- ICONS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/fonts/line_icon/css/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/lib/ionicons/css/ionicons.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- SELECT2 & DATATABLES -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.min.css" />
    <!-- BOOTSTRAP FILE-INPUT -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap-fileinput/bootstrap-fileinput.css">
    <!-- FLATPICKR -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/lib/flatpickr/flatpickr.min.css">
    <!-- STYLE -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/css/bracket.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/css/bracket_white.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-admin/panel/css/sidebar-menu.css">
    <!-- JS -->
    <script src="<?= base_url(); ?>/assets-admin/panel/lib/jquery/jquery.js"></script>
</head>
<body>
    <!-- SIDEBAR MENU -->
    <?= $this->include('admin/layout/menu') ?>
    <!-- HEADER -->
    <?= $this->include('admin/layout/header') ?>
    <!-- CONTENT -->
    <?= $this->renderSection('content') ?>
    <!-- FOOTER -->
    <?= $this->include('admin/layout/footer') ?>
    <!-- LIBRARIES JS -->
    <?= $this->include('admin/layout/js') ?>
</body>
</html>