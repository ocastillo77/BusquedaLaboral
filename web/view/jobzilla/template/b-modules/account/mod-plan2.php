<div class="col-lg-6 col-md-6 p-table-highlight m-b30">
    <div class="pricing-table-1 bg-yellow">
        <div class="ribbon">Descuento 30%</div>
        <div class="p-table-title">
            <h4 class="wt-title">
                Búsqueda Inmediata
            </h4>
        </div>
        <div class="p-table-inner">
            <?php if (empty($subs)) : ?>
                <div class="p-table-price">
                    <div class="price-prev">antes <div class="tachado">ARS 32500</div></div>
                    <span class="currency">ARS</span> <span class="price">25000</span>
                </div>
            <?php endif; ?>
            <div class="p-table-list">
                <ul>
                    <li><i class="feather-check"></i>Acceso full a la plataforma</li>
                    <li><i class="feather-check"></i>Entrevistas con profesionales</li>
                    <li><i class="feather-check"></i>Construcción de perfil ETP</li>
                    <li><i class="feather-check"></i>Las empresas te buscan en nuestra plataforma</li>
                    <li class="disable"><i class="feather-x"></i>Creación de video perfil</li>
                    <li class="disable"><i class="feather-x"></i>Posición destacada digital</li>
                    <li class="disable"><i class="feather-x"></i>Servicio de acompañamiento profesional durante la búsqueda</li>
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