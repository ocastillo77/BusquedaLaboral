<div class="form-group">
  <label for="<?php echo $item['id']; ?>" class="col-sm-3 control-label">
    <?php if (isset($item['required']) && $item['required']) : ?>
      <span class="obligatory">*</span> 
    <?php endif; ?>
    <?php echo $item['title']; ?></label>
  <div class="col-sm-9">
    <input type="text" class="form-control" 
           id="<?php echo $item['id']; ?>" 
           name="<?php echo $item['name']; ?>" 
           value="<?php echo $item['value']; ?>" />
    <p class="help-block"><?php echo $item['description']; ?></p>
  </div>
</div>
