<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" 
       value="<?php echo isset($data[$tabla]['Publico']) ? $data[$tabla]['Publico'] : ''; ?>">
<div class="col-md-12">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Orden de Compra</h3>
    </div>
    <div class="widget-content bg-white">
      <div class="row">
        <div class="col-md-6">
          <div class="row controls-show">
            <div class="col-md-3">
              <strong>Estado: </strong>          
            </div>
            <div class="col-md-9">
              <span><?php echo Helper::stateOrder($data[$tabla]['Publico']); ?></span>
            </div>
          </div>
          <div class="row controls-show">
            <div class="col-md-3">
              <strong>Nombre: </strong>          
            </div>
            <div class="col-md-9">
              <span><?php echo $data[$tabla]['Nombre']; ?></span>
            </div>
          </div>
          <div class="row controls-show">
            <div class="col-md-3">
              <strong>Cliente: </strong>          
            </div>
            <div class="col-md-9">
              <a onclick="$('#myModal').modal('show');" class="btn-link"><?php echo $data[$tabla]['Usuario']; ?></a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row controls-show">
            <div class="col-md-3">
              <strong>Fecha Venta: </strong>          
            </div>
            <div class="col-md-9">
              <span><?php echo Helper::dateTimeFormat($data[$tabla]['TimeCreate']); ?></span>
            </div>
          </div>
          <div class="row controls-show">
            <div class="col-md-3">
              <strong>Archivo: </strong>          
            </div>
            <div class="col-md-9">
              <?php $url_pdf = !empty($data[$tabla]['Archivo']) ? URL_PDF . $data[$tabla]['Archivo'] : ''; ?>
              <a href="<?php echo $url_pdf; ?>" class="btn-link" target="_blank">Descargar PDF</a>
            </div>
          </div>
          <div class="row controls-show">
            <div class="col-md-3">
              <strong>Total Venta: </strong>          
            </div>
            <div class="col-md-9">
              <span>$ <?php echo Helper::moneyFormat($data[$tabla]['TotalVenta']); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Detalle de la Compra</h3>
    </div>
    <div class="widget-content bg-white">
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="odd">            
            <th class="text-center">Imagen</th>
            <th class="text-center">Producto</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Precio</th>
            <th class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (count($data['detalle']) > 0) :
            $total = 0;
            foreach ($data['detalle'] as $item) :
              $thumb = URL_GAL . 'productos/thumbs/TH_' . $item['Imagen'];
              $url = URL_WEB . 'producto/' . $item['ProductoID'] . '/' . $item['URL'];
              $subtotal = $item['Precio'] * $item['Cantidad'];
              $total += $subtotal;
              ?>
              <tr>
                <td class="text-center" width="100">
                  <a href="<?php echo $url; ?>" title="<?php echo $item['Producto']; ?>" target="_blank">
                    <img src="<?php echo $thumb; ?>" 
                         alt="<?php echo $item['Producto']; ?>">
                  </a>
                </td>
                <td>
                  <div class="product-invoice text-left">
                    <p>
                      <a href="<?php echo $url; ?>" target="_blank"><?php echo $item['Producto']; ?></a>
                    </p>
                    <small class="color-red"><strong>Marca: </strong><?php echo $item['Marca']; ?></small>
                  </div>              
                </td>
                <td class="text-center"><?php echo $item['Cantidad']; ?></td>
                <td class="text-center">$ <?php echo Helper::moneyFormat($item['Precio']); ?></td>
                <td class="text-right">$ <?php echo Helper::moneyFormat($subtotal); ?></td>
              </tr>
              <?php
            endforeach;
          endif;
          ?>
        </tbody>
      </table>
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td colspan="4" class="text-right"><strong>SubTotal :</strong></td>
            <td width="100" class="text-right">$ <?php echo Helper::moneyFormat($total); ?></td>
          </tr>
          <tr>
            <td colspan="4" class="text-right"><strong>Descuento :</strong></td>
            <td width="100" class="text-right">$ 0.00</td>
          </tr>
          <tr>
            <td colspan="4" class="text-right"><strong>TOTAL :</strong></td>
            <td width="100" class="text-right">$ <?php echo Helper::moneyFormat($total); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
