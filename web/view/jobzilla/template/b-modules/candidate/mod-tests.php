<?php
$urltest = URL_WEB . 'candidate/' . $user['ID'] . '/test/1';
$fechaIni = date('d/m/Y');
$fechaFutura = new DateTime();
$fechaFutura->modify('+30 days');
$fechaFin = $fechaFutura->format('d/m/Y');
?>
<div class="twm-right-section-panel site-bg-gray">
    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Tests</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">

                            <div class="table-responsive">
                                <table class="table twm-table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="<?php echo $urltest; ?>">Primer Test</a></td>
                                            <td class="text-center"><a href="<?php echo $urltest; ?>"><?php echo $fechaIni; ?></a></td>
                                            <td class="text-center">
                                                <a href="<?php echo $urltest; ?>" class="btn btn-primary">Ver</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>