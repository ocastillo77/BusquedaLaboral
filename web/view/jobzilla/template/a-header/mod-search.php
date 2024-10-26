<?php
$urlSearch = URL_WEB . 'busqueda/';
?>
<div class="collapse navbar-white" id="header-search-form">
  <div class="container">
    <form id="form-search" method="get" action="<?php echo $urlSearch; ?>" class="navbar-form animated fadeInDown">
      <input type="search" id="key" name="key" class="form-control"
             placeholder="Ingrese el texto a buscar..." value="">
      <input type="hidden" name="fil" value="<?php echo isset($data['fil']) ? $data['fil'] : ''; ?>" />
      <button type="submit" title="Search"><i class="fa fa-search"></i></button>
    </form>
  </div><!-- End .container -->
</div><!-- End #header-search-form -->