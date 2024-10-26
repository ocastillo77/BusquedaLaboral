<form id="paginator" method="get">
  <input type="hidden" name="key" value="<?php echo isset($data['key']) ? $data['key'] : ''; ?>" />
  <input type="hidden" name="fil" value="<?php echo isset($data['fil']) ? $data['fil'] : ''; ?>" />
  <input type="hidden" id="orden" name="orden" value="<?php echo isset($data['orden']) ? $data['orden'] : ''; ?>" />
  <input type="hidden" id="page" name="page" value="1" />
</form>
<!-- Start page content -->
<div id="content" role="main">
  <!-- BREADCRUMBS SETCTION START -->
  <div class="page-header dark larger larger-desc">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="text-center">Categoría: <?php echo $data['info']['Nombre']; ?></h1>
        </div><!-- End .col-md-6 -->
      </div><!-- End .row -->
    </div><!-- End .container -->
  </div><!-- End .page-header -->
  <!-- BREADCRUMBS SETCTION END -->

  <div id="menu-category" class="bg-base hidden-lg hidden-md visible-sm visible-xs">
    <div class="container">
      <div class="row m-bottom-20">
        <div class="col-sm-6 col-xs-6">
          <div class="dropdown filters filter-1">
            <select onchange="sendUrl(this.value);" class="form-control">
              <?php
              foreach ($data['categorias'] as $item) :
                $url = URL_WEB . 'cateprod/' . $item['URL'];
                ?>
                <option value="<?php echo $url; ?>"><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
              ?>
            </select>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6">
          <div class="dropdown filters filter-2 pull-right">
            <select onchange="sendUrl(this.value);" class="form-control">
              <?php
              foreach ($data['marcas'] as $item) :
                $url = URL_WEB . 'marca/' . $item['URL'];
                ?>
                <option value="<?php echo $url; ?>"><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SHOP SECTION START -->
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <?php
        include 'mod-list.php';
        ?>
      </div>
      <div class="mb30 visible-sm visible-xs"></div><!-- space -->
      <aside class="col-md-3 col-md-pull-9 sidebar">
        <?php
        include 'mod-aside.php';
        ?>
      </aside>
    </div>
  </div>
  <!-- SHOP SECTION END -->
</div>
<!-- End page content -->
