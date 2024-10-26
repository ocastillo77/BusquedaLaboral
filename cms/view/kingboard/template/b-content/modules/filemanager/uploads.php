<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>    
      </div>
      <div class="widget-content">
        <div class="top-actions">
          <button id="upgalery" type="button" class="btn btn-info btn-md"><i class="fa fa-search"></i> Seleccionar Im&aacute;genes</button>
          <button id="upgalery_now" type="button" class="btn btn-primary btn-md"><i class="fa fa-upload"></i> Iniciar Subida</button>
          <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Volver</a>
        </div>
        <div class="clear"></div>
        <?php include('uploads/index.php'); ?>
        <div class="clear"></div>
      </div>
    </div><!--/widget-->
  </div><!--/col-md-12-->
</div><!--/row-->