<ul class="nav nav-tabs">
  <li class="active"><a href="#tab_general" data-toggle="tab">General</a></li>
  <li><a href="#tab_history">Actividad</a></li>
  <li><a href="#tab_comments">Comentarios</a></li>  
</ul>
<div class="tab-content">
  <div class="tab-pane fade in active" id="tab_general">
    <form id="form" method="post">
      <input type="hidden" name="actualizar" value="1">
      <?php include('tab-general.php'); ?>
    </form>
  </div>      
  <div class="clear"></div>   
  <div class="tab-pane fade in" id="tab_history">
    <?php include('tab-history.php'); ?>	
  </div>    
  <div class="clear"></div>      
  <div class="tab-pane fade in" id="tab_comments">
    <?php include('tab-comments.php'); ?>	
  </div>    
  <div class="clear"></div>        
</div>
<?php
include('mod-modal.php');
