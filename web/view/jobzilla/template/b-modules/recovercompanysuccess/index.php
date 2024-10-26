<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : $data['title'];
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$item = isset($data['info']) ? $data['info'] : [];
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
                <div class="g-mt-15 mb-3 text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
                <div class="text-center">Volver a iniciar sesión <a href="<?php echo URL_WEB . 'loginCompany'; ?>" class="text-uppercase">aquí</a></div>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Employer Account START END -->