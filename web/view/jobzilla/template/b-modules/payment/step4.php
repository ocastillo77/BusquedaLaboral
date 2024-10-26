<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
      if (isset($data['listProducts']) && is_array($data['listProducts']) && count($data['listProducts']) > 0) :
        $count = count($data['listProducts']);
      ?>
        <div class="checkout">
          <div class="bg-full">
            <div class="center-hv text-center rectdom">
              <img src="<?php echo URL_IMG; ?>loader100.gif" alt="Procesando" width="100" />
              <h3>Procesando!</h3>
              <p>Por favor, espere...</p>
            </div>
          </div>
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
                    Accedió a su cuenta como: <strong><?php echo Session::get('wb_name') ?></strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  2. Datos de Facturación
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSubs">
                <div class="accordion-body">
                  <div class="panel-body">
                    <div class="row factura">
                      <div class="col-md-6">
                        <h3 class="title-border custom mb30">Información Personal</h3>
                        <div class="form-group">
                          <label>DNI</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="dni" type="text" value="<?php echo isset($rUser['DNI']) ? $rUser['DNI'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Nombre y Apellido</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="nombre" type="text" placeholder="Nombre y Apellido" value="<?php echo isset($rUser['Nombre']) ? $rUser['Nombre'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="email" type="text" placeholder="Email" value="<?php echo isset($rUser['Email']) ? $rUser['Email'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Celular</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="celular" type="text" placeholder="Celular" value="<?php echo isset($rUser['Celular']) ? $rUser['Celular'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Código Postal</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="cpostal" type="text" placeholder="Código Postal" value="<?php echo isset($rUser['CPostal']) ? $rUser['CPostal'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <h3 class="title-border custom mb30">Domicilio</h3>
                        <div class="form-group">
                          <label>Dirección</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="direccion" type="text" placeholder="Dirección" value="<?php echo isset($rUser['Direccion']) ? $rUser['Direccion'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Localidad</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="localidad" type="text" placeholder="Localidad" value="<?php echo isset($rUser['Localidad']) ? $rUser['Localidad'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Provincia</label>
                          <div class="ls-inputicon-box">
                            <select id="provincia" readonly="true" class="form-control">
                              <?php
                              if (!empty($data['provincias'])) :
                                foreach ($data['provincias'] as $item):
                                  $selected = $rUser['ProvinciaID'] == $item['ID'] ? 'selected="selected"' : '';
                              ?>
                                  <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                              <?php
                                endforeach;
                              endif;
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Departamento</label>
                          <div class="ls-inputicon-box">
                            <select id="departamento" readonly="true" class="form-control">
                              <?php
                              if (!empty($data['departamentos'])) :
                                foreach ($data['departamentos'] as $item):
                                  $selected = $rUser['DepartamentoID'] == $item['ID'] ? 'selected="selected"' : '';
                              ?>
                                  <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                              <?php
                                endforeach;
                              endif;
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="text-right">
                          <a href="<?php echo URL_WEB . 'checkout'; ?>" class="btn btn-dark">Editar</a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  3. Método de Pago
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionSubs">
                <div class="accordion-body">
                  <div class="panel-body">
                    <h3 class="title-border custom mb-3">Seleccione el método de pago</h3>
                    <p>Paga con tarjeta de crédito y débito en la plataforma de Mercado Pago Checkout:</p>
                    <form id="form-payment" method="post" action="<?php echo URL_WEB . 'payment'; ?>">
                      <input type="hidden" id="payment" name="payment" value="1" />
                      <div class="checkboxArea card-check">
                        <div class="row mb-3">
                          <?php
                          if (!empty($data['payments'])) :
                            foreach ($data['payments'] as $item) :
                              $checked = $item['ID'] == $data['paymentId'] ? 'checked="checked"' : '';
                              $active = $item['ID'] == $data['paymentId'] ? 'link-image-active' : '';
                          ?>
                              <div class="col-md-6">
                                <input id="<?php echo $item['Clave']; ?>" type="radio" class="payment" name="paymentid" value="<?php echo $item['ID']; ?>" <?php echo $checked; ?>>
                                <label for="<?php echo $item['Clave']; ?>"><span></span><?php echo $item['Nombre']; ?></label>
                                <a id="link-<?php echo $item['Clave']; ?>" class="link-image <?php echo $active; ?> mt-2" href="javascript:checkRadio('<?php echo $item['Clave']; ?>');">
                                  <img src="<?php echo URL_IMG . $item['Imagen']; ?>" alt="<?php echo $item['Nombre']; ?>" width="<?php echo $item['ImgWidth']; ?>" /></ </div>
                                </a>
                              </div>
                          <?php
                            endforeach;
                          endif;
                          ?>
                        </div>
                        <p class="form-error"><?php echo isset($rError['paymentid']) ? $rError['paymentid'] : ''; ?></p>
                        <div class="row">
                          <div class="col-md-6">
                            <img src="<?php echo URL_IMG . 'card1.jpg'; ?>" alt="Tarjeta Visa" />
                            <img src="<?php echo URL_IMG . 'card3.jpg'; ?>" alt="Tarjeta Mastercard" />
                          </div>
                          <div class="col-md-6 text-right">
                            <input type="submit" class="btn btn-custom text-uppercase" value="Confirmar y Continuar">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <span class="accordion-button collapsed">
                  4. Confirmar Pago
                </span>
              </h2>
            </div>
          </div>
        </div>
      <?php
      else :
      ?>
        <div class="mt40"></div>
        <p class="text-center">No se encontraron productos en el carrito!</p>
      <?php
      endif;
      ?>
    </div><!-- End .col-md-12 -->

  </div><!-- End .row -->
</div><!-- End .container -->