<!-- BEGIN TABS NAVS -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab_general" data-toggle="tab">General</a></li>
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
<!-- END TABS NAVS -->
<div id="pop-video" class="videoline">
  <div class="f-content">
    <p><strong>Ingrese la direcci&oacute;n de su video de Youtube:</strong></p>
    <span class="mini-text">Ejemplo: http://www.youtube.com/watch?v=oeZtenPCLVg</span>			
  </div>
  <div class="controls">
    <input type="text" class="w390" id="url-video" />
  </div>
  <div class="f-button">
    <a id="submit" onclick="addUrlYoutube('video');" class="btn btn-primary">
      <i class="icon icon-white icon-plus"></i> Agregar</a>
  </div>
</div>
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }
</script>