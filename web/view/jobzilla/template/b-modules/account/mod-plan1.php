<div class="col-md-6 m-b30">
    <div class="pricing-table-1 bg-yellow">
        <div class="p-table-title">
            <h4 class="wt-title">
                En Búsqueda
            </h4>
        </div>
        <div class="p-table-inner">
            <?php if (empty($subs)) : ?>
                <div class="p-table-price">
                    <div class="price-prev"><div class="tachado">&nbsp;</div></div>
                    <span class="currency">ARS</span> <span>5000</span>
                </div>
            <?php endif; ?>
            <div class="p-table-list">
                <ul>
                    <li><i class="feather-check"></i>Acceso inicial a la plataforma</li>
                    <li><i class="feather-check"></i>Acceso a la guía ETP</li>
                    <li class="disable"><i class="feather-x"></i>Construcción de perfil ETP</li>
                    <li class="disable"><i class="feather-x"></i>Las empresas te buscan en nuestra plataforma</li>
                    <li class="disable"><i class="feather-x"></i>Creación de video perfil</li>
                    <li class="disable"><i class="feather-x"></i>Posición destacada digital</li>
                    <li class="disable"><i class="feather-x"></i>Servicio de acompañamiento profesional durante la búsqueda</li>
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