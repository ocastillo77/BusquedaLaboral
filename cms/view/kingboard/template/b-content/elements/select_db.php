<div class="form-group">
  <label class="control-label"><?php echo $item['title']; ?></label>
  <div class="controls">
    <?php if (isset($item['list'])) : ?>            	
      <select id="<?php echo $item['id']; ?>" name="<?php echo $item['name']; ?>" data-rel="chosen">                							
        <option value="">Ninguna</option>
        <?php
        foreach ($item['list'] as $row) :
          $select = ($row[$item['key']] == $item['value']) ? 'selected' : '';
          ?>
          <option value="<?php echo $row[$item['key']]; ?>" <?php echo $select; ?>>
            <?php echo $row[$item['option']]; ?>
          </option>
        <?php endforeach; ?>
      </select>
    <?php endif; ?>              
  </div>
</div>
