<div class="widget">
  <h4 class="panel-title border-top-bottom">
    Categorías
  </h4>
  <?php echo $data['menu_cat']; ?>
</div><!-- End .widget -->
<?php if (isset($data['marcas'])) : ?>
  <div class="panel panel-border-tb">
    <div class="panel-heading" role="tab" id="brandFilter-header">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#brandFilter" aria-expanded="true" aria-controls="brandFilter">
          Marcas
          <span class="panel-icon"></span>
        </a>
      </h4>
    </div><!-- End .panel-heading -->
    <div id="brandFilter" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="brandFilter-header">
      <div class="panel-body">
        <ul class="filter-brand-list">
          <?php
          foreach ($data['marcas'] as $item) :
            $url = URL_WEB . 'marca/' . $item['URL'];
            ?>
            <li>
              <a href="<?php echo $url; ?>">
                <i class="fa fa-angle-right"></i> <?php echo $item['Nombre']; ?>
              </a>
            </li>
            <?php
          endforeach;
          ?>
        </ul>
      </div><!-- End .panel-body -->
    </div><!-- End .panel-collapse -->
  </div><!-- End .panel -->
  <?php
endif;

include 'mod-recientes.php';
