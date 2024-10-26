<!-- main -->
<div class="content">
  <div class="main-content">
    <!-- WIDGET MAIN CHART WITH TABBED CONTENT -->
    <div class="widget">
      <div class="widget-header">
        <h3><i class="fa fa-bar-chart-o"></i> Estadísticas de Visitas</h3>
        <em>- Visitas y Tráfico de Origen</em>
      </div>
      <div class="widget-content">
        <!-- chart tab nav -->
        <div class="chart-nav">
          <strong>Seleccione periodo:</strong>
          <ul id="sales-stat-tab">
            <li class="active"><a href="#week">Semana</a>
            </li>
            <li><a href="#month">Mes</a>
            </li>
            <li><a href="#year">Año</a>
            </li>
          </ul>
        </div>
        <!-- end chart tab nav -->

        <!-- chart placeholder-->
        <div class="chart-content">
          <div class="demo-flot-chart sales-chart"></div>
        </div>
        <!-- end chart placeholder-->

        <hr class="separator">

        <!-- secondary stat -->
        <div class="secondary-stat">
          <div class="row">
            <div class="col-lg-4">
              <div id="secondary-stat-item1" class="secondary-stat-item big-number-stat clearfix">
                <div class="data">
                  <span class="col-left big-number"><?php echo isset($data['usuarios']) ? $data['usuarios'] : 0; ?></span>
                  <span class="col-right">
                    <em>Registro de Usuarios</em>                    
                  </span>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div id="secondary-stat-item2" class="secondary-stat-item big-number-stat clearfix">
                <p class="data">
                  <span class="col-left big-number"><?php echo isset($data['empresas']) ? $data['empresas'] : 0; ?></span>
                  <span class="col-right">
                    <em>Registro de Empresas</em>                    
                  </span>
                </p>
              </div>
            </div>
            <div class="col-lg-4">
              <div id="secondary-stat-item3" class="secondary-stat-item big-number-stat clearfix">
                <p class="data">
                  <span class="col-left big-number"><?php echo isset($data['visitas']) ? $data['visitas'] : 0; ?></span>
                  <span class="col-right">
                    <em>Total Visitas</em>                    
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- end secondary stat -->
      </div>
    </div>
    <!-- END WIDGET MAIN CHART WITH TABBED CONTENT -->
  </div>
  <!-- /main-content -->
</div>
<!-- /main -->
<script>
  $(document).ready(function () {
    var visit_week = [<?php echo isset($data['visit_wek']) ? $data['visit_wek'] : ''; ?>];
    var visit_month = [<?php echo isset($data['visit_month']) ? $data['visit_month'] : ''; ?>];
    var visit_year = [<?php echo isset($data['visit_year']) ? $data['visit_year'] : ''; ?>];

    if ($('.sales-chart').length > 0) {
      var $placeholder = $('.sales-chart');
      $placeholder.attr('data-ctype', '#week');
      chartWeek('.sales-chart', visit_week);

      $('#sales-stat-tab a').click(function (e) {
        e.preventDefault();
        var $chartType = $(this).attr('href');
        $('#sales-stat-tab li').removeClass('active');
        $(this).parents('li').addClass('active');
        
        if ($chartType == '#week') {
          chartWeek($placeholder, visit_week);
        } else if ($chartType == '#month') {
          chartMonth($placeholder, visit_month);
        } else if ($chartType == '#year') {
          chartYear($placeholder, visit_year);
        }
        
        $placeholder.attr('data-ctype', $chartType);
      });
    }
  });
</script>