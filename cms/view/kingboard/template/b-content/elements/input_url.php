<div class="form-group">
  <label class="control-label" for="<?php echo $item['id']; ?>">
    <?php if (isset($item['required']) && $item['required']) : ?>
      <span class="obligatory">*</span> 
    <?php endif; ?>
    <?php echo $item['title']; ?></label>
  <div class="controls">
    <input type="text" class="form-control" id="<?php echo $item['id']; ?>" 
           name="<?php echo $item['name']; ?>" 
           value="<?php echo $item['value']; ?>" />
    <p class="help-block">Su enlace se vera en: <?php echo $item['url']; ?>
      <strong id="url-seo"><?php echo $item['value']; ?></strong>
    </p>
  </div>
</div>
<script>
  $('#<?php echo $item['id']; ?>').keyup(function () {
    $(this).val(str2url($(this).val()));
    updateFriendlyURL('<?php echo $item['id']; ?>', 'url-seo');
  });
</script>