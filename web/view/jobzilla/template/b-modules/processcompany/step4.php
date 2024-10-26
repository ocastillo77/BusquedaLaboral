<?php
$urlMPago = URL_WEB . 'getPreferenceCompany';
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
      if (!empty($data['listCompany'])) :
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
                    Accedió a su cuenta como: <strong><?php echo Session::get('em_name') ?></strong>
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
                        <h3 class="title-border custom mb30">Información de la Empresa</h3>
                        <div class="form-group">
                          <label>CUIT</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="cuit" type="text" value="<?php echo isset($rUser['CUIT']) ? $rUser['CUIT'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Razón Social</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="nombre" type="text" placeholder="Razón Social" value="<?php echo isset($rUser['Nombre']) ? $rUser['Nombre'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="email" type="text" placeholder="Email" value="<?php echo isset($rUser['Email']) ? $rUser['Email'] : ''; ?>" readonly="true">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Teléfono</label>
                          <div class="ls-inputicon-box">
                            <input class="form-control" id="telefono" type="text" placeholder="Teléfono" value="<?php echo isset($rUser['Telefono']) ? $rUser['Telefono'] : ''; ?>" readonly="true">
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
                          <a href="<?php echo URL_WEB . 'checkoutCompany'; ?>" class="btn btn-dark">Editar</a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  3. Método de Pago
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionSubs">
                <div class="accordion-body">
                  <div class="panel-body">
                    <h3 class="title-border custom mb-3">Método de pago seleccionado</h3>
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
                                <a id="link-<?php echo $item['Clave']; ?>" class="link-image <?php echo $active; ?> mt-2" href="javascript:checkRadio('<?php echo $item['Clave']; ?>');">
                                  <img src="<?php echo URL_IMG . $item['Imagen']; ?>" alt="<?php echo $item['Nombre']; ?>" width="<?php echo $item['ImgWidth']; ?>" /></ </div>
                                </a>
                              </div>
                          <?php
                            endforeach;
                          endif;
                          ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                  4. Confirmar Pago
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionSubs">
                <div class="accordion-body">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table cart-table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">Plan de Subscripción</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $total = 0;
                          foreach ($data['listCompany'] as $item) :
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                          ?>
                            <tr>
                              <td>
                                <?php echo $item['name']; ?>
                              </td>
                              <td class="text-right">
                                $ <?php echo Helper::moneyFormat($item['price']); ?>
                              </td>
                              <td class="text-right">
                                $ <?php echo Helper::moneyFormat($subtotal); ?>
                              </td>
                              <td width="130" class="text-center">
                                <a href="javascript:removeCartProcess(<?php echo $item['id']; ?>);" class="btn btn-danger btn-sm btn-delete" title="Eliminar Producto">
                                  <i class="fa fa-trash"></i> Eliminar
                                </a>
                              </td>
                            </tr>
                          <?php
                          endforeach;
                          ?>
                          <tr>
                            <td class="text-right" colspan="2">Subtotal:</td>
                            <td class="text-right">$ <?php echo Helper::moneyFormat($total); ?></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td class="text-right" colspan="2">Descuento:</td>
                            <td class="text-right">$ 0.00</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td class="text-right" colspan="2"><strong>TOTAL:</strong></td>
                            <td class="text-right">
                              <strong>$ <?php echo Helper::moneyFormat($total); ?></strong>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div><!-- End .table-responsive -->

                    <div class="mb30"></div><!-- space -->
                    <div class="row">
                      <div class="col-md-8">
                      </div>
                      <div class="col-md-4 text-right">
                        <div id="button-checkout" class="text-uppercase"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
    </div><!-- End .col-md-12 -->

  </div><!-- End .row -->
</div><!-- End .container -->
<input type="hidden" id="urlMPago" value="<?php echo $urlMPago; ?>" />