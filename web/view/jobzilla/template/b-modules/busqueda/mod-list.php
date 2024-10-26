<?php
$count = !empty($data['candidatos']) && !empty($data['candidatos']['items']) ? count($data['candidatos']['items']) : 0;
?>
<div class="twm-right-section-panel site-bg-cyan">
    <div class="product-filter-wrap d-flex justify-content-between align-items-center">
        <span class="woocommerce-result-count-left">Mostrando <?php echo $count; ?> Candidatos</span>
        <form id="form-order" class="woocommerce-ordering twm-filter-select" method="get">
            <input type="hidden" name="area" value="<?php echo $data['area']; ?>">
            <input type="hidden" name="key" value="<?php echo $data['key']; ?>">
            <input type="hidden" name="time" value="<?php echo $data['time']; ?>">
            <input type="hidden" name="date" value="<?php echo $data['date']; ?>">
            <input type="hidden" id="page" name="page" value="<?php echo $data['page']; ?>" />
            <?php if (!empty($data['province'])): ?>
                <?php foreach ($data['province'] as $province): ?>
                    <input type="hidden" name="province[]" value="<?php echo $province; ?>">
                <?php endforeach; ?>
            <?php endif; ?>

            <span class="woocommerce-result-count">Ordenar Por</span>
            <select name="order" class="wt-select-bar-2 form-select" onchange="$('#form-order').submit();">
                <option value="recent">Mas recientes</option>
                <?php
                if (!empty($data['disponibilidad'])) :
                    foreach ($data['disponibilidad'] as $item) :
                        $selected = $item['ID'] == $data['order'] ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </form>
    </div>

    <div class="twm-candidates-grid-wrap">
        <div class="row">
            <?php
            if (!empty($data['candidatos']) && !empty($data['candidatos']['items'])) :
                foreach ($data['candidatos']['items'] as $item) :
                    $nofoto = $item['Sexo'] == 1 ? 'male.png' : 'female.png';
                    $image = !empty($item['Imagen']) ? URL_GAL . 'usuarios/images/IM_' . $item['Imagen'] : URL_IMG . $nofoto;
                    $puesto = !empty($item['Puesto']) ? $item['Puesto'] : '-';
                    $nivelEdu = !empty($item['TNivelEdu']) ? $item['TNivelEdu'] : '-';
                    $nombre = Helper::getFirstLastName($item['Nombre']);
                    $urlCandidato = URL_WEB . 'candidate/' . $item['ID'] . '/profile';
                    $disponibilidad = '-';

                    if (!empty($item['Disponibilidad'])) {
                        $disponibilidad = $item['Disponibilidad'] == 'Franja Horaria' ? $item['Horario'] : $item['TDisponibilidad'];
                    }
            ?>
                    <div class="col-lg-4 col-md-4">
                        <div class="twm-candidates-grid-style1 mb-5">
                            <div class="twm-media">
                                <div class="twm-media-pic pic-home">
                                    <img src="<?php echo $image; ?>" alt="#">
                                </div>
                            </div>
                            <div class="twm-mid-content">
                                <a href="#" class="twm-job-title">
                                    <h4><?php echo $nombre; ?></h4>
                                </a>
                                <div class="twm-candidates-tag">
                                    <div class="label-primary"><?php echo $puesto; ?></div>
                                    <div class="description">
                                        <ul>
                                            <li><strong>Nivel de estudios:</strong> <?php echo $nivelEdu; ?></li>
                                            <li><strong>Disponibilidad horaria:</strong> <?php echo $disponibilidad; ?></li>
                                            <li><strong>Departamento:</strong> <?php echo $item['Localidad']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="twm-fot-content">
                                    <div class="twm-left-info">
                                        <p class="twm-candidate-address text-fucsia"><i class="feather-map-pin"></i><?php echo $item['Provincia']; ?></p>
                                        <?php if (Session::get('em_user_id')): ?>
                                            <a href="<?php echo $urlCandidato; ?>" class="twm-view-prifile text-fucsia" target="_blank">Ver Perfil</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            else :
                ?>
                <div class="col-md-12">
                    <div class="twm-candidates-grid-style1 mb-5">
                        <p class="text-center">No se encontraron resultados</p>
                    </div>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
    <div class="pagination-outer">
        <div class="pagination-style1 text-center">
            <?php
            if (!empty($data['candidatos']) && !empty($data['candidatos']['links'])) :
                echo $data['candidatos']['links'];
            endif;
            ?>
        </div>
    </div>
</div>