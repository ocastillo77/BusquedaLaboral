<div class="btn-group">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell"></i>
    <?php if(isset($notifications) && count($notifications) > 0) : ?>
    <span class="count">8</span>
    <span class="circle"></span>
    <?php endif; ?>
  </a>
  <ul class="dropdown-menu" role="menu">
    <?php if(isset($notifications) && count($notifications) > 0) : ?>
    <li class="notification-header">
      <em>Usted tiene <?php echo count($notifications); ?> nuevas notificaciones</em>
    </li>
    <li>
      <a href="#">
        <i class="fa fa-comment green-font"></i>
        <span class="text">New comment on the blog post</span>
        <span class="timestamp">1 minute ago</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fa fa-user green-font"></i>
        <span class="text">New registered user</span>
        <span class="timestamp">12 minutes ago</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class="fa fa-shopping-cart red-font"></i>
        <span class="text">4 new sales order</span>
        <span class="timestamp">4 hours ago</span>
      </a>
    </li>   
    <li>
      <a href="#">
        <i class="fa fa-warning red-font"></i>
        <span class="text red-font">Low disk space!</span>
        <span class="timestamp">Oct 11</span>
      </a>
    </li>
    <li class="notification-footer">
      <a href="#">Ver todas las notificaciones</a>
    </li>
    <?php else: ?>
    <li class="notification-header">
      <em>No tiene notificaciones</em>
    </li>
    <?php endif; ?>
  </ul>
</div>