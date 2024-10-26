<?php
$item = $data['orden'];
?>
<div class="ibox">
  <div class="ibox-content">
    <h4 class="subtitle m-bottom-30"><?php echo $item['Nombre']; ?></h4>
    <div class="row">
      <div class="col-lg-6">
        <dl class="row mb-0">
          <div class="col-sm-4 text-sm-right">
            <dt>Estado:</dt>
          </div>
          <div class="col-sm-8 text-sm-left">
            <dd class="mb-1"><?php echo Helper::stateOrder($item['Publico']); ?></dd>
          </div>
        </dl>
        <dl class="row mb-0">
          <div class="col-sm-4 text-sm-right">
            <dt>Cliente:</dt>
          </div>
          <div class="col-sm-8 text-sm-left">
            <dd class="mb-1"><?php echo Session::get('wb_name'); ?></dd>
          </div>
        </dl>
      </div>
      <div class="col-lg-6" id="cluster_info">
        <dl class="row mb-0">
          <div class="col-sm-4 text-sm-right">
            <dt>Fecha:</dt>
          </div>
          <div class="col-sm-8 text-sm-left">
            <dd class="mb-1"><?php echo Helper::dateTimeFormat($item['TimeCreate']); ?></dd>
          </div>
        </dl>
        <dl class="row mb-0">
          <div class="col-sm-4 text-sm-right">
            <dt>Total Venta:</dt>
          </div>
          <div class="col-sm-8 text-sm-left">
            <dd class="mb-1">$ <?php echo $item['TotalVenta']; ?></dd>
          </div>
        </dl>
      </div>
    </div>
    <div class="row">      
      <div class="col-md-12">
        <h4 class="subtitle m-top-30 m-bottom-30">
          Detalle de la Venta
          <a href="<?php echo URL_WEB . 'account/invoice/' . $data['ordenId']; ?>" 
             class="btn btn-danger btn-xs pos-right">Ver Comprobante</a>
        </h4>
        <div class="table-responsive">
          <table class="table invoice-table">
            <thead>
              <tr>
                <th>Imagen</th>
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
                  $thumb = URL_GAL . 'productos/thumbs/TH_' . $item['Imagen'];
                  $url = URL_WEB . 'producto/' . $item['ID'] . '/' . $item['URL'];
                  $subtotal = $item['Precio'] * $item['Cantidad'];
                  $total += $subtotal;
                  ?>
                  <tr>
                    <td>
                      <figure>
                        <a href="<?php echo $url; ?>" title="<?php echo $item['Producto']; ?>">
                          <img src="<?php echo $thumb; ?>" 
                               alt="<?php echo $item['Producto']; ?>" height="80">
                        </a>
                      </figure>
                    </td>
                    <td>
                      <div class="product-invoice text-left">
                        <p>
                          <a href="<?php echo $url; ?>"><?php echo $item['Producto']; ?></a>
                        </p>
                        <small class="color-red"><strong>Marca: </strong><?php echo $item['Marca']; ?></small>
                      </div>              
                    </td>
                    <td><?php echo $item['Cantidad']; ?></td>
                    <td>$ <?php echo Helper::moneyFormat($item['Precio']); ?></td>
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
              <td><strong>SubTotal :</strong></td>
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
      </div>
    </div>
  </div>
</div>
