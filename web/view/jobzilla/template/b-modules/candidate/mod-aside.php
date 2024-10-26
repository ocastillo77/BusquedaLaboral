<?php
$menu_left[] = [
  'url' => 'profile',
  'icon' => 'fa fa-user',
  'name' => 'Perfil'
];
$menu_left[] = [
  'url' => 'tests',
  'icon' => 'fa fa-receipt',
  'name' => 'Tests'
];
?>
<div class="side-bar-st-1">
  <div class="twm-candidate-profile-pic">
    <img src="<?php echo $foto; ?>" alt="<?php echo $user['Nombre']; ?>">
  </div>
  <div class="twm-mid-content text-center">
    <a href="candidate-detail.html" class="twm-job-title">
      <h4><?php echo $user['Nombre']; ?></h4>
    </a>
    <p><?php echo $profesion; ?></p>
  </div>
  <div class="twm-nav-list-1">
    <ul>
      <?php
      foreach ($menu_left as $item) :
        $active = $item['url'] == $data['file'] ? 'active' : '';
        $url = URL_WEB . 'candidate/' . $user['ID'] . '/' . $item['url'];
      ?>
        <li class="<?php echo $active; ?>">
          <a href="<?php echo $url; ?>"><i class="<?php echo $item['icon']; ?>"></i> <?php echo $item['name']; ?></a>
        </li>
      <?php
      endforeach;
      ?>
    </ul>
  </div>
</div>