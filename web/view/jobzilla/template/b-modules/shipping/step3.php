<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
      if (isset($data['listProducts']) && is_array($data['listProducts']) && count($data['listProducts']) > 0) :
        $count = count($data['listProducts']);
        ?>
        <div class="checkout">
          <div class="panel-group" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h2 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Acceso a Mi Cuenta
                    <span class="panel-icon"></span>
                  </a>
                  <span class="step-box">1.</span>
                </h2>
              </div><!-- End .panel-heading -->
              <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <p class="text-center">
                    Accedió a su cuenta como: <strong><?php echo Session::get('wb_name') ?></strong>
                  </p>
                </div><!-- End .panel-body -->
              </div><!-- End .panel-collapse -->
            </div><!-- End .panel -->

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h2 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Datos de Facturación
                    <span class="panel-icon"></span>
                  </a>
                  <span class="step-box">2.</span>
                </h2>
              </div><!-- End .panel-heading -->
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <?php include 'step2.php'; ?>
              </div><!-- End .panel-collapse -->
            </div><!-- End .panel -->

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h2 class="panel-title">
                  <a data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Información de Envío
                    <span class="panel-icon"></span>
                  </a>
                  <span class="step-box">3.</span>
                </h2>
              </div><!-- End .panel-heading -->
              <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <form id="form-billing" method="post" action="<?php echo URL_WEB . 'shipping'; ?>">
                    <input type="hidden" id="shipping" name="shipping" value="1" />
                    <div class="row factura">
                      <div class="col-md-6">
                        <h3 class="title-border custom mb30">Información Personal</h3>
                        <div class="checkbox input-group">
                          <label class="custom-checkbox-wrapper">
                            <span class="custom-checkbox-container">
                              <?php
                              $checked = isset($data['dirsend']) && $data['dirsend'] == 1 ? 'checked' : '';
                              ?>
                              <input onchange="getAddressPrev(this.checked)" type="checkbox" name="dirsend" value="1" <?php echo $checked; ?>>
                              <span class="custom-checkbox-icon"></span>
                            </span>
                            Quiero usar mi dirección de facturación como dirección de envío
                          </label>
                        </div><!-- End .checkbox -->
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">DNI</span>                              
                          </span>
                          <input type="text" required class="form-control" placeholder="DNI" 
                                 readonly="true"
                                 value="<?php echo isset($rUser['DNI']) ? $rUser['DNI'] : ''; ?>">                            
                        </div><!-- End .input-group -->                        
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-user"></span>
                            <span class="input-text">Nombre</span>                              
                          </span>
                          <input type="text" required class="form-control" placeholder="Nombre y Apellido" 
                                 readonly="true"
                                 value="<?php echo isset($rUser['Nombre']) ? $rUser['Nombre'] : ''; ?>">
                        </div><!-- End .input-group -->
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-email">                              
                            </span><span class="input-text">Email</span>                              
                          </span>
                          <input type="text" required class="form-control" placeholder="Correo Electrónico" 
                                 readonly="true"
                                 value="<?php echo isset($rUser['Email']) ? $rUser['Email'] : ''; ?>">
                        </div><!-- End .input-group -->
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-phone"></span>
                            <span class="input-text">Celular</span>                              
                          </span>
                          <input type="text" required class="form-control" placeholder="Celular" 
                                 readonly="true"
                                 value="<?php echo isset($rUser['Celular']) ? $rUser['Celular'] : ''; ?>">
                        </div><!-- End .input-group -->                     

                      </div><!-- End .col-md-6 -->

                      <div class="mb30 visible-xs visible-sm"></div><!-- space -->

                      <div class="col-md-6">
                        <h3 class="title-border custom mb30">Dirección de Envío</h3>

                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-address"></span>
                            <span class="input-text">Dirección</span>
                          </span>
                          <input type="text" class="form-control" placeholder="Dirección"
                                 id="direccion" name="usuarios[Direccion]" 
                                 value="<?php echo isset($rUser['Direccion']) && $data['dirsend'] == 1 ? $rUser['Direccion'] : (isset($post['Direccion']) ? $post['Direccion'] : ''); ?>">
                          <p class="form-error"><?php echo isset($rError['Direccion']) ? $rError['Direccion'] : ''; ?></p>
                        </div><!-- End .input-group -->     
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-address"></span>
                            <span class="input-text">Código Postal</span>
                          </span>
                          <input type="text" class="form-control" placeholder="Código Postal"
                                 id="cpostal" name="usuarios[CPostal]"
                                 value="<?php echo isset($rUser['CPostal']) && $data['dirsend'] == 1 ? $rUser['CPostal'] : (isset($post['CPostal']) ? $post['CPostal'] : ''); ?>">
                          <p class="form-error"><?php echo isset($rError['CPostal']) ? $rError['CPostal'] : ''; ?></p>
                        </div><!-- End .input-group -->     
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-city"></span>
                            <span class="input-text">Localidad</span></span>
                          <input type="text" required class="form-control" placeholder="Localidad"
                                 id="localidad" name="usuarios[Localidad]" 
                                 value="<?php echo isset($rUser['Localidad']) && $data['dirsend'] == 1 ? $rUser['Localidad'] : (isset($post['Localidad']) ? $post['Localidad'] : ''); ?>">
                          <p class="form-error"><?php echo isset($rError['Localidad']) ? $rError['Localidad'] : ''; ?></p>
                        </div><!-- End .input-group -->                        
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-country"></span>
                            <span class="input-text">Provincia</span></span>
                          <div class="clearfix">
                            <select id="provincia" name="usuarios[ProvinciaID]" onchange="changeProvincia(this.value);" class="form-control">                							
                              <option value="0">- Seleccione -</option>
                              <?php
                              if (isset($data['provincias']) && count($data['provincias']) > 0) :
                                foreach ($data['provincias'] as $item):
                                  $provinciaId = isset($rUser['ProvinciaID']) && $data['dirsend'] == 1 ? $rUser['ProvinciaID'] : (isset($post['ProvinciaID']) ? $post['ProvinciaID'] : '');
                                  $selected = $provinciaId == $item['ID'] ? 'selected="selected"' : '';
                                  ?>								
                                  <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                                  <?php
                                endforeach;
                              endif;
                              ?>
                            </select>  
                          </div><!-- End .large-selectbox-->
                          <p class="form-error"><?php echo isset($rError['ProvinciaID']) ? $rError['ProvinciaID'] : ''; ?></p>
                        </div><!-- End .input-group -->
                        <div class="input-group">
                          <span class="input-group-addon min-width">
                            <span class="input-icon input-icon-region"></span>
                            <span class="input-text">Departamento</span>                              
                          </span>
                          <div class="clearfix">
                            <select id="departamento" name="usuarios[DepartamentoID]" class="form-control">                							
                              <option value="0">- Seleccione -</option>
                              <?php
                              if (isset($data['departamentos']) && count($data['departamentos']) > 0) :
                                foreach ($data['departamentos'] as $item):
                                  $departamentoId = isset($rUser['DepartamentoID']) && $data['dirsend'] == 1 ? $rUser['DepartamentoID'] : (isset($post['DepartamentoID']) ? $post['DepartamentoID'] : '');
                                  $selected = $departamentoId == $item['ID'] ? 'selected="selected"' : '';
                                  ?>								
                                  <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                                  <?php
                                endforeach;
                              endif;
                              ?>
                            </select>  
                          </div><!-- End .large-selectbox-->
                          <p class="form-error"><?php echo isset($rError['DepartamentoID']) ? $rError['DepartamentoID'] : ''; ?></p>
                        </div><!-- End .input-group -->

                        <div class="text-right">
                          <input type="submit" class="btn btn-custom" value="Confirmar y Continuar">
                        </div>
                      </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                  </form> 
                </div><!-- End .panel-body -->
              </div><!-- End .panel-collapse -->
            </div><!-- End .panel -->

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingSix">
                <h2 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseSix">
                    Confirmar Orden de Compra
                    <span class="panel-icon"></span>
                  </a>
                  <span class="step-box">4.</span>
                </h2>
              </div><!-- End .panel-heading -->
            </div><!-- End .panel -->
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