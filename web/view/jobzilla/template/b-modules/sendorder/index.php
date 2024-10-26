<div class="section-full p-t120  p-b90 site-bg-white">
  <div class="container">
    <div class="twm-right-section-panel site-bg-gray">
      <div class="twm-pro-view-chart-wrap">
        <div class="row">
          <div class="col-lg-12 col-md-12 mb-4">
            <div class="panel panel-default">
              <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0"><?php echo $data['title']; ?></h4>
              </div>
              <div class="panel-body wt-panel-body bg-white">
                <div class="twm-dashboard-candidates-wrap">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="animate-success">
                          <div class="success-checkmark">
                            <div class="check-icon">
                              <span class="icon-line line-tip"></span>
                              <span class="icon-line line-long"></span>
                              <div class="icon-circle"></div>
                              <div class="icon-fix"></div>
                            </div>
                          </div>
                        </div>
                        <div class="description-success text-center">
                          <h4>Su pedido fue realizado con exito</h4>
                          <p>&iexcl;Muchas gracias por elegirnos!</p>
                          <p>
                            Hemos enviado una copia de la Nota de Pedido a su correo electrónico:<br>
                            <span class="label label-custom"><?php echo $data['email']; ?></span>
                          </p>
                          <div class="text-center mt40">
                            <a href="<?php echo URL_WEB; ?>"
                              class="btn btn-dark btn-sm text-uppercase">Continuar Comprando</a>
                            <a href="<?php echo URL_WEB . 'download/' . $data['ordenId']; ?>"
                              class="btn btn-danger btn-sm text-uppercase">Descargar PDF</a>
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
    </div>
  </div>
</div>