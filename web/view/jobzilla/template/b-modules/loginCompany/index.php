<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : $data['title'];
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$item = isset($data['info']) ? $data['info'] : [];
$urlLoginCompany = URL_WEB . 'loginCompany';
?>
<!-- OUR BLOG START -->
<!-- Login Section Start -->
<div class="section-full site-bg-white p-t80">

  <div class="container-fluid bg-image" style="background-image: url('<?php echo URL_IMG; ?>slide01.jpg');">
    <div class="row">
      <div class="col-xl-8 col-lg-6 col-md-5">
      </div>
      <div class="col-xl-4 col-lg-6 col-md-7">
        <div class="twm-log-reg-form-wrap">
          <div class="twm-log-reg-inner">
            <div class="twm-log-reg-head">
              <div class="twm-log-reg-logo">
                <span class="log-reg-form-title">Iniciar Sesión</span>
                <div class="g-mt-15 text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
              </div>
            </div>
            <div class="twm-tabs-style-2">
              <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <!--Login Candidate-->
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#twm-login-candidate" type="button"><i class="fas fa-user-tie"></i>Candidatos</button>
                </li>
                <!--Login Employer-->
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#twm-login-Employer" type="button"><i class="fas fa-building"></i>Empresas</button>
                </li>
              </ul>
              <div class="tab-content" id="myTab2Content">
                <!--Login Candidate Content-->
                <div class="tab-pane fade" id="twm-login-candidate">
                  <form id="form-login" method="post">
                    <input type="hidden" id="login" name="login" value="1" />
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group mb-3">
                          <input id="wb_username" name="wb_username" type="text" class="form-control" placeholder="Correo Electrónico" value="<?php echo isset($item['wb_username']) ? $item['wb_username'] : ''; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group mb-3">
                          <input id="wb_password" name="wb_password" type="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="twm-forgot-wrap">
                          <div class="form-group mb-3 p-relative">
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="wb_remember" name="wb_remember" value="1">
                              <label class="form-check-label rem-forgot" for="wb_remember">
                                Mantenerme Conectado
                              </label>
                              <a href="<?php echo URL_WEB . 'recover'; ?>" class="site-text-primary p-forgot">Recuperar contraseña</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <button type="button" onclick="$('#form-login').submit();" class="site-button-1">Iniciar Sesión</button>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <p>¿No tenés cuenta? Registrate <a href="<?php echo URL_WEB . 'register'; ?>" class="text-uppercase">aquí</a></p>
                        </div>
                      </div>
                      <!--div class="col-md-12">
                        <div class="form-group">
                          <span class="center-text-or">O</span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <button type="submit" class="log_with_google">
                            <img src="<?php echo URL_IMG; ?>google-icon.png" alt=""> Iniciar Sesión con Google
                          </button>
                        </div>
                      </div-->
                    </div>
                  </form>
                </div>
                <!--Login Employer Content-->
                <div class="tab-pane fade show active" id="twm-login-Employer">
                  <form id="form-loginE" method="post" action="<?php echo $urlLoginCompany; ?>">
                    <input type="hidden" id="loginCompany" name="loginCompany" value="1" />
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group mb-3">
                          <input id="em_username" name="em_username" type="text" class="form-control" placeholder="Correo Electrónico" value="<?php echo isset($item['em_username']) ? $item['em_username'] : ''; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group mb-3">
                          <input id="em_password" name="em_password" type="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="twm-forgot-wrap">
                          <div class="form-group mb-3 p-relative">
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="em_remember" name="em_remember" value="1">
                              <label class="form-check-label rem-forgot" for="em_remember">
                                Mantenerme Conectado
                              </label>
                              <a href="<?php echo URL_WEB . 'recoverCompany'; ?>" class="site-text-primary p-forgot">Recuperar contraseña</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <button type="button" onclick="$('#form-loginE').submit();" class="site-button-1">Iniciar Sesión</button>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <p>¿No tenés cuenta? Registrate <a href="<?php echo URL_WEB . 'registerCompany'; ?>" class="text-uppercase">aquí</a></p>
                        </div>
                      </div>
                      <!--div class="col-md-12">
                        <div class="form-group">
                          <span class="center-text-or">O</span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <button type="submit" class="log_with_google">
                            <img src="<?php echo URL_IMG; ?>google-icon.png" alt=""> Iniciar Sesión con Google
                          </button>
                        </div>
                      </div-->
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
<!-- Login Section End -->
<!-- OUR BLOG END -->