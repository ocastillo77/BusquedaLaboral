<div class="navbar-inner sticky-menu">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 boxed-container">
        <div class="collapse navbar-collapse collapse-row" id="main-navbar-container">
          <div class="row">
            <div class="container text-center">
              <a class="logo-sticky pull-left" href="<?php echo URL_WEB; ?>" title="<?php echo $nombre_sitio; ?>">
                <img src="<?php echo $url_logo; ?>" alt="<?php echo $nombre_sitio; ?>" height="45" />
              </a>
              <?php echo $menu_top; ?>         
              <div class="shopping-cart dropdown cart-dropdown pull-right">
                <?php include 'mod-basket.php'; ?>
              </div><!-- End .cart-dropdown -->
            </div><!-- End container -->
          </div><!-- End row -->
        </div><!-- /.navbar-collapse -->
      </div><!-- End .col-sm-12 -->
    </div><!-- End .row -->
  </div><!-- End .container -->
</div><!-- End .navbar-inner -->