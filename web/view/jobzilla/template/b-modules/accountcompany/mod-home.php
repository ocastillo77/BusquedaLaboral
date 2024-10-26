
<?php
$totalJobs = count($data['jobs']);
$totalCandidates = count($data['candidatos']);
?>
<div class="twm-right-section-panel site-bg-gray">
    <div class="wt-admin-right-page-header">
        <h2><?php echo $user['Nombre']; ?></h2>
    </div>
    <div class="twm-dash-b-blocks mb-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body dashboard-card-2 block-gradient">
                        <div class="wt-card-wrap-2">
                            <div class="wt-card-icon-2"><i class="flaticon-job"></i></div>
                            <div class="wt-card-right wt-total-active-listing counter "><?php echo $totalJobs; ?></div>
                            <div class="wt-card-bottom-2 ">
                                <h4 class="m-b0">Mis Búsquedas</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 mb-3">
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body dashboard-card-2 block-gradient-2">
                        <div class="wt-card-wrap-2">
                            <div class="wt-card-icon-2"><i class="flaticon-resume"></i>
                            </div>
                            <div class="wt-card-right  wt-total-listing-view counter "><?php echo $totalCandidates; ?></div>
                            <div class="wt-card-bottom-2">
                                <h4 class="m-b0">Candidatos</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Búsquedas Recientes</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">
                            <div class="row">
                                <?php
                                if (!empty($data['jobs'])) :
                                    foreach ($data['jobs'] as $item) :
                                        $imagen = !empty($data['Imagen']) ? URL_GAL . 'busquedas/images/IM_' . $data['Imagen'] : '';
                                ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="twm-dash-candidates-list">
                                                <div class="twm-media">
                                                    <div class="twm-media-pic">
                                                        <img src="<?php echo $imagen; ?>" alt="<?php echo $data['Nombre']; ?>">
                                                    </div>
                                                </div>
                                                <div class="twm-mid-content">
                                                    <a href="#" class="twm-job-title">
                                                        <h4><?php echo $data['Nombre']; ?></h4>
                                                    </a>
                                                    <p><strong>Puesto: </strong><?php echo $data['Puesto']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endforeach;
                                else :
                                    ?>
                                    <div class="col-md-12 text-center">
                                        <p>No se encontraron resultados.</p>
                                    </div>
                                    <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>