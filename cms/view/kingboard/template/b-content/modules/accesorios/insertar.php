<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>    
      </div>
      <div class="widget-content">        
        <div class="top-actions">
          <a onclick="validate(1);" class="btn btn-primary">Publicar</a>
          <a onclick="validate(2);" class="btn btn-info">Borrador</a>
          <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
        </div>
        <div class="clear"></div>
        <?php include('editar/index.php'); ?>
        <div class="top-actions">
          <a onclick="validate(1);" class="btn btn-primary">Publicar</a>
          <a onclick="validate(2);" class="btn btn-info">Borrador</a>
          <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
        </div>
        <div class="clear"></div>    
      </div>
    </div><!--/widget-->
  </div><!--/col-md-12-->
</div><!--/row-->