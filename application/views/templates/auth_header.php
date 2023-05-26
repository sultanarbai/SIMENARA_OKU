<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= template('gambarforsite/logoDiskominfo.png') ?>">

    <title>
        <?= $title; ?>
    </title>

    <!-- Custom fonts for this template-->
    <link href="<?= template('safario/vendors/fontawesome/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('asset/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $time = date("H") ?>
<?php if ($time >= 18 or $time <= 6) { ?>

    <body style="background-image: url('<?= templatefile('nightmode.jpg') ?>'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;">
    <?php } else { ?>

        <body style="background-image: url('<?= templatefile('daymode.jpg') ?>'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;">
        <?php } ?>