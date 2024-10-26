<div class="col-md-12">
  <div class="widget widget-scrolling">
    <div class="widget-header">
      <h3><i class="fa fa-fire"></i> Historial de Cambios</h3>
    </div>
    <div class="widget-content">
      <?php
      if (count($data['historial']) > 0) :
        ?>
        <ul class="list-unstyled activity-list">
          <?php
          foreach ($data['historial'] as $item) :
            $fecha = Helper::formatDateLarge($item['TimeCreate']);
            $hora = Helper::dateTimeFormat($item['TimeCreate'], 'H:i:s');
            $estado = Helper::stateOrder($item['Estado']);
            ?>
            <li>
              <i class="fa fa-check activity-icon pull-left icon-success"></i>              
              <p>
                <strong class="username"><?php echo $item['Usuario']; ?></strong> 
                cambió el estado de la órden a <?php echo $estado; ?>
                <span class="timestamp"><?php echo $fecha . ' - ' . $hora; ?></span>
              </p>
            </li>
            <?php
          endforeach;
          ?>
        </ul>
        <?php
      else :
        ?>
        <p class="text-center">No se encontraron registros</p>
      <?php
      endif;
      ?>
    </div>
  </div>
</div>
