<?php
$data['cur'] = (isset($data['cur'])) ? $data['cur'] : 1;
$img = (CMS_IMG) ? CMS_IMG : $img;

$id_par = (isset($data['parrafo'][$data['cur'] - 1]['ID']) &&
  !empty($data['parrafo'][$data['cur'] - 1]['ID'])) ?
  $data['parrafo'][$data['cur'] - 1]['ID'] : 0;
?>
<input type="hidden" name="paragraph[<?php echo $data['cur'] - 1; ?>][ID]" value="<?php echo $id_par; ?>">
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
      <?php if ($data['cur'] != 1): ?>
        <div class="btn-group widget-header-toolbar">
          <button onclick="closeTab(<?php echo $data['cur']; ?>,<?php echo $id_par; ?>, '<?php echo URL_CMS . $data['base_url'] . 'deltab'; ?>')" class="btn btn-danger btn-sm" type="button">
            <i class="fa fa-trash-o"></i>
            <span>Eliminar P&aacute;rrafo</span>
          </button>
        </div>
      <?php endif; ?>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="titulo_<?php echo $data['cur']; ?>">T&iacute;tulo:</label>
        <div class="controls">
          <input type="text" class="form-control" id="titulo_<?php echo $data['cur']; ?>" name="paragraph[<?php echo $data['cur'] - 1; ?>][Titulo]" value="<?php if (isset($data['parrafo'][$data['cur'] - 1]['Titulo'])) echo $data['parrafo'][$data['cur'] - 1]['Titulo']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="detalle_<?php echo $data['cur']; ?>">Contenido:</label>
        <div class="controls">
          <textarea id="detalle_<?php echo $data['cur']; ?>" name="paragraph[<?php echo $data['cur'] - 1; ?>][Detalle]" class="form-control" rows="4"><?php if (isset($data['parrafo'][$data['cur'] - 1]['Detalle'])) echo $data['parrafo'][$data['cur'] - 1]['Detalle']; ?></textarea>
          <p class="help-block"></p>
        </div>
        <script type="text/javascript">
          $(document).ready(function () {
            tinymce.init({
              selector: "#detalle_<?php echo $data['cur']; ?>",
              language: 'es_419',
              theme: "modern",
              plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template textcolor paste textcolor colorpicker codesample"
              ],
              content_css: "config.css",
              add_unload_trigger: false,
              autosave_ask_before_unload: false,

              toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink | preview",
              toolbar2: "styleselect formatselect fontselect fontsizeselect | image media | forecolor backcolor | code fullscreen",
              toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons",
              menubar: false,
              toolbar_items_size: 'small',
              height: 350,
            });
          });
        </script>
      </div>
    </div>
    <div class="cont-hint">
      <span class="obligatory">*</span>
      <p class="help-block">Los campos son obligatorios</p>
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
        <label class="control-label" for="imagen_<?php echo $data['cur']; ?>">Imagen:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              if (isset($data['parrafo'][$data['cur'] - 1]['Imagen']) && !empty($data['parrafo'][$data['cur'] - 1]['Imagen'])) {
                $thumb = URL_GAL . $data['tabla'] . '/thumbs/TH_' . $data['parrafo'][$data['cur'] - 1]['Imagen'];
                $imagen = URL_GAL . $data['tabla'] . '/images/IM_' . $data['parrafo'][$data['cur'] - 1]['Imagen'];
                $class = 'fancybox';
              } else {
                $thumb = $img . 'no-foto-150x100.jpg';
                $imagen = '#';
                $class = '';
              }
              ?>
              <input type="hidden" name="paragraph[<?php echo $data['cur'] - 1; ?>][Imagen]" id="imagen_<?php echo $data['cur']; ?>" value="<?php if (isset($data['parrafo'][$data['cur'] - 1]['Imagen'])) echo $data['parrafo'][$data['cur'] - 1]['Imagen']; ?>">
              <a id="gal-imagen_<?php echo $data['cur']; ?>" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-imagen_<?php echo $data['cur']; ?>" width="150">
              </a>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-imagen_<?php echo $data['cur']; ?>" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>
            <a id="del-imagen_<?php echo $data['cur']; ?>" onclick="deleteImage('imagen_<?php echo $data['cur']; ?>')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-imagen_<?php echo $data['cur']; ?>" class="loader">
              <img src="<?php echo $img . 'loader.gif'; ?>"> <span>cargando...</span>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <script type="text/javascript">
          $(document).ready(function () {
            var checkExt = new RegExp(/^(jpg|JPG|png)$/);
            uploadImage("imagen_<?php echo $data['cur']; ?>", checkExt,
                    "<?php echo URL_CMS . $data['base_url'] . 'upload'; ?>",
                    "<?php echo URL_CMS . $data['base_url'] . 'jcrop'; ?>");
          });
        </script>
      </div>
      <div class="form-group">
        <label class="control-label" for="video_<?php echo $data['cur']; ?>">Video Youtube:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              if (isset($data['parrafo'][$data['cur'] - 1]['Video']) && !empty($data['parrafo'][$data['cur'] - 1]['Video'])) {
                $thumb = 'http://img.youtube.com/vi/' . $data['parrafo'][$data['cur'] - 1]['Video'] . '/0.jpg';
                $video = 'http://www.youtube.com/watch?v=' . $data['parrafo'][$data['cur'] - 1]['Video'];
                $class = 'fancybox-media';
              } else {
                $thumb = $img . 'no-foto-150x100.jpg';
                $video = '#';
                $class = '';
              }
              ?>
              <input type="hidden" name="paragraph[<?php echo $data['cur'] - 1; ?>][Video]" id="video_<?php echo $data['cur']; ?>" value="<?php if (isset($data['parrafo'][$data['cur'] - 1]['Video'])) echo $data['parrafo'][$data['cur'] - 1]['Video']; ?>">
              <a id="gal-video_<?php echo $data['cur']; ?>" href="<?php echo $video; ?>" class="<?php echo $class; ?>">
                <img src="<?php echo $thumb; ?>" id="img-video_<?php echo $data['cur']; ?>" width="150">
              </a>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-video_<?php echo $data['cur']; ?>" href="#pop-video_<?php echo $data['cur']; ?>" class="fancybox btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>
            <a id="del-video_<?php echo $data['cur']; ?>" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-video_<?php echo $data['cur']; ?>" class="loader">
              <img src="<?php echo $img . 'loader.gif'; ?>"> <span>cargando imagen...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="pop-video_<?php echo $data['cur']; ?>" class="videoline">
  <div class="f-content">
    <p><strong>Ingrese la URL del video de Youtube:</strong></p>
    <span class="mini-text">Ejemplo: http://www.youtube.com/watch?v=oeZtenPCLVg</span>
  </div>
  <div class="controls">
    <input type="text" class="w390" id="url-video_<?php echo $data['cur']; ?>" />
  </div>
  <div class="f-button">
    <a id="submit" onclick="addUrlYoutube('video_<?php echo $data['cur']; ?>');" class="btn btn-primary">
      <i class="icon icon-white icon-plus"></i> Agregar</a>
  </div>
</div>
<div class="clear"></div>