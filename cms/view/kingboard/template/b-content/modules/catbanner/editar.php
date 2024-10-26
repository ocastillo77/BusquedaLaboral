<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>    
      </div>
      <div class="widget-content">
        <div id="message" class="<?php echo (isset($data['error']['class'])) ? $data['error']['class'] : ''; ?>">
          <?php echo (isset($data['error']['message'])) ? $data['error']['message'] : ''; ?>
        </div>
        <?php include('editar/index.php'); ?>
      </div>
    </div><!--/widget-->
  </div><!--/col-md-12-->
</div><!--/row-->