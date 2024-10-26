<?php
$config = $data['config'];
$nombre_sitio = $config['Nombre'];
$direccion = $config['Direccion'];
$localidad = $config['Localidad'];
$cpostal = $config['CPostal'];
$telefono = $config['Telefono'];
$url_logo = !empty($config['Imagen']) ? URL_GAL . 'config/images/IM_' . $config['Imagen'] : URL_IMG . 'logo.png';
$orden = $data['orden'];
$cliente = $data['cliente'];
?>
<div class="invoice-content">
  <div class="table-responsive">
    <table class="table header-invoice" style="border: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td class="text-left">
            <h3 style="font-size: 26px !important;margin: 0 0 5px 0;padding: 0;letter-spacing: 4px">Encuentra Tu Puesto</h3>
          </td>
          <td class="text-right">
            <h4>Nota de Pedido Nº</h4>
            <h5 class="text-navy">NP-<?php echo Helper::generateNroPedido(date('ymd')); ?>
              -<?php echo Helper::generateNroPedido($orden['ID'], 3); ?></h5>
          </td>
        </tr>
        <tr>
          <td colspan="2" height="10"></td>
        </tr>
        <tr>
          <td class="text-left">
            <address>
              <strong><?php echo $nombre_sitio; ?></strong><br>
              <?php echo $direccion; ?><br>
              <?php echo $localidad . ', CP. ' . $cpostal; ?><br>
              <strong>Telef:</strong> <?php echo $telefono; ?>
            </address>
          </td>
          <td class="text-right">
            <address>
              <strong><?php echo $cliente['Nombre']; ?></strong><br>
              <?php echo $cliente['Direccion']; ?><br>
              <?php echo $cliente['Departamento']; ?>, CP. <?php echo $cliente['CPostal']; ?><br>
              <strong>Telef:</strong> <?php echo $cliente['Celular']; ?>
            </address>
          </td>
        </tr>
        <tr>
          <td></td>
          <td class="text-right">
            <p>
              <span><strong>Fecha de Creación:</strong> <?php echo Helper::dateTimeFormat($orden['TimeCreate'], 'd/m/Y'); ?></span><br />
              <span><strong>Fecha de Vencimiento:</strong> <?php echo Helper::calculateDate($orden['TimeCreate'], 5); ?></span>
            </p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="table-responsive m-t">
    <table class="table invoice-table" width="100%">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        if (count($data['detalle']) > 0) :
          foreach ($data['detalle'] as $item) :
            $subtotal = $item['Precio'] * $item['Cantidad'];
            $precio = Helper::moneyFormat($item['Precio']);
            $total += $subtotal;
        ?>
            <tr>
              <td>
                <div class="product-invoice text-left">
                  <p>
                    <?php echo $item['Producto']; ?>
                    <!--small>- <?php echo $item['Marca']; ?></small-->
                  </p>
                </div>
              </td>
              <td><?php echo $item['Cantidad']; ?></td>
              <td>$ <?php echo $precio; ?></td>
              <td>$ <?php echo Helper::moneyFormat($subtotal); ?></td>
            </tr>
        <?php
          endforeach;
        endif;
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4" height="10"></td>
        </tr>
        <tr>
          <td colspan="3" class="bg-gris text-right"><strong>Sub Total :</strong></td>
          <td class="text-right">$ <?php echo Helper::moneyFormat($total); ?></td>
        </tr>
        <tr>
          <td colspan="3" class="bg-gris text-right"><strong>Descuento :</strong></td>
          <td class="text-right">$ 0.00</td>
        </tr>
        <tr class="border-bottom-gris">
          <td colspan="3" class="bg-gris text-right"><strong>TOTAL :</strong></td>
          <td class="text-right">$ <?php echo Helper::moneyFormat($total); ?></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>