<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-edit"></i> <?php echo $data['title']; ?></h3>                
      </div>
      <div class="widget-content">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-content row">
                <div class="col-md-8">
                  <form id="form-filter" method="post" class="row">
                    <div class="form-group col-md-3">
                      <label class="inline">Productos:</label>
                      <select id="filtro" name="filtro" data-rel="chosen" class="inline">   
                        <option value="">- Todos -</option>    
                        <?php
                        $filtros = [1 => 'Publicados', 2 => 'Sin Publicar'];
                        foreach ($filtros as $key => $item) :
                          $selected = $data['type'] == $key ? 'selected' : '';
                          ?>
                          <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>
                          <?php
                        endforeach;
                        ?>
                      </select>  
                    </div>
                    <div class="form-group col-md-3">
                      <label class="inline">Categorías:</label>
                      <select id="categoria" name="categoria" data-rel="chosen" class="inline">   
                        <option value="">- Todos -</option>    
                        <?php
                        if (count($data['categorias']) > 0) :
                          foreach ($data['categorias'] as $item) :
                            $selected = $data['categoria'] == $item['ID'] ? 'selected' : '';
                            ?>
                            <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                      </select>  
                    </div>
                    <div class="col-md-2 margin-top-15">
                      <a class="btn btn-primary" href="javascript:$('#form-filter').submit();">
                        <i class="fa fa-search"></i> Filtrar                                            
                      </a>
                    </div>
                  </form>
                </div>
                <div class="col-md-4">
                  <div class="top-actions margin-top-15">
                    <a class="btn btn-danger" onclick="validate('form-list', 'accion', 'delete');">
                      Eliminar
                    </a>
                    <a class="btn btn-info" onclick="validate('form-list', 'accion', 'duplicate');">
                      Duplicar                                            
                    </a>
                    <a class="btn btn-primary" href="<?php echo URL_CMS . $data['base_url'] . 'insertar'; ?>">
                      Nuevo Registro                                            
                    </a>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <form id="form-list" method="post">
          <input type="hidden" name="listar" value="1" />
          <input type="hidden" id="accion" name="accion" />
          <?php include('listar/index.php'); ?>
        </form>
      </div>
    </div><!--/widget-->			
  </div><!--/col-md-12-->			
</div><!--/row-->
<script>
  $(document).ready(function () {
    $('.fancybox').fancybox();
    $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
      openEffect: 'none',
      closeEffect: 'none',
      prevEffect: 'none',
      nextEffect: 'none',
      arrows: false
    });
  });

  var aUrlFilter = "<?php
          echo URL_CMS . $data['base_url']
          . 'filter/' . $data['type'] . '/' . $data['categoria'] . '/' . $data['marca'];
          ?>";
  var aAligns = <?php echo $data['aligns']; ?>;

  $(document).ready(function () {
    getTableList('list-table', aUrlFilter, aAligns);
  });
</script>