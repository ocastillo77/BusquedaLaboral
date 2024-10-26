<div class="form-group">
    <label class="control-label">Foto:</label>
    <div class="controls box-lm">
        <div class="content-image">
            <div class="border-overflow">
                <?php
                $thumb = !empty($data['Imagen']) ? URL_GAL . 'usuarios/thumbs/TH_' . $data['Imagen'] : CMS_IMG . 'no-foto-150x100.jpg';
                $imagen = !empty($data['Imagen']) ? URL_GAL . 'usuarios/images/IM_' . $data['Imagen'] : '#';
                $class = !empty($data['Imagen']) ? 'fancybox' : '';
                ?>
                <input type="hidden" name="imagen" id="imagen" value="<?php !empty($data['Imagen']) ? $data['Imagen'] : ''; ?>">
                <a id="gal-imagen" href="<?php echo $imagen; ?>" class="<?php echo $class; ?>">
                    <img src="<?php echo $thumb; ?>" id="img-imagen" />
                </a>
            </div>
        </div>
        <div class="buttons-up">
            <a id="btn-imagen" class="btn btn-primary"><i class="icon icon-plus icon-white"></i> Seleccionar</a>
            <a id="del-imagen" onclick="deleteImage('imagen')" class="btn btn-danger"><i class="icon icon-trash icon-white"></i> Eliminar</a>
            <div id="ldr-imagen" class="loader">
                <img src="<?php echo CMS_IMG . 'loader.gif'; ?>"> <span>cargando imagen...</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
