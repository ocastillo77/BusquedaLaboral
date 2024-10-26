<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : '';
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$post = isset($data['info']) ? $data['info'] : [];
$rUser = isset($data['user']) ? $data['user'] : false;
$rError = isset($data['errors']) ? $data['errors'] : false;
?>
<div class="section-full p-t120  p-b90 site-bg-white">
  <div class="container">
    <div class="twm-right-section-panel site-bg-gray">
      <div class="twm-pro-view-chart-wrap">
        <div class="row">
          <div class="col-lg-12 col-md-12 mb-4">
            <div class="panel panel-default">
              <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">Proceso de Pago</h4>
              </div>
              <div class="panel-body wt-panel-body bg-white">
                <div class="twm-dashboard-candidates-wrap">
                  <?php include 'step4.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>