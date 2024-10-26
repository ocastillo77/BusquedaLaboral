<?php
$tabla = $data['tabla'];
$posicion = isset($data[$tabla]['Posicion']) ? $data[$tabla]['Posicion'] : 1;
$itemId = isset($data[$tabla]['ID']) ? $data[$tabla]['ID'] : '';
?>
<table id="sortable" class="table table-bordered">
  <?php
  $i = 1;
  if (isset($data['selectpos']) && count($data['selectpos']) > 0) :
    $posicion = count($data['selectpos']);

    foreach ($data['selectpos'] as $item) :
      $selected = !empty($itemId) && $data[$tabla]['ID'] == $item['ID'] ? 'select-pos' : '';
      ?>	      
      <tr id="<?php echo $item['ID']; ?>" class="<?php echo $selected; ?>">
        <td width="1" class="center"><?php echo $i; ?></td>
        <td class="w100pc"><?php echo $item['Titulo']; ?></td>
      </tr>						
      <?php
      $i++;
    endforeach;
  endif;
  if (empty($itemId)) :
    $posicion = $i;
    ?>
    <tr id="<?php echo $i; ?>" class="select-pos">
      <td width="1" class="center"><?php echo $i; ?></td>
      <td class="w100pc">Nuevo Item</td>
    </tr>	
    <?php
  endif;
  ?>
</table>
<input type="hidden" id="posicion" name="<?php echo $tabla; ?>[Posicion]" value="<?php echo $posicion; ?>">
<script>
  var url_sort = "<?php echo URL_CMS . $data['base_url'] . 'sortable/' . $itemId; ?>";
  sortable('sortable', 'posicion', url_sort);
</script>