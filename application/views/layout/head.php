<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= template('gambarforsite/logoDiskominfo.png') ?>">
  <!-- Leaflet -->
  <link rel="stylesheet" href="<?= leaflet('leaflet.css') ?>" rel="stylesheet">
  <script type="text/javascript" src="<?= leaflet('leaflet.js') ?>"></script>
  <script type="text/javascript" src="<?= leaflet('leaflet.ajax.js') ?>"></script>


  <title><?= $title; ?></title>

  <!-- Bootstrap -->
  <link href="<?= template('vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
  <!-- grapik -->
  <link href="<?= template('vendors/tambah/all.min.css') ?>" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?= template('vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?= template('vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="<?= template('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet">


  <!-- Custom Theme Style -->
  <link href="<?= template('build/css/custom.min.css') ?>" rel="stylesheet">

  <!-- iCheck -->
  <link href="<?= template('vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">

  <!-- Datatables -->

  <link href="<?= template('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= template('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= template('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= template('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= template('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') ?>" rel="stylesheet">

  <!-- Bahan Leaflet Map -->

  <!-- bootstrap-daterangepicker -->
  <link href="<?= template('vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">

  <style type="text/css">
    .leaflet-tooltip.no-background {
      background: transparent;
      border: 0;
      box-shadow: none;
      color: #fff;
      font-weight: bold;
      text-shadow: 1px 1px 1px #000, -1px 1px 1px #000, 1px -1px 1px #000, -1px -1px 1px #000;
    }
  </style>


</head>