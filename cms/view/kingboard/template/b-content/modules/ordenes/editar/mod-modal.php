<?php
$cliente = $data['cliente'];
?>
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-info-circle"></i> Información de Contacto</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>DNI</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['DNI']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Nombre</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Nombre']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Email</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Email']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Celular</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Celular']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Cód. Postal</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['CPostal']; ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-6">            
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Dirección</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Direccion']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Localidad</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Localidad']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Departamento</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Departamento']; ?></span>
              </div>
            </div>
            <div class="row controls-show">
              <div class="col-md-4">
                <strong>Provincia</strong>          
              </div>
              <div class="col-md-8">
                <span><?php echo $cliente['Provincia']; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
//  $('#myModal').dialog({
//    width: 800
//  });
</script>