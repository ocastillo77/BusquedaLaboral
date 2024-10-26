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
          <a class="btn btn-danger" onclick="validate('form-list', 'accion', 'delete');">
            <i class="icon icon-trash icon-white"></i> Eliminar
          </a>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
              <div class="widget-content row">
                <div class="col-md-12">
                  <form id="form-filter" method="post" class="row">
                    <div class="form-group col-md-2">
                      <label class="d-block">Donantes:</label>
                      <select id="filtro" name="filtro" data-rel="chosen">   
                        <option value="">- Todos -</option>    
                        <?php
                        if (count($data['donadores']) > 0) :
                          foreach ($data['donadores'] as $item) :
                            $selected = $data['donante'] == $item['ID'] ? 'selected' : '';
                            ?>
                            <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                      </select>  
                    </div>
                    <div class="form-group col-md-2">
                      <label>Forma de Pago:</label>
                      <select id="formapago" name="formapago" data-rel="chosen">   
                        <option value="">- Todos -</option>    
                        <?php
                        if (count($data['formaspago']) > 0) :
                          foreach ($data['formaspago'] as $item) :
                            $selected = $data['formapago'] == $item['ID'] ? 'selected' : '';
                            ?>
                            <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                            <?php
                          endforeach;
                        endif;
                        ?>
                      </select>  
                    </div>
                    <div class="form-group col-md-2">
                      <label>Mes:</label>
                      <select id="mes" name="mes" data-rel="chosen">   
                        <option value="">- Todos -</option>    
                        <?php
                        $meses = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                        array_shift($meses);
                        foreach ($meses as $key => $value) :
                          $selected = $data['mes'] == $key ? 'selected' : '';
                          ?>
                          <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                          <?php
                        endforeach;
                        ?>
                      </select>  
                    </div>
                    <div class="form-group col-md-2">
                      <label>Año:</label>
                      <select id="anio" name="anio" data-rel="chosen">   
                        <option value="">- Todos -</option>    
                        <?php
                        for ($key = 2015; $key <= 2040; $key++) :
                          $selected = $data['anio'] == $key ? 'selected' : '';
                          ?>
                          <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option>
                          <?php
                        endfor;
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
              </div>
            </div>
          </div>
        </div>
        <form id="form-list" method="post" action="">
          <input type="hidden" name="listar" value="1" />
          <input type="hidden" id="accion" name="accion" />
          <?php include('listar/index.php'); ?>
        </form>
      </div>
    </div><!--/widget-->			
  </div><!--/col-md-12-->			
</div><!--/row-->
<script>
  var aUrlFilter = "<?php
          echo URL_CMS . $data['base_url']
          . 'filter/' . $data['donante'] . '/' . $data['formapago'] . '/' . $data['mes'] . '/' . $data['anio'];
          ?>";
  var aAligns = <?php echo $data['aligns']; ?>;

  $(document).ready(function () {
    getTableList('list-table', aUrlFilter, aAligns);
    $('.dataTables_filter').prepend($('.top-actions'));
  });
</script>