<?php
$config = $data['config'];
$sitename = $config['Nombre'];
$direccion = $config['Direccion'];
$localidad = $config['Localidad'];
$cpostal = $config['CPostal'];
$telefono = $config['Telefono'];
$cuit = $config['CUIT'];
$url_logo = !empty($config['Imagen']) ? URL_GAL . 'config/images/IM_' . $config['Imagen'] : URL_IMG . 'logo.png';
$url_web = $config['Website'];
$orden = $data['orden'];
$cliente = $data['cliente'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
    }

    .header-invoice h3,
    .header-invoice h4,
    .header-invoice h5,
    .header-invoice p {
      margin: 0;
      padding: 0;
    }

    h3 {
      font-size: 26px;
      letter-spacing: 4px;
    }

    h4 {
      font-size: 20px;
    }

    h5 {
      font-size: 16px;
      color: #333;
    }

    .header-invoice h4 {
      margin-bottom: 5px;
    }

    .header-invoice h5 {
      margin-bottom: 10px;
    }

    .logo,
    .invoice-code {
      background-color: #FFC600;
      color: #fff;
      padding: 20px;
    }

    address {
      font-size: 14px;
      line-height: 1.5;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .invoice-table th,
    .invoice-table td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    .invoice-table th {
      text-align: center;
    }

    .table th {
      background-color: #f4f4f4;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    .bg-gris {
      background-color: #f4f4f4;
    }

    .m-t {
      margin-top: 20px;
    }

    .product-invoice p {
      margin: 0;
    }

    .border-bottom-gris {
      border-bottom: 2px solid #ddd;
    }

    .invoice-table td {
      padding: 10px;
    }

    .invoice-table tfoot td {
      font-weight: bold;
    }

    .text-navy {
      color: #fff;
      font-size: 1.5rem;
    }

    .text-date {
      font-size: 1rem;
      font-weight: bold;
    }

    .space {
      padding: 20px;
    }
  </style>
</head>

<body>

  <table class="table header-invoice" style="border: 0;">
    <tbody>
      <tr>
        <td class="text-left logo">
          <img src="<?php echo $url_logo; ?>" alt="<?php echo $sitename; ?>" data-default="placeholder" border="0">
        </td>
        <td class="text-right invoice-code">
          <h4>Nota de Pedido</h4>
          <h5 class="text-navy">Nº 00240918-001</h5>
          <p class="text-date">Fecha Emisión: 28/08/2024</p>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="space"></td>
      </tr>
      <tr>
        <td class="text-left">
          <address>
            <p><strong><?php echo $sitename; ?></strong></p>
            <p><strong>Domicilio Comercial: </strong><?php echo $direccion; ?></p>
            <p><?php echo $localidad . ', Mendoza'; ?></p>
            <p><strong>CUIT:</strong> <?php echo $cuit; ?></p>
          </address>
        </td>
        <td class="text-right">
          <address>
            <p><strong>Cliente: </strong><?php echo $cliente['Nombre']; ?></p>
            <p><strong>Dirección: </strong><?php echo $cliente['Direccion']; ?></p>
            <p><?php echo $cliente['Departamento']; ?>, Mendoza</p>
            <p><strong>DNI:</strong> <?php echo $cliente['DNI']; ?></p>
          </address>
        </td>
      </tr>
    </tbody>
  </table>

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
        $total = 0;
        if (!empty($data['detalle'])) :
          foreach ($data['detalle'] as $item) :
            $subtotal = $item['Precio'] * $item['Cantidad'];
            $precio = Helper::moneyFormat($item['Precio']);
            $total += $subtotal;
        ?>
            <tr>
              <td>
                <div class="product-invoice text-left">
                  <p><?php echo $item['Plan']; ?></p>
                </div>
              </td>
              <td class="text-center"><?php echo $item['Cantidad']; ?></td>
              <td class="text-right">$ <?php echo $precio; ?></td>
              <td class="text-right">$ <?php echo Helper::moneyFormat($subtotal); ?></td>
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

</body>

</html>