<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : $data['title'];
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$urlform = URL_WEB . 'recoverCompanySubmit';
?>
<!-- Employer Account START -->
<div class="section-full p-t145  p-b90 site-bg-white bg-cover twm-ac-fresher-wrap">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-md-12">
        <div class="twm-right-section-panel-wrap2">
          <!--Filter Short By-->
          <div class="twm-right-section-panel site-bg-primary">
            <!--Basic Information-->
            <div class="panel panel-default">
              <div class="panel-heading wt-panel-heading p-a20 p-t30">
                <h3 class="panel-tittle m-b30 text-center">Recuperar Contraseña Empresas</h3>
                <div id="alert-form" class="g-mt-15 text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
              </div>
              <div class="panel-body wt-panel-body p-a20 ">
                <form id="form-recover" class="form-ajax" method="post" action="<?php echo $urlform; ?>">
                  <input type="hidden" id="recovercompany" name="recovercompany" value="1" />
                  <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                      <div class="form-group">
                        <label>Correo Electrónico</label>
                        <div class="ls-inputicon-box">
                          <input class="form-control" id="email" name="email" type="email" placeholder="info@empresa.com">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-3">
                      <div class="text-center">
                        <button id="btn-recover" type="submit" class="btn-submit">Recuperar</button>
                      </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                      <div class="text-center">Volver a iniciar sesión <a href="<?php echo URL_WEB . 'loginCompany'; ?>" class="text-uppercase">aquí</a></div>
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
<!-- Employer Account START END -->