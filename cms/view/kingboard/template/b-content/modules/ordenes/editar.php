<?php
$tabla = $data['tabla'];
?>
<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>    
      </div>
      <div class="widget-content">
        <div class="top-actions">
          <select onchange="changeStatus(this.value)" class="form-control frmctrl-custom">                							
            <?php
            $estados = [1 => 'Generado', 2 => 'En Proceso', 3 => 'En Delivery', 4 => 'Entregado'];
            foreach ($estados as $key => $value) :
              $select = $key == $data[$tabla]['Publico'] ? 'selected' : '';
              ?>
              <option value="<?php echo $key; ?>" <?php echo $select; ?>><?php echo $value; ?></option>
              <?php
            endforeach;
            ?>
          </select>
          <a onclick="validarOrden();" class="btn btn-primary">Guardar</a>
          <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
        </div>
        <div class="clear"></div>
        <?php include('editar/index.php'); ?>
        <div class="top-actions">
          <a onclick="validarOrden();" class="btn btn-primary">Guardar</a>
          <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
        </div>
        <div class="clear"></div>
      </div>
    </div><!--/widget-->
  </div><!--/col-md-12-->
</div><!--/row-->
<script>
  function changeStatus(id) {
    $('#publico').val(id);
  }

  function validarOrden() {
    $('#form').submit();
  }
</script>