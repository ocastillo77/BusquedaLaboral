<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>                
      </div>
      <div class="widget-content">
        <div class="top-actions">
          <a class="btn btn-primary" href="<?php echo URL_CMS . $data['base_url'] . 'insertar'; ?>">
            <i class="icon icon-plus icon-white"></i> Nuevo Registro                                            
          </a>
          <a class="btn btn-info" onclick="validate('form-list', 'accion', 'archivar');">
            <i class="icon icon-pin icon-white"></i> Suspender                                            
          </a>          
          <a class="btn btn-danger" onclick="validate('form-list', 'accion', 'delete');">
            <i class="icon icon-trash icon-white"></i> Eliminar
          </a>
        </div>
        <form id="form-list" method="post" action="">
          <input type="hidden" name="listar" value="1" />
          <input type="hidden" id="accion" name="accion" />
          <?php include('listar/index.php'); ?>
        </form>
      </div>
    </div>
  </div><!--/widget-->			
</div><!--/col-md-12-->			
<script>
  var aUrlFilter = "<?php echo URL_CMS . $data['base_url'] . 'filter'; ?>";
  var aAligns = <?php echo $data['aligns']; ?>;

  $(document).ready(function () {
    getTableList('list-table', aUrlFilter, aAligns);
    $('.dataTables_filter').prepend($('.top-actions'));
  });
</script>