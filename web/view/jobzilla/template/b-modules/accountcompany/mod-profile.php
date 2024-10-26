<?php
$tabla = 'empresas';
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : '';
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$user = !empty($data['user']) ? $data['user'] : [];
$urlUpload = URL_WEB . 'uploadCompany';
$urlCrop = URL_WEB . 'cropCompany';
$urlSave = URL_WEB . 'saveProfileCompany';
?>
<div class="twm-right-section-panel site-bg-gray">
  <div class="twm-pro-view-chart-wrap">
    <div class="row">
      <div class="col-lg-12 col-md-12 mb-4">
        <div class="panel panel-default">
          <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">Mi Perfil</h4>
            <?php if (!empty($mensaje)) : ?>
              <div class="text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
            <?php endif; ?>
          </div>
          <div class="panel-body wt-panel-body bg-white">
            <div id="message" class="text-center"></div>
            <div class="twm-dashboard-candidates-wrap">
              <form id="form-user" method="post" action="<?php echo $urlSave; ?>">
                <input type="hidden" id="update" name="update" value="1" />
                <div class="form-group">
                  <label class="control-label mb-3">Foto:</label>
                  <div class="controls box-lm">
                    <div class="content-image">
                      <div class="border-overflow">
                        <?php
                        $thumb = !empty($user['Imagen']) ? URL_GAL . $tabla . '/thumbs/TH_' . $user['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
                        $imagen = !empty($user['Imagen']) ? URL_GAL . $tabla . '/images/IM_' . $user['Imagen'] : '#';
                        $class = !empty($user['Imagen']) ? 'fancybox' : '';
                        ?>
                        <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php !empty($user['Imagen']) ? $user['Imagen'] : ''; ?>">
                        <a id="gal-imagen" href="#" class="<?php echo $class; ?>">
                          <img src="<?php echo $thumb; ?>" id="img-imagen" height="200">
                        </a>
                      </div>
                    </div>
                    <div class="buttons-up">
                      <a id="btn-imagen" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar Foto</a>
                      <div id="ldr-imagen" class="loader">
                        <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="help-block">
                      <strong>Importante:</strong>
                      <ul>
                        <li>Por favor suba la imagen de su logo en fondo blanco.</li>
                        <li>Una vez subida la imagen no será visible en nuestra plataforma hasta que nuestro equipo pueda validarla.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Razón Social:</label>
                  <input id="nombre" name="<?php echo $tabla; ?>[Nombre]" class="form-control" type="text" value="<?php echo !empty($user['Nombre']) ? $user['Nombre'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">CUIT:</label>
                  <input id="cuit" name="<?php echo $tabla; ?>[CUIT]" class="form-control" type="text" value="<?php echo !empty($user['CUIT']) ? $user['CUIT'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Correo Electrónico:</label>
                  <input id="email" name="<?php echo $tabla; ?>[Email]" class="form-control" type="email" value="<?php echo !empty($user['Email']) ? $user['Email'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Teléfono:</label>
                  <input id="telefono" name="<?php echo $tabla; ?>[Telefono]" class="form-control" type="text" value="<?php echo !empty($user['Telefono']) ? $user['Telefono'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Contraseña:</label>
                  <div class="password-container">
                    <input type="password" class="form-control password" id="contrasenia" name="<?php echo $tabla; ?>[Contrasenia]" value="<?php echo !empty($user['Contrasenia']) ? $user['Contrasenia'] : ''; ?>" required>
                    <button class="toggle-password" type="button" data-target=".password"><i class="fa fa-eye"></i></button>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Dirección:</label>
                  <input type="text" class="form-control" id="domicilio" name="<?php echo $tabla; ?>[Direccion]" value="<?php echo !empty($user['Direccion']) ? $user['Direccion'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Provincia:</label>
                  <select id="provincia" name="<?php echo $tabla; ?>[ProvinciaID]" class="form-select">
                    <?php
                    if (!empty($data['provincias'])) :
                      foreach ($data['provincias'] as $value) :
                        $selected = $user['ProvinciaID'] == $value['ID'] ? 'selected="selected"' : '';
                    ?>
                        <option value="<?php echo $value['ID']; ?>" <?php echo $selected; ?>><?php echo $value['Nombre']; ?></option>
                    <?php
                      endforeach;
                    endif;
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Localidad / Departamento:</label>
                  <input type="text" class="form-control" id="localidad" name="<?php echo $tabla; ?>[Localidad]" value="<?php echo !empty($user['Localidad']) ? $user['Localidad'] : ''; ?>" required>
                </div>
                <div class="mb-4 text-right">
                  <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="urlUpload" value="<?php echo $urlUpload; ?>" />
<input type="hidden" id="urlCrop" value="<?php echo $urlCrop; ?>" />