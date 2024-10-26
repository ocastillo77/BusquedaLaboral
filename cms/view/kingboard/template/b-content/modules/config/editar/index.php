<!-- BEGIN TABS NAVS -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab_general">General</a></li>
  <li><a href="#tab_direccion">Dirección</a></li>
  <li><a href="#tab_smtp">SMTP</a></li>
  <li><a href="#tab_meta">Metatags</a></li>
  <li><a href="#tab_codigo">Analytics</a></li>
</ul>
<form id="form" method="post">
  <input type="hidden" name="actualizar" value="1" />
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab_general">
      <?php include('tab-general.php'); ?>
    </div>    
    <div class="clear"></div>   
    <div class="tab-pane fade in" id="tab_direccion">
      <?php include('tab-direccion.php'); ?>
    </div> 
    <div class="clear"></div>
    <div class="tab-pane fade in" id="tab_smtp">
      <?php include('tab-smtp.php'); ?>
    </div> 
    <div class="clear"></div>
    <div class="tab-pane fade in" id="tab_meta">
      <?php include('tab-meta.php'); ?>
    </div> 
    <div class="clear"></div>   
    <div class="tab-pane fade in" id="tab_codigo">
      <?php include('tab-codigo.php'); ?>
    </div> 
    <div class="clear"></div>
  </div>	
  <div class="top-actions">
    <a onclick="validate(1);" class="btn btn-primary">Guardar</a>
    <a href="<?php echo URL_CMS . $data['base_url'] . 'editar/1'; ?>" class="btn btn-warning">Cancelar</a>
  </div>	
  <div class="clear"></div>	
</form>
<script type="text/javascript">
<!--//
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
//-->
</script>