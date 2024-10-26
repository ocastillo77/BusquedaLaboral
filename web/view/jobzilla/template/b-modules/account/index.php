<!-- OUR BLOG START -->
<?php
$user = $data['user'];
$foto = !empty($user['Imagen']) ? URL_GAL . 'usuarios/thumbs/TH_' . $user['Imagen'] : URL_IMG . 'user-avtar/avatar_v1.png';
$profesion = !empty($user['Profesion']) ? $user['Profesion'] : '';
?>
<div class="section-full p-t145 p-b90 site-bg-white">
  <div class="container-fluid">
    <div class="row">
      <?php if ($data['file']) : ?>
        <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">
          <?php include 'mod-aside.php'; ?>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
          <?php
          include 'mod-' . $data['file'] . '.php';
          ?>
        </div>
      <?php else : ?>
        <div class="col-md-12 m-b30">
          <?php
          include 'mod-' . $data['file'] . '.php';
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<!-- OUR BLOG END -->