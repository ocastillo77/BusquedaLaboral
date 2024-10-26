<?php ?>
<div class="row justify-content-center">
  <div class="col-md-11">
    <header class="text-center g-mb-40 g-bg-gray-light-v5 g-py-15 rounded">
      <h3 class="h5 g-color-black g-font-weight-600 g-mb-0">Historial de Donaciones</h3>
    </header>

    <div class="table-responsive">
      <table class="table cart-table cart-table2 no-bg">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Forma de Pago</th>
            <th class="text-center">Comprobante</th>
            <th class="text-center">Monto</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($data['orders']) && is_array($data['orders']) && count($data['orders']) > 0) :
            foreach ($data['orders'] as $item) :
              $url = !empty($item['Archivo']) ? URL_GAL . 'donaciones/files/' . $item['Archivo'] : '';
              $fecha = Helper::dateTimeFormat($item['TimeCreate']);
              ?>
              <tr>
                <td class="text-center"><?php echo $item['ID']; ?></td>
                <td class="text-center"><?php echo $fecha; ?></td>
                <td><?php echo $item['Nombre']; ?></td>
                <td class="text-center"><?php echo $item['FPago']; ?></td>
                <?php if (!empty($url)) : ?>
                  <td class="text-center"><a href="<?php echo $url; ?>" target="_blank"><?php echo $item['Archivo']; ?></a></td>
                <?php else : ?>
                  <td class="text-center">-</td>
                <?php endif; ?>
                <td class="text-center">$ <?php echo Helper::moneyFormat($item['Monto']); ?></td>
              </tr>
              <?php
            endforeach;
          else :
            ?>
            <tr>
              <td colspan="6" class="text-center">No se encontraron pedidos!</td>
            </tr>
          <?php
          endif;
          ?>
        </tbody>
      </table>
    </div><!-- End .table-responsive -->
  </div>
</div>

