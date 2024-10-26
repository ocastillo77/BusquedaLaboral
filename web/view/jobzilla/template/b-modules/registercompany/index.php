<?php
$tabla = $data['tabla'];
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : $data['title'];
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$infoE = isset($data['info']) ? $data['info'] : [];
$urlRegisterUser = URL_WEB . 'register';
$urlRegisterCompany = URL_WEB . 'registerCompany';
$urlform = URL_WEB . 'registerCompanySubmit';
?>
<!-- Employer Account START -->
<div class="section-full p-t145  p-b90 site-bg-white bg-cover twm-ac-fresher-wrap">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-8 col-md-12">
        <div class="twm-right-section-panel-wrap2">
          <!--Filter Short By-->
          <div class="twm-right-section-panel site-bg-primary">
            <!--Basic Information-->
            <div class="panel panel-default">
              <div class="panel-heading wt-panel-heading p-a20 p-t30">
                <h3 class="panel-tittle m-b30 text-center">Registro de Empresas</h3>
                <div id="alert-form" class="g-mt-15 text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
              </div>
              <div class="panel-body wt-panel-body p-a20 ">
                <div class="twm-tabs-style-2">
                  <ul class="nav nav-tabs" id="myTab3" role="tablist">
                    <li class="nav-item">
                      <a href="<?php echo $urlRegisterUser; ?>" class="nav-link"><i class="fas fa-user-tie"></i> Candidatos</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo $urlRegisterCompany; ?>" class="nav-link active"><i class="fas fa-building"></i> Empresas</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTab3Content">
                    <div class="tab-pane fade show active" id="Employment">
                      <form id="form-registerE" class="form-ajax" method="post" action="<?php echo $urlform; ?>">
                        <input type="hidden" id="registerCompany" name="registerCompany" value="1" />
                        <div class="row">
                          <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                              <label>CUIT</label>
                              <div class="ls-inputicon-box">
                                <input class="form-control" id="cuit" name="<?php echo $tabla; ?>[CUIT]" type="text" placeholder="CUIT" value="<?php echo !empty($infoE['CUIT']) ? $infoE['CUIT'] : ''; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                              <label>Razón Social</label>
                              <div class="ls-inputicon-box">
                                <input class="form-control" id="nombreE" name="<?php echo $tabla; ?>[Nombre]" type="text" placeholder="Razón Social" value="<?php echo !empty($infoE['Nombre']) ? $infoE['Nombre'] : ''; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                              <label>Correo Electrónico</label>
                              <div class="ls-inputicon-box">
                                <input class="form-control" id="emailE" name="<?php echo $tabla; ?>[Email]" type="email" placeholder="Devid@example.com" value="<?php echo !empty($infoE['Email']) ? $infoE['Email'] : ''; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                              <label>Teléfono</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">+54</span>
                                <input class="form-control" id="telefonoE" name="<?php echo $tabla; ?>[Telefono]" type="text" placeholder="(999) 999-9999" value="<?php echo !empty($infoE['Telefono']) ? $infoE['Telefono'] : ''; ?>">
                              </div>
                              <label class="label-block">Ingresa tu número de celular sin cero y sin 15</label>
                            </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                              <label>Contraseña</label>
                              <div class="ls-inputicon-box">
                                <div class="password-container">
                                  <input type="password" class="form-control passwordE" id="contraseniaE" name="<?php echo $tabla; ?>[Contrasenia]" placeholder="Contraseña" autocomplete="off">
                                  <button class="toggle-password" type="button" data-target=".passwordE"><i class="fa fa-eye"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                              <label>Repetir Contraseña</label>
                              <div class="ls-inputicon-box">
                                <div class="password-container">
                                  <input type="password" class="form-control passwordE2" id="contraseniaE2" name="contraseniaE2" placeholder="Repetir Contraseña" autocomplete="off">
                                  <button class="toggle-password" type="button" data-target=".passwordE2"><i class="fa fa-eye"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-12 col-lg-12">
                            <div class="form-group">
                              <input class="form-check-input" type="checkbox" name="policyE" id="policyE" checked>
                              <label class="form-check-label" for="policyE">
                                He leído y acepto la <a href="<?php echo URL_WEB . 'seccion/politica-de-privacidad' ?>" target="_blank">Política de Privacidad</a> y los
                                <a href="<?php echo URL_WEB . 'seccion/terminos-y-condiciones-de-uso' ?>" target="_blank">Términos y Condiciones de Uso</a>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="d-inline-block box-captcha">
                              <img id="captcha-img" class="captcha-img" src="<?php echo $data['captcha']; ?>">
                            </div>
                            <div class="d-inline-block w64p">
                              <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Copie el Código" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="text-right">
                              <button type="submit" class="btn-submit w100p">Registrarse</button>
                            </div>
                          </div>
                          <div class="col-xl-12 col-lg-12 col-md-12 m-t30 m-b20">
                            <div class="text-center">¿Tenés una cuenta? Inicia sesión <a href="<?php echo URL_WEB . 'loginCompany'; ?>" class="text-uppercase">aquí</a></div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Employer Account START END -->