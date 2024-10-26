<?php

?>
<div class="twm-right-section-panel site-bg-gray">
    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Candidatos</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">

                            <div class="table-responsive">
                                <table id="list-candidates" class="table twm-table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre y Apellido</th>
                                            <th class="text-center">Postulación</th>
                                            <th class="text-center">Nivel de Estudios</th>
                                            <th class="text-center">Disponibilidad Horaria</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($data['candidatos'])) :
                                            $i = 1;
                                            foreach ($data['candidatos'] as $item) :
                                                $nofoto = $item['Sexo'] == 1 ? 'male.png' : 'female.png';
                                                $image = !empty($item['Imagen']) ? URL_GAL . 'usuarios/images/IM_' . $item['Imagen'] : URL_IMG . $nofoto;
                                                $puesto = !empty($item['Puesto']) ? $item['Puesto'] : '-';
                                                $nivelEdu = !empty($item['TNivelEdu']) ? $item['TNivelEdu'] : '-';
                                                $urlCandidato = URL_WEB . 'candidate/' . $item['ID'] . '/profile';
                                                $urlTests = URL_WEB . 'candidate/' . $item['ID'] . '/tests';
                                                $disponibilidad = '-';

                                                if (!empty($item['Disponibilidad'])) {
                                                    $disponibilidad = $item['Disponibilidad'] == 'Franja Horaria' ? $item['Horario'] : $item['TDisponibilidad'];
                                                }
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td class="text-left"><?php echo $item['Nombre']; ?></td>
                                                    <td class="text-center"><?php echo $puesto; ?></td>
                                                    <td class="text-center"><?php echo $nivelEdu; ?></td>
                                                    <td class="text-center"><?php echo $disponibilidad; ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo $urlCandidato; ?>" target="_blank" class="btn btn-primary btn-sm">Ver Perfil</a>
                                                        <a href="<?php echo $urlTests; ?>" target="_blank" class="btn btn-success btn-sm">Ver Tests</a>
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