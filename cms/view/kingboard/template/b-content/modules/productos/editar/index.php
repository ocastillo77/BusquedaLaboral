<ul class="nav nav-tabs">
  <li class="active"><a href="#tab_general" data-toggle="tab">General</a></li>
  <li><a href="#tab_opciones">Más Configuraciones</a></li>
  <li><a href="#tab_galeria">Galería</a></li>
  <li><a href="#tab_meta">Metatags</a></li>
</ul>
<form id="form" method="post">
  <input type="hidden" name="actualizar" value="1" />
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab_general">
      <?php include('tab-general.php'); ?>
    </div>
    <div class="clear"></div>
    <div class="tab-pane fade in" id="tab_opciones">
      <?php include('tab-opciones.php'); ?>
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
<script>
  function validate(id) {
    $('#publico').val(id);
    $('#form').submit();
  }

  function isChecked(id) {
    if ($('#' + id).is(':checked')) {
      $('#hd_' + id).val(1);
    } else {
      $('#hd_' + id).val(0);
    }
  }
</script>