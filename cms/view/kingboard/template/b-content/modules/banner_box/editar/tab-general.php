<?php
$tabla = $data['tabla'];
$width = isset($data['categoria']) ? $data['categoria']['Width'] : 0;
$height = isset($data['categoria']) ? $data['categoria']['Height'] : 0;
?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="titulo"><span class="obligatory">*</span> T&iacute;tulo:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) echo $data[$tabla]['Titulo']; ?>" readonly="true"/>
          <p class="help-block">S&oacute;lo para uso interno</p>
        </div>
      </div>	
      <div class="form-group">
        <label class="control-label">Formato:</label>
        <div class="controls">
          <select id="formato" name="<?php echo $tabla; ?>[Formato]" data-rel="chosen">
            <?php
            $formatos = [1 => 'Imagen', 2 => 'Codigo Google Adsense'];
            foreach ($formatos as $key => $value):
              $selected = ($data[$tabla]['Formato'] == $key) ? 'selected="selected"' : '';
              ?>								
              <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>	
      <div id="control1" class="disnone">
        <div class="form-group">
          <label class="control-label" for="categoria">Categor&iacute;a:</label>
          <div class="controls">
            <select id="categoria" name="<?php echo $tabla; ?>[CategoriaID]" data-rel="chosen">
              <?php
              if (isset($data['categorias']) && count($data['categorias'])) :
                foreach ($data['categorias'] as $item):
                  $selected = $data[$tabla]['CategoriaID'] == $item['ID'] ? 'selected="selected"' : '';
                  ?>								
                  <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                  <?php
                endforeach;
              endif;
              ?>  	
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="imagen">Imagen:</label>
          <div class="controls">
            <div class="content-image">
              <div class="border-overflow">
                <?php
                $thumb = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data[$tabla]['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
                $imagen = (!empty($data[$tabla]['Imagen'])) ? URL_GAL . $data['tabla'] . '/images/IM_' . $data[$tabla]['Imagen'] : '#';
                $class = (!empty($data[$tabla]['Imagen'])) ? 'fancybox' : '';
                ?>
                <input type="hidden" name="<?php echo $tabla; ?>[Imagen]" id="imagen" value="<?php if (isset($data[$tabla]['Imagen'])) echo $data[$tabla]['Imagen']; ?>">
                <a id="gal-imagen" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                  <img src="<?php echo $thumb; ?>" id="img-imagen" />
                </a>
              </div>
            </div>
            <div class="buttons-up">
              <a id="btn-imagen" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>	
              <a id="del-imagen" onclick="deleteImage('imagen')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
              <div id="ldr-imagen" class="loader">
                <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
              </div>
            </div>
            <p id="descimage" class="help-block">Imagen de <?php echo $width . 'x' . $height . 'px'; ?> o proporcional</p>		
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="descripcion">Descripci&oacute;n:</label>
          <div class="controls">
            <textarea id="descripcion" maxlength="300" name="<?php echo $tabla; ?>[Descripcion]" 
                      class="mini-editor form-control" rows="5"><?php if (isset($data[$tabla]['Descripcion'])) echo $data[$tabla]['Descripcion']; ?></textarea>
            <p class="help-block"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label" for="url">Enlace:</label>
          <div class="controls">
            <input type="text" class="form-control" id="url" name="<?php echo $tabla; ?>[URL]" value="<?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?>" />
            <p class="help-block">Colocar la URL completa, por ejemplo: http://www.empresa.com</p>
          </div>
        </div>
      </div>
      <div id="control2" class="disnone">
        <div class="form-group">
          <label class="control-label" for="codigo">C&oacute;digo Google Adsense:</label>
          <div class="controls">
            <textarea id="codigo" name="<?php echo $tabla; ?>[Codigo]" class="form-control" rows="5"><?php if (isset($data[$tabla]['Codigo'])) echo $data[$tabla]['Codigo']; ?></textarea>
            <p class="help-block"></p>
          </div>
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
      <div class="form-group">
        <label class="control-label" for="posicion">Posici&oacute;n:</label>
        <div id="content-pos" class="controls">
          <?php include('mod-posicion.php'); ?>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<?php
$formato = isset($data[$tabla]['Formato']) ? $data[$tabla]['Formato'] : 1;
$urlId = isset($data[$tabla]['ID']) ? $data[$tabla]['ID'] . '/' : '';
$urlChange = URL_CMS . $data['base_url'] . 'select/' . $urlId;
?>
<script>
  var item = <?php echo $formato; ?>;
  $('#control' + item).show();

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

  $('#formato').change(function () {
    var id = $('#formato option:selected').val();
    $('#control1').hide();
    $('#control2').hide();
    showhide('control' + id);
  });

  function changeCategoria() {
    var text = $('#categoria option:selected').text();
    $('#descimage').html(text + ' o proporcional');
  }

  $('#categoria').change(function () {
    changeCategoria();

    var categoria = $('#categoria option:selected').val();
    var formData = {categoria: categoria};

    $.ajax({
      url: "<?php echo $urlChange; ?>",
      type: 'POST',
      data: formData,
      success: function (data) {
        $('#sortable').remove();
        $('#content-pos').html(data);
      }
    });
  });

  changeCategoria();

  function deleteImage(code) {
    delImage(code,
      "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
      "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|jpeg|JPEG|JPG|png)$/);
  uploadImage('imagen', checkExt,
    "<?php echo URL_CMS . $data['base_url'] . 'upload/'; ?>",
    "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>", 'categoria');

  setTimeout(function () {
    set_minieditor('descripcion');
  }, 1000);
</script>