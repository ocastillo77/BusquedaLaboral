<?php
$config = $data['config'];
$direccion = $config['Direccion'];
$localidad = $config['Localidad'];
$cpostal = $config['CPostal'];
$telefono = $config['Telefono'];
$orden = $data['orden'];
$cliente = $data['cliente'];
?>
<div class="top-buttons text-right">
  <a href="<?php echo URL_WEB . 'account/print/' . $data['ordenId']; ?>" target="_blank" class="btn btn-dark btn-sm text-uppercase">Imprimir</a>
  <a href="<?php echo URL_WEB . 'download/' . $data['ordenId']; ?>" class="btn btn-custom btn-sm text-uppercase">Descargar</a>
</div>
<div id="invoice-content" class="wrapper wrapper-content p-xl">
  <div class="ibox-content p-xl">
    <div class="row">
      <div class="col-sm-6">
        <div class="logo">
          <img src="<?php echo $url_logo; ?>" alt="<?php echo $nombre_sitio; ?>"/>
        </div>        
        <address>
          <strong><?php echo $nombre_sitio; ?></strong><br>
          <?php echo $direccion; ?><br>
          <?php echo $localidad . ', CP. ' . $cpostal; ?><br>
          <strong>Telef:</strong> <?php echo $telefono; ?>
        </address>
      </div>

      <div class="col-sm-6 text-right m-top-10">
        <h4>Nota de Pedido Nº</h4>
        <h5 class="text-navy">NP-<?php echo Helper::generateNroPedido(date('ymd')); ?>
          -<?php echo Helper::generateNroPedido($orden['ID'], 3); ?></h5>
        <span class="small-customer">Cliente:</span>
        <address>
          <strong><?php echo $cliente['Nombre']; ?></strong><br>
          <?php echo $cliente['Direccion']; ?><br>
          <?php echo $cliente['Departamento']; ?>, CP. <?php echo $cliente['CPostal']; ?><br>
          <strong>Telef:</strong> <?php echo $cliente['Celular']; ?>
        </address>
        <p>
          <span><strong>Fecha de Creación:</strong> <?php echo Helper::dateTimeFormat($orden['TimeCreate'], 'd/m/Y'); ?></span><br/>
          <span><strong>Fecha de Vencimiento:</strong> <?php echo Helper::calculateDate($orden['TimeCreate'], 5); ?></span>
        </p>
      </div>
    </div>

    <div class="table-responsive m-t">
      <table class="table invoice-table">
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
          if (count($data['detalle']) > 0) :
            $total = 0;
            foreach ($data['detalle'] as $item) :
              $subtotal = $item['Precio'] * $item['Cantidad'];
              $precio = Helper::moneyFormat($item['Precio']);
              $total += $subtotal;
              ?>
              <tr>
                <td>
                  <div class="product-invoice text-left">
                    <p><?php echo $item['Producto']; ?></p>
                    <small><strong>Marca: </strong><?php echo $item['Marca']; ?></small>
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
      </table>
    </div><!-- /table-responsive -->

    <table class="table invoice-total">
      <tbody>
        <tr>
          <td><strong>Sub Total :</strong></td>
          <td>$ <?php echo Helper::moneyFormat($total); ?></td>
        </tr>
        <tr>
          <td><strong>Descuento :</strong></td>
          <td>$ 0.00</td>
        </tr>
        <tr>
          <td><strong>TOTAL :</strong></td>
          <td>$ <?php echo Helper::moneyFormat($total); ?></td>
        </tr>
      </tbody>
    </table>
    <div class="well m-t"><strong>Importante: </strong>
      Este comprobante no es válido como Factura. Una vez realizado y verificado el pago; 
      se le enviará a su correo electrónico el documento PDF de la Factura de su compra.
    </div>
  </div>

</div>