<div class="form-group">
  <label class="control-label"><?php echo $item['title']; ?></label>
  <div class="controls">
    <ul id="<?php echo $item['id']; ?>">
      <?php
      if (isset($item['list'])) :
        $i = 1;
        foreach ($item['list'] as $row) :
          $select = ($row[$item['key']] == $item['value']) ? 'selected' : '';
          ?>	
          <li id="item-<?php echo $row[$item['key']]; ?>" class="<?php echo $select; ?>">
            <span class="number"><?php echo $i; ?></span>
            <span class="text"><?php echo $row[$item['option']]; ?></span>
          </li>				
          <?php
          $i++;
        endforeach;
      endif;
      if (!isset($item['value'])) :
        ?>
        <li id="item-<?php echo $i; ?>" class="select">
          <span class="number"><?php echo $i; ?></span>
          <span class="text">Nuevo Item</span>
        </li>	        
        <?php
      endif;
      ?>
    </ul>
  </div>
</div>	
<script>
  $(document).ready(function () {
    $('#<?php echo $item['id']; ?>').sortable({
      axis: 'y',
      stop: function () {
        var data = $(this).sortable('serialize');

        $.ajax({
          data: data,
          type: 'POST',
          url: '<?php echo $item['url']; ?>',
          success: function (message) {
            var i = 1;
            
            $('#<?php echo $item['id']; ?> li').each(function () {
              $(this).find('span:eq(0)').html(i);
              i++;
            });

            alertMessage('success', message);
          }
        });
      }
    });
  });
</script>