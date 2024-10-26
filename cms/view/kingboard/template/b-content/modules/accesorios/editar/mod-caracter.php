<?php
$objetos = ['', 'checkbox.php', 'select.php', 'select_db.php', 'input.php', 'textarea.php'];

if (isset($data['categorias'])) :
  foreach ($data['categorias'] as $item) :
    ?>
    <div class="col-md-12">
      <div class="widget">
        <div class="widget-header">
          <h3><i class="fa fa-info-circle"></i> <?php echo $item['Nombre']; ?></h3>
        </div>
        <div class="widget-content">   
          <div class="row">
            <?php
            $i = 0;
            foreach ($item['campos'] as $campo) :
              $info['name'] = 'caracter[' . $campo['Campo'] . ']';
              $info['id'] = strtolower($campo['Campo']);
              $info['value'] = isset($data['caracter'][$campo['Campo']]) ? $data['caracter'][$campo['Campo']] : '';
              $info['datainfo'] = $campo['datainfo'];
              $titulo = str_replace('[', '<sup>', $campo['Titulo']);
              $titulo = str_replace(']', '</sup>', $titulo);

              if ($i % 4 == 0) {
                echo '</div><div class="row">';
              }
              ?>
              <div class="form-group col-md-3">
                <label class="control-label"><?php echo $titulo; ?>:</label>
                <div class="">
                  <?php
                  if (!empty($objetos[$campo['ObjetoID']])) :
                    include 'objetos/' . $objetos[$campo['ObjetoID']];
                  endif;
                  ?>
                </div>
              </div>
              <?php
              $i++;
            endforeach;
            ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <?php
  endforeach;
endif;
?>