<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
      if (!empty($data['listProducts'])) :
      ?>
        <div class="checkout">
          <div class="accordion" id="accordionSubs">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  1. Acceso a Mi Cuenta
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionSubs">
                <div class="accordion-body">
                  <p class="text-center">
                    Por favor, registrese o acceda a su cuenta para continuar con el Proceso de Pago:
                  </p>
                  <div class="text-center">
                    <a href="<?php echo URL_WEB . 'login'; ?>" class="btn btn-custom">Iniciar Sesión</a>
                    <a href="<?php echo URL_WEB . 'register'; ?>" class="btn btn-custom">Registrarse</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <span class="accordion-button collapsed">
                  2. Datos de Facturación
                </span>
              </h2>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <span class="accordion-button collapsed">
                  3. Confirmar Pago del Plan
                </span>
              </h2>
            </div>
          </div>


        </div>
      <?php
      else :
      ?>
        <div class="mt40"></div>
        <p class="text-center">No seleccionó su Plan de Subscripción!</p>
      <?php
      endif;
      ?>
    </div>
  </div>
</div>