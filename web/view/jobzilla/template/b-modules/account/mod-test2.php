<?php
$totalPreguntas = count($data['preguntas']);
$totalPorBloque = 25;
$totalBloques = ceil($totalPreguntas / $totalPorBloque);
$urlSave = URL_WEB . 'saveBloqueTest/';

$alert = Session::get('alert-form');
$show = '';

if (!empty($alert)) {
    $show = 'data-show="1"';
    Session::pull('alert-form');
}
?>
<div class="twm-pro-view-chart-wrap">
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="panel panel-default">
                <div class="panel-heading wt-panel-heading p-a20">
                    <h4 class="panel-tittle m-a0">Mi Primer Test</h4>
                </div>
                <div class="panel-body wt-panel-body bg-white mb-0">
                    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="intro-tab" data-bs-toggle="tab" data-bs-target="#intro" type="button" role="tab">Introducción</button>
                        </li>
                        <?php
                        for ($i = 1; $i <= $totalBloques; $i++) :
                            $activeClass = ''; //($i == 1) ? 'active' : '';
                        ?>
                            <li class='nav-item' role='presentation'>
                                <button class="nav-link <?php echo $activeClass ?>" id="bloque<?php echo $i ?>-tab" data-bs-toggle="tab" data-bs-target="#bloque<?php echo $i ?>" type="button" role="tab">Bloque <?php echo $i ?></button>
                            </li>
                        <?php
                        endfor;
                        ?>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php if (!empty($alert)) : ?>
                            <div id="alert-message" class="mt-20 alert alert-<?php echo $alert['type']; ?> text-center" <?php echo $show; ?>><?php echo $alert['message']; ?></div>
                        <?php endif; ?>
                        <div class="tab-pane fade show active" id="intro" role="tabpanel">
                            <div class="twm-dashboard-candidates-wrap">
                                <h5>Acerca del Test</h5>
                                <p><?php echo $data['testActual']['Descripcion'] ?></p>
                            </div>
                        </div>
                        <?php
                        $preguntasPorBloque = array_chunk($data['preguntas'], $totalPorBloque);
                        foreach ($preguntasPorBloque as $indice => $bloque) {
                            $bloqueNum = $indice + 1;
                            $activeClass = ''; //($bloqueNum == 1) ? 'show active' : '';
                        ?>
                            <div class="tab-pane fade <?php echo $activeClass; ?>" id="bloque<?php echo $bloqueNum; ?>" role="tabpanel">
                                <form id="formBloque<?php echo $bloqueNum; ?>" onsubmit="return validateForm(<?php echo $bloqueNum; ?>)" method="post" action="<?php echo $urlSave . $bloqueNum; ?>">
                                    <div class="twm-dashboard-candidates-wrap">
                                        <?php
                                        foreach ($bloque as $pregunta) {
                                            $respuestaGuardada = isset($data['respuestas'][$pregunta['ID']]) ? $data['respuestas'][$pregunta['ID']] : null;
                                        ?>
                                            <div class="mb-3 form-control-test">
                                                <label class="form-label" style="display: block;"><?php echo $pregunta['Numero'] . '. ' . $pregunta['Texto']; ?></label>
                                                <div class="input-li">
                                                    <input type="radio" name="respuesta[<?php echo $pregunta['ID']; ?>]" value="1" <?php echo ($respuestaGuardada === '1' ? 'checked' : ''); ?> required> Verdadero
                                                </div>
                                                <div class="input-li">
                                                    <input type="radio" name="respuesta[<?php echo $pregunta['ID']; ?>]" value="0" <?php echo ($respuestaGuardada === '0' ? 'checked' : ''); ?> required> Falso
                                                </div>
                                                <span class="error-message">Seleccione una opción</span>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <input type="hidden" name="bloque" value="<?php echo $bloqueNum; ?>">
                                        <div class="mb-4 text-right">
                                            <button class="btn btn-primary" type="submit">Guardar Bloque <?php echo $bloqueNum; ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>