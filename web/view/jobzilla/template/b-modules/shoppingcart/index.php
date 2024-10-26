<div id="content" role="main">
  <div class="page-header dark larger larger-desc m40">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Carrito de Compras</h1>
        </div><!-- End .col-md-6 -->
      </div><!-- End .row -->
    </div><!-- End .container -->
  </div><!-- End .page-header -->

  <div class="container">
    <div class="row">
      <?php
      if (isset($data['listProducts']) && is_array($data['listProducts']) && count($data['listProducts']) > 0) :
        $count = count($data['listProducts']);
        ?>
        <div class="col-md-9">
          <form id="form-product" method="post">            
            <div class="table-responsive">
              <table class="table cart-table cart-table2 no-bg">
                <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                  $i = 1;
                  foreach ($data['listProducts'] as $item) :
                    $thumb = URL_GAL . 'productos/thumbs/TH_' . $item['image'];
                    $url = URL_WEB . 'producto/' . $item['id'] . '/' . $item['url'];
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    ?>
                    <tr>
                      <td>
                        <figure>
                          <a href="<?php echo $url; ?>" title="<?php echo $item['name']; ?>">
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $item['name']; ?>" width="80">
                          </a>
                        </figure>
                      </td>
                      <td>
                        <div class="product clearfix">
                          <div class="product-meta">
                            <h2 class="product-title">
                              <a href="<?php echo $url; ?>" title="<?php echo $item['name']; ?>"><?php echo $item['name']; ?></a>
                            </h2>
                          </div><!-- End .product-meta -->
                        </div><!-- End .product -->
                      </td>
                      <td class="price-col">
                        $ <?php echo Helper::moneyFormat($item['price']); ?>
                      </td>
                      <td class="">
                        <div class="product-quantity">
                          <input type="number" id="productQty<?php echo $i; ?>" value="<?php echo $item['quantity']; ?>" min="1" max="1000" class="horizontal-spinner">
                        </div><!-- End .product-quantity -->
                      </td>
                      <td class="price-col">
                        $ <?php echo Helper::moneyFormat($subtotal); ?>
                      </td>
                      <td>
                        <a href="javascript:updateShopCart('productQty<?php echo $i; ?>',<?php echo $item['id']; ?>);" class="text-size-18 btn btn-custom btn-sm m-bottom-5" title="Actualizar Cantidad">
                          <i class="fa fa-history"></i>
                        </a>
                        <a href="javascript:removeShopCart(<?php echo $item['id']; ?>);" class="text-size-18 btn btn-danger btn-sm" title="Eliminar Producto">
                          <i class="fa fa-trash-o"></i>
                        </a>
                      </td>
                    </tr>
                    <?php
                    $i++;
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div><!-- End .table-responsive -->
          </form>
        </div><!-- End .col-md-9 -->

        <div class="col-md-3">
          <div class="cart-discount-container">
            <h3 class="h4 title-underblock mb30 custom">
              &iquest;Tenés un descuento?
            </h3>
            <form action="#">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Código">
              </div><!-- form-group -->
              <div class="text-right">
                <input type="submit" class="btn btn-dark" value="Aplicar">     
              </div>
            </form>
          </div><!-- End .cart-discount-container -->
          <div class="shop-continue-box">
            <div class="subtotal-row">
              <span>Subtotal:</span> $ <?php echo Helper::moneyFormat($total); ?>
            </div>
            <div class="subtotal-row">
              <span>Descuento:</span> $ 0.00
            </div>
            <div class="grandtotal-row"><span>Total General:</span> 
              <span class="color-red">$ <?php echo Helper::moneyFormat($total); ?></span>
            </div>
            <a href="<?php echo URL_WEB . 'checkout'; ?>" class="btn btn-custom2 btn-block text-uppercase">Confirmar Pedido</a>
            <a href="<?php echo URL_WEB; ?>" class="btn btn-dark btn-block">Continuar Comprando</a>
          </div><!-- End .shop-continue-box -->
        </div><!-- End .col-md-3-->
        <?php
      else :
        ?>
        <div class="col-md-12 mt40">
          <p class="text-center">No seleccionó su Plan de Subscripción!</p>
        </div>
      <?php
      endif;
      ?>
    </div><!-- End .row -->
  </div><!-- End .container -->
</div><!-- End #content -->