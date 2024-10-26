<div class="col-md-12">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Características</h3>
    </div>
    <div class="widget-content">
      <?php
      if (isset($data['caracters'])) :
        foreach ($data['caracters'] as $item) :
          $tipos = explode(',', $item['TipoProp']);
          $checked = in_array($data[$tabla]['ID'], $tipos) ? 'checked' : '';
          ?>
          <div class="form-group col-md-3">
            <label class="control-label"><?php echo $item['Titulo']; ?>:</label>
            <div>
              <input class="checkvert" type="checkbox" id="cochera" name="caracter[<?php echo $item['Campo']; ?>]" 
                     data-on="Si" data-off="No" data-toggle="toggle" data-width="80" 
                     data-onstyle="success" data-offstyle="warning" value="1" <?php echo $checked; ?>>
            </div>
          </div>
          <?php
        endforeach;
      endif;
      ?>
      <div class="clear"></div>
    </div>
  </div>
</div>
