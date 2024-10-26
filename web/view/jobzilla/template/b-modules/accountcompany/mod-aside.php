<?php
$menu_left[] = [
  'url' => 'home',
  'icon' => 'fa fa-tachometer-alt',
  'name' => 'Escritorio'
];
$menu_left[] = [
  'url' => 'profile',
  'icon' => 'fa fa-user',
  'name' => 'Mi Perfil'
];
$menu_left[] = [
  'url' => 'jobs',
  'icon' => 'fa fa-suitcase',
  'name' => 'Mis Búsquedas'
];
$menu_left[] = [
  'url' => 'candidates',
  'icon' => 'fa fa-receipt',
  'name' => 'Candidatos'
];
$menu_left[] = [
  'url' => 'subscription',
  'icon' => 'fa fa-credit-card',
  'name' => ' Mi Subscripción'
];
?>
<div class="side-bar-st-1">
  <div class="twm-candidate-profile-pic">
    <img src="<?php echo $foto; ?>" alt="<?php echo $user['Nombre']; ?>">
    <div class="upload-btn-wrapper">
      <a href="<?php echo URL_WEB . 'accountCompany/profile'; ?>" class="site-button site-button-bordered button-sm mb-5px">Cambiar Foto</a>
    </div>
  </div>
  <div class="twm-mid-content text-center">
    <a href="candidate-detail.html" class="twm-job-title">
      <h4><?php echo $user['Nombre']; ?></h4>
    </a>
  </div>
  <div class="twm-nav-list-1">
    <ul>
      <?php
      foreach ($menu_left as $item) :
        $active = $item['url'] == $data['file'] ? 'active' : '';
        $url = URL_WEB . 'accountCompany/' . $item['url'];
      ?>
        <li class="<?php echo $active; ?>">
          <a href="<?php echo $url; ?>"><i class="<?php echo $item['icon']; ?>"></i> <?php echo $item['name']; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>