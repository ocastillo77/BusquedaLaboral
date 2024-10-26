<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : $data['title'];
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'facebook';
?>  
<div class="inner-page">
  <div class="logo">
    <h2>
      <a href="<?php echo URL_CMS; ?>">
        <i class="fa fa-external-link-square"></i> WebAdmin 3.0
      </a>
    </h2>
  </div>
  <div class="login-box center-block">
    <div class="alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
    <form id="login" method="post">
      <input type="hidden" id="login" name="login" value="1" />
      <div class="input-group">
        <input id="username" name="username" type="text" placeholder="nombre de usuario" class="form-control" value="<?php if (isset($data['login'])) echo $data['login']['username']; ?>">
        <span class="input-group-addon"><i class="fa fa-user"></i>
        </span>
      </div>
      <div class="input-group">
        <input id="password" name="password" type="password" placeholder="contrase&ntilde;a" class="form-control">
        <span class="input-group-addon"><i class="fa fa-lock"></i>
        </span>
      </div>
      <div class="simple-checkbox">
        <input type="checkbox" id="nologout" name="nologout" value="1">
        <label for="nologout">Permanecer conectado</label>
      </div>
      <button class="btn btn-primary btn-lg btn-block btn-login"><i class="fa fa-arrow-circle-o-right"></i> Ingresar</button>
    </form>
  </div>
</div>
