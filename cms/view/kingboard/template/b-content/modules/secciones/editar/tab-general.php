<?php $tabla = $data['tabla']; ?>
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
          <input type="text" class="form-control" id="titulo" name="<?php echo $tabla; ?>[Titulo]" value="<?php if (isset($data[$tabla]['Titulo'])) echo $data[$tabla]['Titulo']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="meta-url"><span class="obligatory">*</span> Enlace Permanente:</label>
        <div class="controls">
          <input type="text" class="form-control" id="meta-url" name="<?php echo $tabla; ?>[URL]" value="<?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?>" />
          <p class="help-block">Su enlace se vera en: <?php echo URL_WEB . 'seccion/'; ?><strong id="friendly-url"><?php if (isset($data[$tabla]['URL'])) echo $data[$tabla]['URL']; ?></strong></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Contenido:</label>
        <div class="controls">
          <textarea class="form-control full-editor" id="detalle" name="<?php echo $tabla; ?>[Detalle]" rows="4"><?php if (isset($data[$tabla]['Detalle'])) echo $data[$tabla]['Detalle']; ?></textarea>
          <p class="help-block"></p>
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
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#image" data-toggle="tab">Media</a>
        </li>
        <li>
          <a href="#info">Ubicaci&oacute;n</a>
        </li>
        <li>
          <a href="#menu">Men&uacute;</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="image">
          <div class="form-group">
            <label class="control-label">Plantilla:</label>
            <div class="controls">
              <select id="plantilla" name="<?php echo $tabla; ?>[PlantillaID]" data-rel="chosen">
                <?php
                if (isset($data['selplantilla']) && count($data['selplantilla']) > 0) :
                  foreach ($data['selplantilla'] as $item):
                    $selected = ($data[$tabla]['PlantillaID'] == $item['ID']) ? 'selected="selected"' : '';
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
                    <img src="<?php echo $thumb; ?>" id="img-imagen" width="150">
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
              <p>&nbsp;</p>
              <label class="control-label">Alineaci&oacute;n:</label>
              <select name="<?php echo $tabla; ?>[AlineaImg]" data-rel="chosen">
                <?php
                $alinea = array('right' => 'Derecha', 'center' => 'Centro', 'left' => 'Izquierda');
                foreach ($alinea as $key => $value):
                  $selected = ($data[$tabla]['AlineaImg'] == $key) ? 'selected="selected"' : '';
                  ?>
                  <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="video">Video Youtube:</label>
            <div class="controls">
              <div class="content-image">
                <div class="border-overflow">
                  <?php
                  $thumb = (!empty($data[$tabla]['Video'])) ? 'http://img.youtube.com/vi/' . $data[$tabla]['Video'] . '/0.jpg' :
                    CMS_IMG . 'no-foto-150x100.jpg';
                  $video = (!empty($data[$tabla]['Video'])) ? 'http://www.youtube.com/watch?v=' . $data[$tabla]['Video'] : '#';
                  $class = (!empty($data[$tabla]['Video'])) ? 'fancybox-media' : '';
                  ?>
                  <input type="hidden" name="<?php echo $tabla; ?>[Video]" id="video" value="<?php if (isset($data[$tabla]['Video'])) echo $data[$tabla]['Video']; ?>">
                  <a id="gal-video" href="<?php echo $video; ?>" class="<?php echo $class; ?>">
                    <img src="<?php echo $thumb; ?>" id="img-video" width="150">
                  </a>
                </div>
              </div>
              <div class="buttons-up">
                <a id="btn-video" href="#pop-video" class="fancybox btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>
                <a id="del-video" onclick="deleteVideo('video')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
                <div id="ldr-video" class="loader">
                  <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="tab-pane fade in" id="info">
          <div class="form-group">
            <label class="control-label">Secci&oacute;n Padre:</label>
            <div class="controls">
              <input type="hidden" id="parent_ant" value="<?php if (isset($data[$tabla]['PadreID'])) echo $data[$tabla]['PadreID']; ?>">
              <select id="parent" name="<?php echo $tabla; ?>[PadreID]" data-rel="chosen">
                <option value="0">Carpeta Ra&iacute;z</option>
                <?php if (isset($data['selectsec'])) echo $data['selectsec']; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="posicion">Posici&oacute;n:</label>
            <div id="content-pos" class="controls">
              <?php include('mod-posicion.php'); ?>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="tab-pane fade in" id="menu">
          <div class="form-group">
            <label class="control-label">Menu Superior:</label>
            <div class="controls">
              <input id="menu_top" type="text" class="form-control" name="<?php echo $tabla; ?>[MenuTop]" value="<?php echo (isset($data[$tabla]['MenuTop'])) ? $data[$tabla]['MenuTop'] : ''; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Menu Inferior:</label>
            <div class="controls">
              <input id="menu_bot" type="text" class="form-control" name="<?php echo $tabla; ?>[MenuBot]" value="<?php echo (isset($data[$tabla]['MenuBot'])) ? $data[$tabla]['MenuBot'] : ''; ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$urlId = (isset($data[$tabla]['ID'])) ? $data[$tabla]['ID'] . '/' : '';
$urlChange = URL_CMS . $data['base_url'] . 'select/' . $urlId;
?>
<script>
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

    $('#titulo').keyup(function () {
      var value = $(this).val();
      $('#meta-url').val(str2url(value));
      $('#meta-titulo').val(value);
      $('#meta-descripcion').val(value);
      $('#menu_top').val(value);
      $('#menu_bot').val(value);

      updateFriendlyURL('meta-url', 'friendly-url');
    });

    $('#meta-url').keyup(function () {
      $(this).val(str2url($(this).val()));
      updateFriendlyURL('meta-url', 'friendly-url');
    });
  });

  function deleteImage(code) {
    delImage(code,
            "<?php echo CMS_IMG . 'no-foto-150x100.jpg'; ?>",
            "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  function deleteVideo(code) {
    delVideo(code, "<?php echo CMS_IMG . 'no-video-150x100.jpg'; ?>");
  }

  function deleteGallery(code, id) {
    delGallery(code, id,
            "<?php echo URL_CMS . $data['base_url'] . 'delimage'; ?>");
  }

  var checkExt = new RegExp(/^(jpg|JPG|JPEG|jpeg|png)$/);
  uploadImage('imagen', checkExt,
          "<?php echo URL_CMS . $data['base_url'] . 'upload'; ?>",
          "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");



  $('#parent').change(function () {
    var parent = $('#parent option:selected').val();
    var prev = $('#parent_ant').val();
    var formData = {parent: parent, prev: prev};

    $.ajax({
      url: "<?php echo $urlChange; ?>",
      type: 'POST',
      data: formData,
      success: function (data) {
        $('#parent_ant').val(parent);
        $('#sortable').remove();
        $('#content-pos').html(data);
      }
    });
  });
</script>