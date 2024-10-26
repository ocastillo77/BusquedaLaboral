<?php
$config = $data['config'];
$urlfav = !empty($config['Favicon']) ? URL_GAL . 'config/images/IM_' . $config['Favicon'] : URL_IMG . 'favicon.png';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <!-- META -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
  include 'meta-share.php';
  ?>
  <!-- MOBILE SPECIFIC -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- FAVICONS ICON -->
  <link rel="icon" type="image/png" href="<?php echo $urlfav; ?>">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlfav; ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>font-awesome.min.css"><!-- FONTAWESOME STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>feather.css"><!-- FEATHER ICON SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>owl.carousel.min.css"><!-- OWL CAROUSEL STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>magnific-popup.min.css"><!-- MAGNIFIC POPUP STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>lc_lightbox.css"><!-- Lc light box popup -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>bootstrap-select.min.css"><!-- BOOTSTRAP SLECT BOX STYLE SHEET  -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>dataTables.bootstrap5.min.css"><!-- DATA table STYLE SHEET  -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>select.bootstrap5.min.css"><!-- DASHBOARD select bootstrap  STYLE SHEET  -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>dropzone.css"><!-- DROPZONE STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>scrollbar.css"><!-- CUSTOM SCROLL BAR STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>datepicker.css"><!-- DATEPICKER STYLE SHEET -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>flaticon.css"> <!-- Flaticon -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>swiper-bundle.min.css"><!-- Swiper Slider -->
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>style.css?v=<?php echo rand(); ?>"><!-- MAIN STYLE SHEET -->
  <!-- THEME COLOR CHANGE STYLE SHEET -->
  <link rel="stylesheet" class="skin" type="text/css" href="<?php echo URL_CSS; ?>skins-type/skin-9.css">
  <link href="<?php echo URL_CSS; ?>custom.css?v=<?php echo rand(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-7S401K4CW7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7S401K4CW7');
  </script>
  <!-- LOADING AREA START ===== >
  <div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
      <div class="wrapper">
        <div class="cssload-loader"></div>
      </div>
    </div>
  </div>
  <!-- LOADING AREA  END ====== -->
  <div class="page-wraper">
    <!-- HEADER START -->
    <header class="site-header header-style-3 mobile-sider-drawer-menu">
      <div id="top-bar" class="bg-fucsia">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-xs-12">
              <div class="top-bar-info">
                <ul class="top-info">
                  <!--li><i class="fa fa-phone"></i> +54 9 2612696432</li-->
                  <li class="d-none d-sm-inline-block"><i class="fa fa-envelope"></i> info@encuentratupuesto.com</li>
                </ul>
              </div>
            </div>
            <div class="box-account col-xs-12 col-md-3">
              <?php if (!Session::get('wb_active') && !Session::get('em_active')) : ?>
                <a class="btn btn-custom btn-custom-sm" href="<?php echo URL_WEB . 'login'; ?>">
                  <i class="feather-log-in"></i> Iniciar Sesión
                </a>
                <a class="btn btn-custom btn-custom-sm" href="<?php echo URL_WEB . 'register'; ?>">
                  <i class="feather-user"></i> Registrarse
                </a>
              <?php
              else :
                $urlAccount = Session::get('wb_active') ? 'account' : 'accountCompany';
                $urlLogout = Session::get('wb_active') ? 'logout' : 'logoutCompany';
              ?>
                <a class="btn btn-custom btn-custom-sm" href="<?php echo URL_WEB . $urlLogout; ?>">
                  <i class="feather-log-in"></i> Salir
                </a>
                <a class="btn btn-custom btn-custom-sm" href="<?php echo URL_WEB . $urlAccount; ?>">
                  <i class="feather-user"></i> Mi Cuenta
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="main-bar-wraper  navbar-expand-lg">
        <div class="main-bar">
          <div class="container clearfix">
            <div class="logo-header">
              <?php
              $nombre_sitio = $config['Nombre'];
              $url_logo = !empty($config['Imagen']) ? URL_GAL . 'config/images/IM_' . $config['Imagen'] : URL_IMG . 'logo.png';
              ?>
              <div class="logo-header-inner logo-header-one">
                <a href="<?php echo URL_WEB; ?>">
                  <img src="<?php echo $url_logo; ?>" alt="">
                </a>
              </div>
            </div>
            <!-- NAV Toggle Button -->
            <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar icon-bar-first"></span>
              <span class="icon-bar icon-bar-two"></span>
              <span class="icon-bar icon-bar-three"></span>
            </button>
            <!-- MAIN Vav -->
            <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-center">
              <?php echo $menu_top; ?>
            </div>
          </div>
        </div>
        <!-- SITE Search -->
        <div id="search">
          <span class="close"></span>
          <form role="search" id="searchform" action="" method="get" class="radius-xl">
            <input class="form-control" value="" name="q" type="search" placeholder="Buscar" />
            <span class="input-group-append">
              <button type="button" class="search-btn">
                <i class="fa fa-paper-plane"></i>
              </button>
            </span>
          </form>
        </div>
      </div>
    </header>
    <!-- HEADER END -->