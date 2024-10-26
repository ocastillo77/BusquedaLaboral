<div class="col-lg-6 col-md-6 m-b30">
    <div class="pricing-table-1 bg-yellow">
        <div class="p-table-title">
            <h4 class="wt-title">
                Estoy Viendo
            </h4>
        </div>
        <div class="p-table-inner">
            <?php if (empty($subs)) : ?>
                <div class="p-table-price">
                    <span>25 000</span>
                    <p>1 solo pago</p>
                </div>
            <?php endif; ?>
            <div class="p-table-list">
                <ul>
                    <li><i class="feather-check"></i>Acceso inicial a la plataforma</li>
                    <li><i class="feather-check"></i>Conoce nuestra metodología</li>
                    <li><i class="feather-check"></i>Acceso a candidatos modelo</li>
                    <li class="disable"><i class="feather-x"></i>Descarga los perfiles ETP</li>
                    <li class="disable"><i class="feather-x"></i>Accede a video perfiles</li>
                    <li class="disable"><i class="feather-x"></i>Accede a las notas de entrevistas</li>
                    <li class="disable"><i class="feather-x"></i>Accede al score detallado</li>
                    <li class="disable"><i class="feather-x"></i>Accede a las referencias del postulante</li>
                </ul>
            </div>
            <?php if (empty($subs)) : ?>
                <div class="p-table-btn">
                    <a href="<?php echo $urlPlan . '1'; ?>" class="site-button bg-yellow">Lo quiero</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>