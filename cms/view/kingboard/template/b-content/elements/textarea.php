<div class="form-group">
  <label class="control-label" for="<?php echo $item['id']; ?>">
    <?php if (isset($item['required']) && $item['required']) : ?>
      <span class="obligatory">*</span> 
    <?php endif; ?>
    <?php echo $item['title']; ?></label>
  <div class="controls">
    <textarea id="<?php echo $item['id']; ?>" name="<?php echo $item['name']; ?>" 
              class="form-control" rows="<?php echo $item['rows']; ?>"><?php echo $item['value']; ?></textarea>
    <p class="help-block"><?php echo $item['description']; ?></p>
  </div>
</div>