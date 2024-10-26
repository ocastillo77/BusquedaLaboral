<div class="vtab-min" id="tabs">
  <?php
  $count = (isset($data['parrafo']) && count($data['parrafo'])) ? count($data['parrafo']) : 1;

  for ($i = 1; $i < ($count + 1); $i++) :
    $css = ($i == 1) ? 'selected' : '';
    ?>	
    <a class="<?php echo $css; ?>" href="#tab_<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php
  endfor;
  ?>
  <span id="new-tab" onclick="createTab('<?php echo URL_CMS . $route['controller'] . '/clonar'; ?>')" title="Nuevo P&aacute;rrafo" alt="Nuevo P&aacute;rrafo">
    <i class="fa fa-chevron-down"></i>
  </span>
</div>  
<?php
for ($i = 1; $i < ($count + 1); $i++) :
  $data['cur'] = $i;
  ?>
  <div id="tab_<?php echo $i; ?>" class="vtab-min-content">	
    <?php include('mod-parrafo.php'); ?>
  </div>  
  <?php
endfor;
?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#tabs a').tabs();
  });
</script>
