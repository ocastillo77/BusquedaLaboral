<?php
$urlAccount = URL_WEB . 'account';
$urlUnsubscribe = URL_WEB . 'unsubscribeSubmit';
?>
<!-- Employer Account START -->
<div class="section-full p-t145 p-b90 site-bg-white bg-cover twm-ac-fresher-wrap">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-8 col-md-12">
        <div class="twm-right-section-panel-wrap2">
          <!--Filter Short By-->
          <div class="twm-right-section-panel bg-secondary m-t30">
            <!--Basic Information-->
            <div class="panel panel-default">
              <div class="panel-heading wt-panel-heading p-a20 p-t30">
                <h3 class="panel-tittle m-b30 text-center"><?php echo $data['title']; ?></h3>
                <p class="text-center">
                  Hola <b><?php echo Session::get('wb_name'); ?></b>, ¿estás seguro de que quieres dar de baja tu plan actual?<br>
                  De ser así tené en cuenta que podrás seguir utilizando la plataforma hasta el <?php echo date('t/m/Y'); ?>.
                </p>
                <div class="text-center m-t30 m-b20">
                  <a href="<?php echo $urlAccount; ?>" class="site-button bg-yellow">Cancelar</a>
                  <a href="<?php echo $urlUnsubscribe; ?>" class="site-button bg-danger text-white">Confirmar Baja</a>
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