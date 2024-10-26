<div class="btn-group">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope"></i>
    <?php if(isset($emails) && count($emails) > 0) : ?>
    <span class="count">2</span>
    <span class="circle"></span>
    <?php endif; ?>
  </a>

  <ul class="dropdown-menu" role="menu">
    <?php if(isset($emails) && count($emails) > 0) : ?>
    <li class="notification-header">
      <em>Usted tiene <?php echo count($emails); ?> mensajes sin leer</em>
    </li>
    <li class="inbox-item clearfix">
      <a href="#">
        <div class="media">
          <div class="pull-left" href="#">
            <img class="media-object" src="<?php echo CMS_IMG; ?>user1.png" alt="Antonio">
          </div>
          <div class="media-body">
            <h5 class="media-heading name">Antonius</h5>
            <p class="text">The problem just happened this morning. I can't see ...</p>
            <span class="timestamp">4 minutes ago</span>
          </div>
        </div>
      </a>
    </li>
    <li class="inbox-item unread clearfix">
      <a href="#">
        <div class="media">
          <div class="pull-left" href="#">
            <img class="media-object" src="<?php echo CMS_IMG; ?>user2.png" alt="Antonio">
          </div>
          <div class="media-body">
            <h5 class="media-heading name">Michael</h5>
            <p class="text">Hey dude, cool theme!</p>
            <span class="timestamp">2 hours ago</span>
          </div>
        </div>
      </a>
    </li>   
    <li class="notification-footer">
      <a href="#">Ver todos los mensajes</a>
    </li>
    <?php else: ?>
    <li class="notification-header">
      <em>No tiene mensajes</em>
    </li>
    <?php endif; ?>
  </ul>
</div>