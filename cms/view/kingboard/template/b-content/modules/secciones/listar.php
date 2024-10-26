<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>                
      </div>
      <div class="widget-content">
        <div class="top-actions">
          <a class="btn btn-primary" href="<?php echo URL_CMS . $data['base_url'] . 'insertar'; ?>">
            Nueva Registro                                            
          </a>            
          <a class="btn btn-danger" onclick="validate('form-list', 'accion', 'delete');">
            Eliminar
          </a>
        </div>
        <div class="clear"></div>
        <form id="form-list" method="post" action="">
          <input type="hidden" name="listar" value="1" />
          <input type="hidden" id="accion" name="accion" />
          <?php if (isset($data['tree_table'])) echo $data['tree_table']; ?>          
        </form>
      </div>
    </div><!--/widget-->			
  </div><!--/col-md-12-->			
</div><!--/row-->
<script>
  $(document).ready(function () {
    $('#list-table').treeTable();
  });
</script>
