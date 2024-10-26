<?php
$tabla = $data['tabla'];
$posicion = (isset($data[$tabla]['Posicion'])) ? $data[$tabla]['Posicion'] : count($data['selectpos']); ?>
<table id="sortable" class="table table-bordered">
<?php
$i = 1;
if(isset($data['selectpos']) && count($data['selectpos']) > 0) :
	foreach($data['selectpos'] as $select_pos) :
		$pos = (int) $select_pos['Posicion'];	
		$selected = (isset($data[$tabla]['ID']) && $data[$tabla]['ID'] == $select_pos['ID']) ? 'alert alert-info' : '';
		?>	
		<tr id="<?php echo $select_pos['ID']; ?>" class="<?php echo $selected; ?>">
			<td width="1" class="center"><?php echo $pos; ?></td>
			<td><?php echo $select_pos['Titulo']; ?></td>
		</tr>						
		<?php
		$i++;
	endforeach;
endif;
if(!isset($data[$tabla]['ID'])) :
	$posicion = $i;
	?>
	<tr id="<?php echo $i; ?>" class="alert alert-info">
		<td width="1" class="center"><?php echo $i; ?></td>
		<td>Nueva Secci&oacute;n</td>
	</tr>	
	<?php
endif;
?>
</table>
<input type="hidden" id="posicion" name="<?php echo $tabla; ?>[Posicion]" value="<?php echo $posicion; ?>">
<script type="text/javascript">
<!--//
url_sort = "<?php echo URL_CMS.$data['base_url'].'sortable'; ?>";	
sortable('sortable','posicion',url_sort);
//-->
</script>