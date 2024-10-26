<div class="top-actions">
  <a onclick="validate(1);" class="btn btn-primary">Publicar</a>
  <a onclick="validate(2);" class="btn btn-info">Borrador</a>
  <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
</div>
<div class="clear"></div>
<ul class="nav nav-tabs">
  <li class="active">
    <a href="#tab_general" data-toggle="tab">General</a>
  </li>
  <li><a href="#tab_parrafo">P&aacute;rrafos</a></li>
  <li><a href="#tab_meta">Metatags</a></li>
  <li><a href="#tab_galeria">Galer&iacute;a</a></li>
</ul>
<form id="form" method="post">
  <input type="hidden" name="actualizar" value="1" />
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab_general">
      <?php include('tab-general.php'); ?>
    </div>    
    <div class="clear"></div>    
    <div class="tab-pane fade in" id="tab_parrafo">
      <?php include('tab-parrafo.php'); ?>
    </div>    
    <div class="clear"></div>    
    <div class="tab-pane fade in" id="tab_meta">
      <?php include('tab-meta.php'); ?>	
    </div>    
    <div class="clear"></div>    
    <div class="tab-pane fade in" id="tab_galeria">
      <?php include('tab-galeria.php'); ?>	
    </div>    
    <div class="clear"></div>    
  </div>  
</form>
<div class="top-actions">
  <a onclick="validate(1);" class="btn btn-primary">Publicar</a>
  <a onclick="validate(2);" class="btn btn-info">Borrador</a>
  <a href="<?php echo URL_CMS . $data['base_url'] . 'listar'; ?>" class="btn btn-warning">Cancelar</a>
</div>
<div class="clear"></div>	
<div class="videoline" id="pop-video">
  <div class="box-title">
    <h4>Ingrese la URL del video de Youtube:</h4>
    <span>Ejemplo: http://www.youtube.com/watch?v=oeZtenPCLVg</span>			
  </div>
  <div class="box-input">
    <input type="text" id="url-video" placeholder="Ingrese URL de Youtube">
  </div>
  <div class="box-button">
    <a class="btn btn-primary" onclick="addUrlYoutube('video');" id="submit">
      <i class="icon icon-white icon-plus"></i> Agregar</a>
  </div>
</div>
<script type="text/javascript">
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>