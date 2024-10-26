<div class="col-lg-6 col-md-6 p-table-highlight m-b30">
    <div class="pricing-table-1 bg-yellow">
        <div class="ribbon">Recomendado</div>
        <div class="p-table-title">
            <h4 class="wt-title">
                Hago pocas búsquedas
            </h4>
        </div>
        <div class="p-table-inner">
            <?php if (empty($subs)) : ?>
                <div class="p-table-price">
                    <span>65 000</span>
                    <p>1 solo pago</p>
                </div>
            <?php endif; ?>
            <div class="p-table-list">
                <ul>
                    <li><i class="feather-check"></i>Acceso full a la plataforma</li>
                    <li><i class="feather-check"></i>Conoce nuestra metodología</li>
                    <li><i class="feather-check"></i>Hasta 3 candidatos</li>
                    <li><i class="feather-check"></i>Descarga los perfiles ETP</li>
                    <li><i class="feather-check"></i>Accede a video perfiles</li>
                    <li><i class="feather-check"></i>Accede a las notas de entrevistas</li>
                    <li><i class="feather-check"></i>Accede al score detallado</li>
                    <li><i class="feather-check"></i>Accede a las referencias del postulante</li>
                </ul>
            </div>
            <?php if (empty($subs)) : ?>
                <div class="p-table-btn">
                    <a href="<?php echo $urlPlan . '2'; ?>" class="site-button bg-yellow">Lo quiero</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>