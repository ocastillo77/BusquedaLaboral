<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Factura</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            background-image: url('img/header3.png');
            background-repeat: no-repeat;
            background-size: 70% auto;
            background-position: top left;
            margin: auto;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .box-content {
            padding-top: 160px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .box-factura {
            position: absolute;
            right: 40px;
            top: 40px;
            display: inline-block;
            border: 2px solid #333;
            text-align: left;
            vertical-align: middle;
            padding: 10px 15px;
        }

        .box-barcode {
            width: 190px;
            position: absolute;
            bottom: 30px;
            left: 40px;
        }

        .box-qrcode {
            position: absolute;
            bottom: 40px;
            right: 40px;
            border: 2px solid #333;
            padding: 3px;
        }
    </style>
</head>

<body>
    <div class="box-factura">
        <span style="font-size:19px;"><strong>RUC:</strong> <?php echo $rucEmpresa; ?></span><br />
        <strong style="font-size:20px;text-transform:uppercase;">Boleta de Venta</strong><br />
        <div style="font-size:20px; text-align: center">Nro. <?php echo $numeroPedido1 . ' - ' . $numeroPedido2; ?></div>
    </div>
    <div class="invoice-box">
        <div class="box-content">
            <table>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <strong><?php echo $nombre_sitio; ?></strong><br />
                                    <?php echo $direccion; ?>, Tumbes<br />
                                    <strong>Telef:</strong> <?php echo $telefono; ?><br>
                                </td>
                                <td>
                                    <div style="font-size:14px; text-align: left"><strong>Fecha de Emisión:</strong> <?php echo $fecha_factura; ?></div>
                                    <div><strong>Cliente:</strong> <?php echo $nombre_paciente; ?></div>
                                    <?php if (!empty($dni_paciente)) : ?>
                                        <div><strong>DNI:</strong> <?php echo $dni_paciente; ?></div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px 10px 30px 10px">
                        <table>
                            <tr class="heading">
                                <td class="text-center">Producto / Servicio</td>
                                <td class="text-center">Cantidad</td>
                                <td class="text-right">Precio</td>
                                <td class="text-right">Subtotal</td>
                            </tr>
                            <?php
                            $total = 0;
                            while ($row_detalle = _fetch_array($query_detalle)) :
                                $subtotal = $row_detalle['precio'] * $row_detalle['cantidad'];
                                $precio = ($row_detalle['precio']);
                                $id_servicio = $row_detalle['id_servicio'];
                                $id_serviciodet = $row_detalle['id_serviciodet'];
                                $total += $subtotal;

                                $sql_serviciodet = "SELECT * FROM servicio WHERE id_servicio = '$id_serviciodet'";
                                $query_serviciodet = _query($sql_serviciodet);
                                $row_serviciodet = _fetch_array($query_serviciodet);

                                $tabla = $row_serviciodet['tabla'];
                                $id_categoria = $row_serviciodet['id_categoria'];
                                $nombre_serviciodet = $row_serviciodet['descripcion'];

                                if (!empty($tabla)) {
                                    if (in_array($id_serviciodet, [7, 8])) {
                                        $sql1 = "SELECT * FROM " . $tabla . " WHERE id='$id_servicio'";
                                        $result = _query($sql1);
                                        $row1 = _fetch_array($result);
                                        $nombre_servicio = $row1["nombre"];
                                    } else {
                                        $sql1 = "SELECT * FROM " . $tabla . " WHERE id_" . $tabla . "='$id_servicio'";
                                        $result = _query($sql1);
                                        $row_servicio = _fetch_array($result);
                                        $extra = $tabla == 'medicamento' ? ' - ' . $row_servicio["presentacion"] . ' - ' . $row_servicio["concentracion"] . ' - ' . $row_servicio["forma"] : '';
                                        $nombre_servicio = $row_servicio["descripcion"] . $extra;
                                    }
                                }
                            ?>
                                <tr style="border-bottom: 1px solid #ddd;">
                                    <td>
                                        <div style="font-size: 12px;"><?php echo $nombre_serviciodet; ?></div>
                                        <div style="font-size: 13px;"><?php echo strtoupper(utf8_decode($nombre_servicio)); ?></div>
                                    </td>
                                    <td class="text-right"><?php echo $row_detalle['cantidad']; ?></td>
                                    <td class="text-right"><?php echo $simbolo . number_format($precio, 2, '.', ''); ?></td>
                                    <td class="text-right"><?php echo $simbolo . number_format($subtotal, 2, '.', ''); ?></td>
                                </tr>
                            <?php
                            endwhile;

                            $totalIGV = $igv == 1 ? round($total * (18 / 100), 2) : 0;
                            $totalGen = $total + $totalIGV;
                            ?>
                            <tr class="heading">
                                <td colspan="3" class="text-right">Subtotal</td>
                                <td class="text-right"><?php echo $simbolo . number_format($total, 2, '.', ''); ?></td>
                            </tr>
                            <?php if ($igv == 1) : ?>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>IGV (18%) :</strong></td>
                                    <td class="text-right"><?php echo $simbolo . number_format($totalIGV, 2, ".", ""); ?> </td>
                                </tr>
                            <?php endif; ?>
                            <tr class="heading">
                                <td colspan="3" class="text-right"><strong>TOTAL :</strong></td>
                                <td class="text-right"><?php echo $simbolo . number_format($totalGen, 2, '.', ''); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="box-barcode">
        <img src="<?php echo $barcode; ?>" alt="Código de Barras" /><br />
        <div style="font-size:12px;text-align:center"><?php echo $numeroPedido1 . ' - ' . $numeroPedido2; ?></div>
    </div>
    <div class="box-qrcode">
        <img src="<?php echo $qrcode; ?>" alt="Código QR" height="70" />
    </div>
</body>

</html>