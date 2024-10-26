<?php
?>
<div class="twm-right-section-panel site-bg-gray">
    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Mis Tests</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">

                            <div class="table-responsive">
                                <table class="table twm-table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th width="1" class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Fecha Creación</th>
                                            <th class="text-center">Fecha Finalización</th>
                                            <th class="text-center">Completado</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($data['tests'])) :
                                            foreach ($data['tests'] as $item):
                                                $url = URL_WEB . 'account/test/' . $item['ID'];
                                                $fechaIni = $item['TimeCreate'];
                                                $fechaFutura = new DateTime($fechaIni);
                                                $fechaFutura->modify('+30 days');
                                                $fechaFin = $fechaFutura->format('d/m/Y');
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td><a href="<?php echo $url; ?>"><?php echo $item['Nombre']; ?></a></td>
                                                    <td class="text-center"><a href="<?php echo $url; ?>"><?php echo Helper::dateTimeFormat($fechaIni, 'd/m/Y'); ?></a></td>
                                                    <td class="text-center"><a href="<?php echo $url; ?>"><?php echo $fechaFin; ?></a></td>
                                                    <td class="text-center"><a href="<?php echo $url; ?>"><?php echo $data['complete']; ?></a></td>
                                                    <td class="text-center">
                                                        <?php $linkText = $data['complete'] == 'SI' ? 'Ver' : 'Completar'; ?>
                                                        <a href="<?php echo $url; ?>" class="btn btn-primary"><?php echo $linkText; ?></a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            endforeach;
                                        else :
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No se encontraron resultados</td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?>
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