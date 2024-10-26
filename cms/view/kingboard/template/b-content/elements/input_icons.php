<?php ?>
<div class="form-group">
  <label class="control-label" for="<?php echo $item['id']; ?>">
    <?php if (isset($item['required']) && $item['required']) : ?>
      <span class="obligatory">*</span> 
    <?php endif; ?>
    <?php echo $item['title']; ?></label>
  <div class="controls">
    <div class="input-group">
      <input type="text" class="form-control icp icp-auto" data-placement="bottomRight" 
             id="<?php echo $item['id']; ?>" 
             name="<?php echo $item['name']; ?>" 
             value="<?php echo $item['value']; ?>" />
      <span class="input-group-addon"></span>
    </div>
    <p class="help-block"></p>
  </div>
</div>
<script>
  $('.icp-auto').iconpicker();
</script>
