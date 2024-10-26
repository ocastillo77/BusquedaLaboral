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
          <input type="text" class="form-control" placeholder="DNI" readonly="true" value="<?php echo isset($rUser['DNI']) ? $rUser['DNI'] : ''; ?>">
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-user"></span>
            <span class="input-text">Nombre</span>
          </span>
          <input type="text" class="form-control" placeholder="Nombre y Apellido" readonly="true" value="<?php echo isset($rUser['Nombre']) ? $rUser['Nombre'] : ''; ?>">
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-email">
            </span><span class="input-text">Email</span>
          </span>
          <input type="text" class="form-control" placeholder="Correo Electrónico" readonly="true" value="<?php echo isset($rUser['Email']) ? $rUser['Email'] : ''; ?>">
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-phone"></span>
            <span class="input-text">Celular</span>
          </span>
          <input type="text" class="form-control" placeholder="Celular" readonly="true" value="<?php echo isset($rUser['Celular']) ? $rUser['Celular'] : $item['Celular']; ?>">
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-postcode"></span>
            <span class="input-text">Código Postal</span>
          </span>
          <input type="text" class="form-control" placeholder="Código Postal" id="cpostalPrev" readonly="true" value="<?php echo isset($rUser['CPostal']) ? $rUser['CPostal'] : $item['CPostal']; ?>">
        </div><!-- End .input-group -->

      </div><!-- End .col-md-6 -->

      <div class="mb30 visible-xs visible-sm"></div><!-- space -->

      <div class="col-md-6">
        <h3 class="title-border custom mb30">Dirección de Facturación</h3>
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-address"></span>
            <span class="input-text">Dirección</span>
          </span>
          <input type="text" class="form-control" placeholder="Dirección" id="direccionPrev" readonly="true" value="<?php echo isset($rUser['Direccion']) ? $rUser['Direccion'] : ''; ?>">
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-city"></span>
            <span class="input-text">Localidad</span></span>
          <input type="text" class="form-control" placeholder="Localidad" id="localidadPrev" readonly="true" value="<?php echo isset($rUser['Localidad']) ? $rUser['Localidad'] : ''; ?>">
        </div><!-- End .input-group -->
        <div class="input-group">
          <span class="input-group-addon min-width">
            <span class="input-icon input-icon-country"></span>
            <span class="input-text">Provincia</span></span>
          <div class="clearfix">
            <select id="provinciaPrev" readonly="true" class="form-control">
              <?php
              if (isset($data['s_provincias']) && count($data['s_provincias']) > 0) :
                foreach ($data['s_provincias'] as $item) :
                  $provinciaId = isset($rUser['ProvinciaID']) ? $rUser['ProvinciaID'] : '';
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
            <select id="departamentoPrev" readonly="true" class="form-control">
              <?php
              if (isset($data['s_departamentos']) && count($data['s_departamentos']) > 0) :
                foreach ($data['s_departamentos'] as $item) :
                  $departamentoId = isset($rUser['DepartamentoID']) ? $rUser['DepartamentoID'] : '';
                  $selected = $departamentoId == $item['ID'] ? 'selected="selected"' : '';
              ?>
                  <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
              <?php
                endforeach;
              endif;
              ?>
            </select>
          </div><!-- End .large-selectbox-->
        </div><!-- End .input-group -->

        <div class="text-right">
          <a href="<?php echo URL_WEB . 'checkout'; ?>" class="btn btn-dark">Editar</a>
        </div>
      </div><!-- End .col-md-6 -->
    </div><!-- End .row -->
  </form>
</div><!-- End .panel-body -->