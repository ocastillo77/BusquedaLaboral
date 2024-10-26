<?php
$tabla = 'usuarios';
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : '';
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$item = !empty($data['user']) ? $data['user'] : [];
$urlUpload = URL_WEB . 'upload';
$urlCrop = URL_WEB . 'crop';
$urlSave = URL_WEB . 'saveProfile';
$user = $data['user'];

$grupos = [
  1 => 'Solo',
  2 => 'En pareja',
  3 => 'Con Hijos',
];
$dispos = [
  1 => 'Part time',
  2 => 'Full time',
  3 => 'Franja Horaria',
];
$niveles = [
  1 => 'Primario Incompleto',
  2 => 'Primario Completo',
  3 => 'Secundario Incompleto',
  4 => 'Secundario Completo',
  5 => 'Universitario Incompleto',
  6 => 'Universitario Completo',
  7 => 'Posgrado',
  8 => 'Master',
  9 => 'Tecnicaturas',
];
$informatico = [
  1 => 'Bajo',
  2 => 'Medio',
  3 => 'Alto',
];
$niveldes = [
  1 => '- SI -',
  2 => '- NO -'
];
$textos = [
  1 => '¿Cuáles?',
  2 => '¿A qué se debe?'
];
$sexo = [
  1 => 'Masculino',
  2 => 'Femenino'
];

$descripcion = !empty($item['IsNivelDes']) && !empty($textos[$item['IsNivelDes']]) ? $textos[$item['IsNivelDes']] : '¿Cuáles?';
$css1 = !empty($item['GrupoFamiliar']) && $item['GrupoFamiliar'] == 3 ? '' : 'd-none';
$css2 = !empty($item['Disponibilidad']) && $item['Disponibilidad'] == 3 ? '' : 'd-none';
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
                      <!--a id="del-imagen" onclick="deleteImage('imagen')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a-->
                      <div id="ldr-imagen" class="loader">
                        <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="help-block">
                      <strong>Importante:</strong>
                      <ul>
                        <li>La foto debe ser en fondo blanco y con la iluminación adecuada.</li>
                        <li>Una vez subida la imagen no será visible en nuestra plataforma hasta que nuestro equipo pueda validarla.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nombre y Apellido:</label>
                  <input id="nombre" name="<?php echo $tabla; ?>[Nombre]" class="form-control" type="text" value="<?php echo !empty($item['Nombre']) ? $item['Nombre'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">DNI:</label>
                  <input id="dni" name="<?php echo $tabla; ?>[DNI]" class="form-control" type="text" value="<?php echo !empty($item['DNI']) ? $item['DNI'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Correo Electrónico:</label>
                  <input id="email" name="<?php echo $tabla; ?>[Email]" class="form-control" type="email" value="<?php echo !empty($item['Email']) ? $item['Email'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Teléfono:</label>
                  <input id="celular" name="<?php echo $tabla; ?>[Celular]" class="form-control" type="text" value="<?php echo !empty($item['Celular']) ? $item['Celular'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Contraseña:</label>
                  <div class="password-container">
                    <input type="password" class="form-control password" id="contrasenia" name="<?php echo $tabla; ?>[Contrasenia]" value="<?php echo !empty($item['Contrasenia']) ? $item['Contrasenia'] : ''; ?>" required>
                    <button class="toggle-password" type="button" data-target=".password"><i class="fa fa-eye"></i></button>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Sexo:</label>
                  <select id="sexo" name="<?php echo $tabla; ?>[Sexo]" class="form-select">
                    <?php
                    foreach ($sexo as $key => $value) :
                      $selected = $item['Sexo'] == $key ? 'selected="selected"' : '';
                    ?>
                      <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Fecha de Nacimiento:</label>
                  <input type="text" class="form-control datepicker" id="fechaNac" name="<?php echo $tabla; ?>[FechaNac]" value="<?php echo !empty($item['FechaNac']) ? $item['FechaNac'] : ''; ?>" autocomplete="off" placeholder="<?php echo date('d/m/Y'); ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Edad:</label>
                  <input type="number" class="form-control" id="edad" name="<?php echo $tabla; ?>[Edad]" value="<?php echo !empty($item['Edad']) ? $item['Edad'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Dirección:</label>
                  <input type="text" class="form-control" id="domicilio" name="<?php echo $tabla; ?>[Direccion]" value="<?php echo !empty($item['Direccion']) ? $item['Direccion'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Provincia:</label>
                  <select id="provincia" name="<?php echo $tabla; ?>[ProvinciaID]" class="form-select">
                    <?php
                    if (!empty($data['provincias'])) :
                      foreach ($data['provincias'] as $value) :
                        $selected = $item['ProvinciaID'] == $value['ID'] ? 'selected="selected"' : '';
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
                  <input type="text" class="form-control" id="localidad" name="<?php echo $tabla; ?>[Localidad]" value="<?php echo !empty($item['Localidad']) ? $item['Localidad'] : ''; ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Certificado de Buena Conducta:</label>
                  <div class="controls">
                    <div class="content-image">
                      <div class="border-overflow">
                        <?php
                        $thumb = !empty($user['Archivo']) ? URL_GAL . $tabla . '/thumbs/TH_' . $user['Archivo'] : CMS_IMG . 'no-foto-150x100.jpg';
                        $archivo = !empty($user['Archivo']) ? URL_GAL . $tabla . '/images/IM_' . $user['Archivo'] : '#';
                        $link = !empty($user['Archivo']) ? URL_GAL . $tabla . '/files/' . $user['Archivo'] : '';
                        ?>
                        <input type="hidden" name="<?php echo $tabla; ?>[Archivo]" id="archivo">
                        <?php if (!empty($link)) : ?>
                          <a id="gal-archivo" href="<?php echo $link; ?>" target="_blank">
                            <img src="<?php echo $thumb; ?>" id="img-archivo" />
                          </a>
                        <?php else : ?>
                          <a id="gal-archivo" href="javascript:;" target="_blank">
                            <img src="<?php echo $thumb; ?>" id="img-archivo" />
                          </a>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="buttons-up">
                      <a id="btn-archivo" class="btn btn-primary">Cambiar Documento</a>
                      <a id="del-archivo" onclick="deleteFile('archivo')" class="btn btn-danger">Eliminar</a>
                      <div id="ldr-archivo" class="loader">
                        <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando archivo...</span>
                      </div>
                    </div>
                  </div>
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