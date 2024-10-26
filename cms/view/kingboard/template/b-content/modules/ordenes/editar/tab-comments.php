<?php
$url_comment = URL_CMS . 'ordenes/addcomment';
?>
<div class="col-md-12">
  <div class="widget widget-scrolling">
    <div class="widget-header">
      <h3><i class="fa fa-comment"></i> Lista de Comentarios</h3>
    </div>
    <div id="comment-wrap" class="widget-content">
      <?php
      ?>
      <ul id="box-comments" class="list-unstyled slack-messages">
        <?php
        if (count($data['comentarios']) > 0) :
          foreach ($data['comentarios'] as $fecha => $list) :
            $date = Helper::formatDateLarge($fecha);
            ?>
            <li class="day-separator">
              <span><?php echo $date; ?></span>
            </li>
            <?php
            foreach ($list as $item) :
              $hora = Helper::dateTimeFormat($item['TimeCreate'], 'H:i:s');
              ?>
              <li>
                <img src="<?php echo CMS_IMG . 'avatar_v1.png'; ?>" alt="<?php echo $item['Usuario']; ?>" 
                     class="img-circle pull-left avatar">
                <div class="text clearfix">
                  <span class="username"><?php echo $item['Usuario']; ?></span>
                  <span class="timestamp"><?php echo $hora; ?></span>
                  <p class="message"><?php echo $item['Comentario']; ?></p>
                </div>
              </li>
              <?php
            endforeach;
          endforeach;
        else :
          ?>
          <li id="mssgenull"class="text-center">No se encontraron mensajes</li>
        <?php
        endif;
        ?>
      </ul>
    </div>
    <div class="widget-footer">
      <!--input id="comentario" class="form-control textarea-chat" placeholder="Escriba un comentario"-->
      <textarea id="comentario" rows="2" class="form-control textarea-chat" placeholder="Escriba un comentario"></textarea>
      <div class="text-right m-top-10">
        <!--a href="" class="btn btn-info btn-sm">Adjuntar Archivo</a-->
        <div id="config-comment" data-ordenid="<?php echo $data[$tabla]['ID']; ?>" 
             data-url="<?php echo $url_comment; ?>"></div>
        <a id="btn-addcomment" onclick="addComment('comentario');" 
           class="btn btn-primary btn-sm">Enviar Comentario</a>
      </div>
    </div>
  </div>  
</div>
