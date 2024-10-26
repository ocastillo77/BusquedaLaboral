<?php
$subs = $data['subscripcion'];
$textPlan = !empty($subs) ? 'Te mostramos las caracteristicas del plan contratado:' : 'Selecciona el plan que se adapte a tus necesidades:';
$urlUpPlan = URL_WEB . 'checkout/';
$urlDownPlan = URL_WEB . 'unsubscribe/';
$planActivo = !empty($subs['PlanID']) ? $subs['PlanID'] : 0;
?>
<div class="twm-right-section-panel site-bg-gray">
    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Mi Subscripción</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">
                            <p class="text-center"><?php echo $textPlan; ?></p>
                            <div class="pricing-block-outer">
                                <div class="account-subs row justify-content-center">
                                    <?php
                                    foreach ($data['planes'] as $plan):
                                        $selected = false;
                                        $textDiscount = '';
                                        $textButton = 'Quiero este Plan';
                                        $urlPlan = $urlUpPlan;
                                        $colorButton = 'bg-yellow';
                                        $colorBox = 'bg-yellow';

                                        if (!empty($plan['PrecioAnt'])) {
                                            $discount = Helper::calculateDiscount($plan['PrecioAnt'], $plan['Precio']);
                                            $textDiscount = 'Descuento ' . $discount . '%';
                                        }

                                        if ($planActivo === $plan['ID']) {
                                            $selected = true;
                                            $textButton = 'Dar de baja';
                                            $urlPlan = $urlDownPlan;
                                            $colorButton = 'bg-danger text-white';
                                            $colorBox = 'bg-fucsia';
                                        }

                                        $urlPlan .= $plan['ID'];
                                        $display = $plan['ID'] < $planActivo ? 'disnone' : '';
                                    ?>
                                        <div class="col-lg-6 col-md-6 p-table-highlight m-b30 <?php echo $display; ?>">
                                            <div class="pricing-table-1 <?php echo $colorBox; ?>">
                                                <?php if (!$selected && !empty($textDiscount)) : ?>
                                                    <div class="ribbon"><?php echo $textDiscount; ?></div>
                                                <?php endif; ?>
                                                <div class="p-table-title">
                                                    <h4 class="wt-title"><?php echo $plan['Nombre']; ?></h4>
                                                </div>
                                                <div class="p-table-inner">
                                                    <?php if (empty($selected)) : ?>
                                                        <div class="p-table-price">
                                                            <?php if (!empty($plan['PrecioAnt'])) : ?>
                                                                <div class="price-prev">antes
                                                                    <div class="tachado">ARS <?php echo $plan['PrecioAnt']; ?></div>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="price-prev">
                                                                    <div class="tachado">&nbsp;</div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <span class="currency">ARS</span> <span class="price"><?php echo $plan['Precio']; ?></span>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="p-table-price">
                                                            <div class="price-prev">
                                                                <div class="tachado">&nbsp;</div>
                                                            </div>
                                                            <span class="price">Plan Contratado</span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="p-table-list">
                                                        <?php include 'plan-desc' . $plan['ID'] . '.php'; ?>
                                                    </div>
                                                    <div class="p-table-btn">
                                                        <a href="<?php echo $urlPlan; ?>" class="site-button <?php echo $colorButton; ?>"><?php echo $textButton; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>