<div class="col-lg-6 col-md-6 m-b30">
    <div class="pricing-table-1 bg-fucsia">
        <div class="p-table-title">
            <h4 class="wt-title">
                Busco Seguido
            </h4>
        </div>
        <div class="p-table-inner">
            <?php if (empty($subs)) : ?>
                <div class="p-table-price">
                    <span>$ 800K</span>
                    <p>1 cuota anual</p>
                </div>
            <?php endif; ?>
            <div class="p-table-list">
                <ul>
                    <li><i class="feather-check"></i>Acceso full a la plataforma</li>
                    <li><i class="feather-check"></i>Cantidad ilimitada de candidatos</li>
                    <li><i class="feather-check"></i>Descarga los perfiles ETP</li>
                    <li><i class="feather-check"></i>Accede a video perfiles</li>
                    <li><i class="feather-check"></i>Creación de video perfil</li>
                    <li><i class="feather-check"></i>Accede a las notas de entrevistas</li>
                    <li><i class="feather-check"></i>Accede al score detallado</li>
                    <li><i class="feather-check"></i>Accede a las referencias del postulante</li>
                </ul>
            </div>
            <?php if (empty($subs)) : ?>
                <div class="p-table-btn">
                    <a href="<?php echo $urlPlan . '3'; ?>" class="site-button bg-fucsia">Lo quiero</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>