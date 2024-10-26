<div class="col-md-12">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Agregar Im&aacute;genes</h3>
    </div>
    <div class="widget-content">
      <!-- top action buttons -->
      <div class="gallery-buttons">
        <button id="upgalery" type="button" class="btn btn-primary btn-md"><i class="fa fa-search"></i> Seleccionar Im&aacute;genes</button>
        <button id="upgalery_now" type="button" class="btn btn-primary btn-md"><i class="fa fa-upload"></i> Iniciar Subida</button>
      </div>
      <!-- end top action buttons -->
      <div id="previews" class="dropzone-previews"></div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Galeria de Im&aacute;genes</h3>
    </div>
    <div class="widget-content">
      <div id="box-gallery" class="row list-group king-gallery">
        <?php include('mod-galeria.php'); ?>
      </div>
    </div>
  </div>
</div>
<?php $count_gal = (isset($data['galeria']) && count($data['galeria'])) ? count($data['galeria']) : 0; ?>
<script type="text/javascript">
  uploadGalery('upgalery',
          "<?php echo $count_gal; ?>",
          "<?php echo URL_CMS . 'view/' . CMS_THEME . '/assets/js/'; ?>",
          "<?php echo URL_CMS . $data['base_url'] . 'galeria'; ?>",
          "<?php echo URL_CMS . $data['tabla'] . '/getimage'; ?>");
</script>