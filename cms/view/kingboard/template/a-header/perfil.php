<div class="btn-group">
  <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
    <img src="<?php echo CMS_IMG; ?>avatar_v1.png" width="24" />
    <span class="name"><?php echo Session::get('name'); ?></span>
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" role="menu">
    <li>
      <a href="<?php echo URL_WEB; ?>" target="_blank">
        <i class="fa fa-globe"></i>
        <span class="text">Ir a Sitio Web</span>
      </a>
    </li>
    <li>
      <a href="<?php echo URL_CMS . 'sys_users/perfil'; ?>">
        <i class="fa fa-user"></i>
        <span class="text">Mi Perfil</span>
      </a>
    </li>
    <li>
      <a href="<?php echo URL_CMS . 'login/close'; ?>">
        <i class="fa fa-power-off"></i>
        <span class="text">Cerrar Sesi&oacute;n</span>
      </a>
    </li>
  </ul>
</div>