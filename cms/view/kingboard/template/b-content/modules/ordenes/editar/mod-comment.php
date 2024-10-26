<?php if (isset($data['Fecha'])) : ?>
  <li class="day-separator">
    <span><?php echo $data['Fecha']; ?></span>
  </li>
<?php endif; ?>
<li>
  <img src="<?php echo CMS_IMG . 'avatar_v1.png'; ?>" alt="<?php echo $data['Usuario']; ?>" 
       class="img-circle pull-left avatar">
  <div class="text clearfix">
    <span class="username"><?php echo $data['Usuario']; ?></span>
    <span class="timestamp"><?php echo $data['Hora']; ?></span>
    <p class="message"><?php echo $data['Comentario']; ?></p>
  </div>
</li>