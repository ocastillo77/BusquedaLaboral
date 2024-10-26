<?php
$user = $data['candidato'];
$foto = !empty($user['Imagen']) ? URL_GAL . 'usuarios/thumbs/TH_' . $user['Imagen'] : URL_IMG . 'user-avtar/avatar_v1.png';
$profesion = !empty($user['Profesion']) ? $user['Profesion'] : '';
?>
<div class="section-full p-t120  p-b90 site-bg-white">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">
        <?php include 'mod-aside.php'; ?>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <?php
        include 'mod-' . $data['file'] . '.php';
        ?>
      </div>
    </div>
  </div>
</div>
<!-- OUR BLOG END -->