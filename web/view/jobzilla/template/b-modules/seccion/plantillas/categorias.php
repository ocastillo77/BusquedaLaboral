<?php
$categorias = isset($data['list_cat']) ? $data['list_cat'] : array();
?>
<section class="clearfix mb-4">
  <div class="container">
    <div class="page-header text-center">
      <h2>Busca a través de nuestras categorías</h2>
    </div>
    <div class="row">
      <?php
      if (isset($categorias) && count($categorias) > 0) :
        foreach ($categorias as $cat) :
          ?>
          <div class="col-sm-4 col-xs-12">
            <div class="category-card card">
              <ul>
                <?php
                foreach ($cat as $item) :
                  $url = (!empty($item['URL'])) ? URL_WEB . 'categorias/' . $item['URL'] : '#';
                  ?>
                  <li>
                    <a href="<?php echo $url; ?>"><i class="fa fa-chevron-right"></i> <?php echo $item['Nombre']; ?></a>
                  </li>
                  <?php
                endforeach;
                ?>
              </ul>
            </div>
          </div>
          <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

