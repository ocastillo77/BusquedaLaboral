<div class="widget">
  <h3>Categorías</h3>    
  <?php echo $data['menu_cat']; ?>
</div><!-- End .widget -->
<?php if (isset($data['marcas'])) : ?>
  <div class="widget">
    <h3>Marcas</h3>   
    <form id="form-marca" method="post">
      <?php
      foreach ($data['marcas'] as $item) :
        ?>
        <label><input type="checkbox" name="marca" value="<?php echo $item['ID']; ?>"><?php echo $item['Nombre']; ?></label><br>
        <?php
      endforeach;
      ?>
    </form>
  </div>
  <?php
endif;

include 'mod-recientes.php';
