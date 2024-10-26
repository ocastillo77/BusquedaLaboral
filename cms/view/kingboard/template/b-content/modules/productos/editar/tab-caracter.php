<input type="hidden" name="caracter[ID]" value="<?php echo (isset($data['caracter']['ID']) && !empty($data['caracter']['ID'])) ? $data['caracter']['ID'] : 0; ?>">			
<div id="box-caracter">
  <?php
  include 'mod-caracter.php';
  ?>
</div>

