<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SimenaraOKU</title>
  <link rel="icon" href="<?= temp('images/icons/LOGO OGAN KOMERING ULU.png') ?>" type="image/png">

  <link rel="stylesheet" href="<?= template('safario/vendors/bootstrap/bootstrap.min.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/fontawesome/css/all.min.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/themify-icons/themify-icons.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/linericon/style.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/owl-carousel/owl.theme.default.min.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/owl-carousel/owl.carousel.min.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/flat-icon/font/flaticon.css', 'website') ?>">
  <link rel="stylesheet" href="<?= template('safario/vendors/nice-select/nice-select.css', 'website') ?>">

  <!-- Leaflet -->
  <link rel="stylesheet" href="<?= leaflet('leaflet.css') ?>" rel="stylesheet">
  <script type="text/javascript" src="<?= leaflet('leaflet.js') ?>"></script>
  <script type="text/javascript" src="<?= leaflet('leaflet.ajax.js') ?>"></script>
  <!-- Bahan Leaflet Map -->

  <link rel="stylesheet" href="<?= template('safario/css/style.css', 'website') ?>">

  <style type="text/css">
    .button {
      background: #007bff
    }

    .hero-banner h1,
    .header_area .navbar .nav .nav-item:hover .nav-link,
    .header_area .navbar .nav .nav-item.active .nav-link {
      color: #007bff
    }

    .magic-ball::before {
      border: 15px solid #007bff55;
    }

    .magic-ball::after {
      background: #007bff55
    }

    .header_area.navbar_fixed .main_menu .navbar {
      background: #80dbff
    }

    .button:hover {
      background-color: #005bcf;
    }

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