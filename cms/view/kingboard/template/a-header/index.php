<!DOCTYPE html>
<html lang="es" class="no-js">
  <head>
    <title>Escritorio | WebAdmin 3.0 - Administrador Web</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="WebAdmin 3.0 - Administrador Web">
    <meta name="author" content="Oscar Castillo - Idea Creativa">
    <!-- CSS -->
    <link href="<?php echo CMS_CSS; ?>bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>chosen/chosen.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>treetable/css/jquery.treetable.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>jqueryui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CMS_CSS; ?>jquery.tagmanager.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_CSS; ?>bootstrap-timepicker.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CMS_JS; ?>plugins/bootstrap-toggle/css/bootstrap-toggle.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CMS_CSS; ?>main.css?v=<?php echo rand(); ?>" rel="stylesheet" type="text/css">
    <!-- Fav and touch icons -->
    <link href="<?php echo CMS_IMG; ?>ico/webadmin-favicon144x144.png" rel="apple-touch-icon-precomposed" sizes="144x144">
    <link href="<?php echo CMS_IMG; ?>ico/webadmin-favicon114x114.png" rel="apple-touch-icon-precomposed" sizes="114x114">
    <link href="<?php echo CMS_IMG; ?>ico/webadmin-favicon72x72.png" rel="apple-touch-icon-precomposed" sizes="72x72">
    <link href="<?php echo CMS_IMG; ?>ico/webadmin-favicon57x57.png" rel="apple-touch-icon-precomposed" sizes="57x57">
    <link href="<?php echo CMS_IMG; ?>ico/favicon.png" rel="shortcut icon">
    <!-- Javascript -->
    <script src="<?php echo CMS_JS; ?>common/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/modernizr.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/king-common.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/stat/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/raphael-2.1.0.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/stat/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/stat/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/stat/flot/jquery.flot.time.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/stat/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/stat/flot/jquery.flot.tooltip.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/datatable/jquery.dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.mapael.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/maps/usa_states.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/king-chart-stat.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/king-table.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/king-components.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/ajaxupload/js/AjaxUpload.2.0.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.chosen.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/fancybox/source/helpers/jquery.fancybox-media.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.swfobject.1-1-1.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/tinymce/config.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/dropzone.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.charcount.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.treetable.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>common/jquery.tabs.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/tablednd/js/jquery.tablednd.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/tagmanager/jquery.tagmanager.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>plugins/bootstrap-toggle/js/bootstrap-toggle.js" type="text/javascript"></script>
    <script src="<?php echo CMS_JS; ?>main.js?v=<?php echo rand(); ?>"  type="text/javascript"></script>
    <script>
      function initMap() {}
    </script>
  </head>
  <?php if ($route['controller'] != 'login') : ?>
    <body class="dashboard">
      <!-- WRAPPER -->
      <div class="wrapper">
        <?php
        include 'alerts.php';
        include 'topbar.php';
      else :
        ?>
        <body>
          <!-- WRAPPER -->
          <div class="full-page-wrapper page-login text-center">
          <?php endif; ?>