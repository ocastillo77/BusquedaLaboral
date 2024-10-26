<input type="hidden" name="meta[ID]" value="<?php echo (isset($data['meta']['ID']) && !empty($data['meta']['ID'])) ? $data['meta']['ID'] : 0; ?>">			
<div class="col-md-8">
  <div class="widget-content">
    <div class="form-group">
      <label class="control-label" for="meta-titulo">Meta T&iacute;tulo:</label>
      <div class="controls">
        <input type="text" class="form-control" id="meta-titulo" name="meta[Titulo]" value="<?php if (isset($data['meta']['Titulo'])) echo $data['meta']['Titulo']; ?>" />
        <p class="help-block"></p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label" for="meta-descripcion">Meta Descripci&oacute;n:</label>
      <div class="controls">
        <textarea id="meta-descripcion" name="meta[Descripcion]" class="form-control autogrow" rows="1"><?php if (isset($data['meta']['Descripcion'])) echo $data['meta']['Descripcion']; ?></textarea>
        <p class="help-block"></p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label" for="keywords">Palabras Clave:</label>
      <div class="controls">
        <div class="tag-content">
          <input type="text" id="tags" name="tags" placeholder="Palabras Clave" class="tm-input w120" />
          <input type="hidden" id="keywords" name="meta[Keywords]" value="<?php if (isset($data['meta']['Keywords'])) echo $data['meta']['Keywords']; ?>" />
        </div>
        <p class="help-block"></p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="widget-content">
    <div class="form-group">
      <label class="control-label" for="skype">Robots:</label>
      <div class="controls">
        <select name="meta[Robots]" id="robots" data-rel="chosen">
          <?php
          $aRobots = array('index, follow', 'index, nofollow', 'noindex, follow', 'noindex, nofollow');
          foreach ($aRobots as $robots) :
            $selected = (isset($data['meta']['Robots']) && $data['meta']['Robots'] == $robots) ? 'selected="selected"' : '';
            ?>
            <option value="<?php echo $robots; ?>" <?php echo $selected; ?>><?php echo $robots; ?></option>
          <?php endforeach; ?>
        </select>
        <p class="help-block"></p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('.tm-input').tagsManager({
      hiddenTagListId: 'keywords'
    });
  });
</script>