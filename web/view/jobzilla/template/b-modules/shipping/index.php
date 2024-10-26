<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : '';
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$post = isset($data['info']) ? $data['info'] : [];
$rUser = isset($data['user']) ? $data['user'] : false;
$rError = isset($data['errors']) ? $data['errors'] : false;
?> 
<div id="content" role="main">
  <div class="page-header dark larger larger-desc m40">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Proceso de Pago</h1>
        </div><!-- End .col-md-6 -->
      </div><!-- End .row -->
    </div><!-- End .container -->
  </div><!-- End .page-header -->

  <?php include 'step3.php'; ?>

  <div class="mb25"></div><!-- space -->

</div><!-- End #content -->