<?php
$tabla = $data['tabla'];
?>
<div class="row">
  <div class="col-md-8">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-info-circle"></i> Contenido</h3>
      </div>
      <div class="widget-content">
        <div class="form-group">
          <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre:</label>
          <div class="controls">
            <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" 
                   value="<?php echo isset($data[$tabla]['Nombre']) ? $data[$tabla]['Nombre'] : 'Carga de Productos CSV - ' . date('d/m/Y H:i'); ?>" />
            <p class="help-block"></p>
          </div>
        </div>    
        <div class="form-group">
          <label class="control-label" for="imagen">Seleccione Archivo CSV:</label>
          <div class="controls">
            <div class="content-image">
              <div class="border-overflow">
                <?php
                $thumb = (!empty($data[$tabla]['Archivo'])) ? CMS_IMG . 'file_download.png' : CMS_IMG . 'file_upload.png';
                $archivo = (!empty($data[$tabla]['Archivo'])) ? URL_GAL . $tabla . '/files/CSV_' . $data[$tabla]['Archivo'] : '';
                $link = (!empty($data[$tabla]['Archivo'])) ? URL_GAL . $tabla . '/files/' . $data[$tabla]['Archivo'] : 'javascript:;';
                ?>
                <input type="hidden" name="<?php echo $tabla; ?>[Archivo]" id="archivo">
                <a id="gal-archivo" href="<?php echo $link; ?>">
                  <img src="<?php echo $thumb; ?>" id="img-archivo" />
                </a>
              </div>
            </div>
            <div class="buttons-up">
              <a id="btn-archivo" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Subir Archivo</a>	
              <a id="del-archivo" onclick="deleteFile('archivo')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
              <div id="ldr-archivo" class="loader">
                <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando archivo...</span>
              </div>
            </div>
            <div class="clear"></div>				
          </div>
        </div>      
        <div class="cont-hint">
          <span class="obligatory">*</span>
          <p class="help-block">Los campos son obligatorios</p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
      </div>
      <div class="widget-content">
      </div>
    </div>
  </div>
</div>
<script>
  $('#gal-archivo').click(function (e) {
    if ($(this).attr('href') != 'javascript:;') {
      e.preventDefault();
      window.location.href = $(this).attr('href');
    }
  });

  $(document).ready(function () {
    $('.fancybox').fancybox();
    $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
      openEffect: 'none',
      closeEffect: 'none',
      prevEffect: 'none',
      nextEffect: 'none',
      arrows: false,
      helpers: {
        media: {},
        buttons: {}
      }
    });
  });

  function deleteFile(code) {
    delFile(code,
      "<?php echo CMS_IMG . 'file_upload.png'; ?>",
      "<?php echo URL_CMS . $data['base_url'] . 'delfile'; ?>");
  }

  var checkFile = new RegExp(/^(csv)$/);
  uploadFile('archivo', checkFile,
    "<?php echo URL_CMS . $data['base_url'] . 'upload'; ?>",
    "<?php echo CMS_IMG . 'file_download.png'; ?>");
</script>
