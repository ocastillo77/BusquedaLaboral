<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
      if (!empty($data['listCompany'])) :
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
                    Accedió a su cuenta como: <strong><?php echo Session::get('em_name') ?></strong>
                  </p>                  
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  2. Datos de Facturación
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionSubs">
                <div class="accordion-body">
                  <div class="panel-body">
                    <?php if (!empty($mensaje)) : ?>
                      <div class="text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
                    <?php endif; ?>
                    <form id="form-billing" method="post" action="<?php echo URL_WEB . 'billingCompany'; ?>">
                      <input type="hidden" id="register" name="billing" value="1" />
                      <div class="row factura">
                        <div class="col-md-6">
                          <h3 class="title-border custom mb30">Información de la Empresa</h3>
                          <div class="form-group">
                            <label>CUIT</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="cuit" type="text" placeholder="CUIT" value="<?php echo isset($rUser['CUIT']) ? $rUser['CUIT'] : ''; ?>" required readonly="true">
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Razón Social</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="nombre" type="text" placeholder="Razón Social" value="<?php echo isset($rUser['Nombre']) ? $rUser['Nombre'] : ''; ?>" required readonly="true">
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="email" type="text" placeholder="Email" value="<?php echo isset($rUser['Email']) ? $rUser['Email'] : ''; ?>" required readonly="true">
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Teléfono</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="telefono" name="empresas[Teléfono]" type="text" placeholder="Teléfono" value="<?php echo isset($rUser['Telefono']) ? $rUser['Telefono'] : ''; ?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Código Postal</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="cpostal" name="empresas[CPostal]" type="text" placeholder="Código Postal" value="<?php echo isset($rUser['CPostal']) ? $rUser['CPostal'] : ''; ?>" required>
                              <p class="form-error"><?php echo isset($rError['CPostal']) ? $rError['CPostal'] : ''; ?></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <h3 class="title-border custom mb30">Domicilio</h3>
                          <div class="form-group">
                            <label>Dirección</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="direccion" name="empresas[Direccion]" type="text" placeholder="Dirección" value="<?php echo isset($rUser['Direccion']) ? $rUser['Direccion'] : ''; ?>" required>
                              <p class="form-error"><?php echo isset($rError['Direccion']) ? $rError['Direccion'] : ''; ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Localidad</label>
                            <div class="ls-inputicon-box">
                              <input class="form-control" id="localidad" name="empresas[Localidad]" type="text" placeholder="Localidad" value="<?php echo isset($rUser['Localidad']) ? $rUser['Localidad'] : ''; ?>" required>
                              <p class="form-error"><?php echo isset($rError['Localidad']) ? $rError['Localidad'] : ''; ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Provincia</label>
                            <div class="ls-inputicon-box">
                              <select id="provincia" name="empresas[ProvinciaID]" onchange="changeProvincia(this.value);" class="form-control">
                                <option value="0">- Seleccione -</option>
                                <?php
                                if (isset($data['provincias']) && count($data['provincias']) > 0) :
                                  foreach ($data['provincias'] as $item):
                                    $selected = $rUser['ProvinciaID'] == $item['ID'] ? 'selected="selected"' : '';
                                ?>
                                    <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                                <?php
                                  endforeach;
                                endif;
                                ?>
                              </select>
                              <p class="form-error"><?php echo isset($rError['ProvinciaID']) ? $rError['ProvinciaID'] : ''; ?></p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Departamento</label>
                            <div class="ls-inputicon-box">
                              <select id="departamento" name="empresas[DepartamentoID]" class="form-control">
                                <option value="0">- Seleccione -</option>
                                <?php
                                if (isset($data['departamentos']) && count($data['departamentos']) > 0) :
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
                            <p class="form-error"><?php echo isset($rError['DepartamentoID']) ? $rError['DepartamentoID'] : ''; ?></p>
                          </div>
                          <div class="text-right">
                            <input type="hidden" name="dirsend" value="1">
                            <input type="submit" class="btn btn-custom" value="Confirmar y Continuar">
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
                  3. Método de Pago
                </span>
              </h2>
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
    </div><!-- End .panel-group -->
  </div><!-- End .checkout -->
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