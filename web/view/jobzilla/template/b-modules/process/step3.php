<div class="panel-body">
  <form id="form-billing" method="post">
    <div class="row factura">
      <div class="col-md-6">
        <h3 class="title-border custom mb30">Información Personal</h3>        
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
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-address"></span>
            <span class="input-text">Código Postal</span>
          </span>
          <input type="text" class="form-control" placeholder="Código Postal"  
                 readonly="true"
                 value="<?php echo isset($rUser['CPostal']) && $data['dirsend'] == 1 ? $rUser['CPostal'] : (isset($post['CPostal']) ? $post['CPostal'] : ''); ?>">
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
                 readonly="true"
                 value="<?php echo isset($rUser['Direccion']) && $data['dirsend'] == 1 ? $rUser['Direccion'] : (isset($post['Direccion']) ? $post['Direccion'] : ''); ?>">
        </div><!-- End .input-group -->    
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-city"></span>
            <span class="input-text">Localidad</span></span>
          <input type="text" required class="form-control" placeholder="Localidad"
                 readonly="true"
                 value="<?php echo isset($rUser['Localidad']) && $data['dirsend'] == 1 ? $rUser['Localidad'] : (isset($post['Localidad']) ? $post['Localidad'] : ''); ?>">
        </div><!-- End .input-group -->                        
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-country"></span>
            <span class="input-text">Provincia</span></span>
          <div class="clearfix">
            <select readonly="true" class="form-control">                							
              <?php
              if (isset($data['p_provincias']) && count($data['p_provincias']) > 0) :
                foreach ($data['p_provincias'] as $item):
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
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-region"></span>
            <span class="input-text">Departamento</span>                              
          </span>
          <div class="clearfix">
            <select readonly="true" class="form-control">                							
              <?php
              if (isset($data['p_departamentos']) && count($data['p_departamentos']) > 0) :
                foreach ($data['p_departamentos'] as $item):
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
          <a href="<?php echo URL_WEB . 'shipping'; ?>" class="btn btn-dark">Editar</a>
        </div>
      </div><!-- End .col-md-6 -->
    </div><!-- End .row -->
  </form> 
</div><!-- End .panel-body -->