<div class="row">
  <div class="col-md-12">
    <div class="content-error text-center">      
      <?php
      switch ($data['type']):
        case 'failure':
      ?>
          <h1>No se realizó el pago</h1>
          <p>Por favor intente nuevamente en unos minutos.</p>
        <?php
          break;
        case 'pending':
        ?>
          <h1>El pago está pendiente de finalizar</h1>
          <p>Por favor envienos un mensaje a través de nuestro formulario de contacto.</p>
        <?php
          break;
        default:
        ?>
          <h1>No se realizó el pago</h1>
          <p>Hubo un error al procesar el pago. Por favor intente nuevamente.</p>
      <?php
      endswitch;
      ?>
      <a href="<?php echo URL_WEB; ?>" class="btn btn-primary">
        <i class="fa fa-home"></i> Volver al Inicio
      </a>
    </div>
  </div>
</div>