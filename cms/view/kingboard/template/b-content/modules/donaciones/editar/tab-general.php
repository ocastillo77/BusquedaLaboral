<?php $tabla = $data['tabla']; ?>
<input type="hidden" name="<?php echo $tabla; ?>[Publico]" id="publico" value="<?php if (isset($data[$tabla]['Publico'])) echo $data[$tabla]['Publico']; ?>">
<div class="col-md-7">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="nombre"><span class="obligatory">*</span> Nombre:</label>
        <div class="controls">
          <input type="text" class="form-control" id="nombre" name="<?php echo $tabla; ?>[Nombre]" value="<?php if (isset($data[$tabla]['Nombre'])) echo $data[$tabla]['Nombre']; ?>" />
          <p class="help-block"></p>
        </div>
      </div> 
      <div class="form-group">
        <label class="control-label"><span class="obligatory">*</span> Donante:</label>
        <div class="controls">
          <select id="donadores" name="<?php echo $tabla; ?>[ClienteID]" data-rel="chosen">                							
            <option value="">- Seleccione -</option>            
            <?php
            if (isset($data['donadores']) && count($data['donadores']) > 0) :
              foreach ($data['donadores'] as $item):
                $selected = $data[$tabla]['ClienteID'] == $item['ID'] ? 'selected="selected"' : '';
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
        <label class="control-label"><span class="obligatory">*</span> Forma de Pago:</label>
        <div class="controls">
          <select id="formapago" name="<?php echo $tabla; ?>[FormaPago]" data-rel="chosen">                							          
            <?php
            if (isset($data['formaspago']) && count($data['formaspago']) > 0) :
              foreach ($data['formaspago'] as $item):
                $selected = $data[$tabla]['FormaPago'] == $item['ID'] ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>      
      <div class="cont-hint">
        <span class="obligatory">*</span>
        <p class="help-block">Los campos son obligatorios</p>
      </div>				
    </div>
  </div>
</div>
<div class="col-md-5">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label" for="fecha"><span class="obligatory">*</span> Fecha de Pago:</label>
        <div class="controls">
          <input type="text" class="form-control datepicker" id="fecha" name="<?php echo $tabla; ?>[Fecha]" value="<?php if (isset($data[$tabla]['Fecha'])) echo $data[$tabla]['Fecha']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>				
      <div class="form-group">
        <label class="control-label" for="monto"><span class="obligatory">*</span> Monto ($):</label>
        <div class="controls">
          <input type="text" class="form-control" id="monto" name="<?php echo $tabla; ?>[Monto]" value="<?php if (isset($data[$tabla]['Monto'])) echo $data[$tabla]['Monto']; ?>" />
          <p class="help-block"></p>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label" for="imagen">Archivo:</label>
        <div class="controls">
          <div class="content-image">
            <div class="border-overflow">
              <?php
              $thumb = !empty($data[$tabla]['Archivo']) ? CMS_IMG . 'file_pdf.png' : CMS_IMG . 'file_upload.png';
              $archivo = (!empty($data[$tabla]['Archivo'])) ? URL_GAL . $data['tabla'] . '/files/CSV_' . $data[$tabla]['Archivo'] : '';
              $link = !empty($data[$tabla]['Archivo']) ? URL_GAL . $data['tabla'] . '/files/' . $data[$tabla]['Archivo'] : '';
              ?>
              <input type="hidden" name="<?php echo $tabla; ?>[Archivo]" id="archivo">
              <?php if (!empty($link)) : ?>
                <a id="gal-archivo" href="<?php echo $link; ?>" target="_blank">
                  <img src="<?php echo $thumb; ?>" id="img-archivo" />
                </a>
              <?php else : ?>
                <a id="gal-archivo" href="javascript:;" target="_blank">
                  <img src="<?php echo $thumb; ?>" id="img-archivo" />
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class="buttons-up">
            <a id="btn-archivo" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Cambiar</a>	
            <a id="del-archivo" onclick="deleteFile('archivo')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-archivo" class="loader">
              <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando archivo...</span>
            </div>
          </div>	
        </div>
      </div>   

    </div>    
  </div>
</div>
<script>
  $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
    onSelect: function (dateText) {
    }
  });

  function deleteFile(code) {
    delFile(code,
      "<?php echo CMS_IMG . 'file_upload.png'; ?>",
      "<?php echo URL_CMS . $data['base_url'] . 'delfile'; ?>");
  }

  var checkFile = new RegExp(/^(pdf)$/);
  uploadFile('archivo', checkFile,
    "<?php echo URL_CMS . $data['base_url'] . 'upload_file'; ?>",
    "<?php echo CMS_IMG . 'file_pdf.png'; ?>");
</script>
