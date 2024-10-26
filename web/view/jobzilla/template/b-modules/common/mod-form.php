<div class="col-lg-7 col-md-7">
  <div class="card padding-card">
    <div class="card-body">
      <div id="alert-msg"></div>
      <h3 class="text-center">Formulario de Contacto</h3>
      <form id="form-contact" method="post">
        <input type="hidden" id="enviar" name="enviar" value="1">
        <div class="control-group form-group">
          <div class="controls">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre y Apellido" class="form-control" required>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <input type="email" id="email" name="email" placeholder="Correo Electrónico"  class="form-control" required>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <input type="text" id="telefono" name="telefono" placeholder="Teléfono"  class="form-control" required>
          </div>
        </div>
        <div class="control-group form-group">
          <div class="controls">
            <textarea id="consulta" name="consulta" placeholder="Consulta" rows="5" cols="50" class="form-control"></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-block">Enviar Consulta</button>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    validator('form-contact', '<?php echo URL_WEB . 'send_contact'; ?>');
  });
</script>