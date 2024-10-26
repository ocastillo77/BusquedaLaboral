<table id="sortable" class="table table-bordered">
  <?php
  $i = 1;
  if (isset($data['selectpos']) && count($data['selectpos']) > 0) :
    foreach ($data['selectpos'] as $item) :
      ?>	
      <tr id="<?php echo $item['ID']; ?>">
        <td width="1" class="center"><?php echo $i; ?></td>
        <td><?php echo $item['Nombre']; ?></td>
      </tr>						
      <?php
      $i++;
    endforeach;
  endif;
  ?>
</table>
<script>
  url_sort = "<?php echo URL_CMS . $data['base_url'] . 'sortable'; ?>";
  sortable('sortable', 'posicion', url_sort);
</script>