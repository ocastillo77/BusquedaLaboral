<?php
$tabla = 'usuarios';
$grupos = [
    1 => 'Solo',
    2 => 'En pareja',
    3 => 'Con Hijos',
];
$dispos = [
    1 => 'Part time',
    2 => 'Full time',
    3 => 'Franja Horaria',
];
$niveles = [
    1 => 'Primario Incompleto',
    2 => 'Primario Completo',
    3 => 'Secundario Incompleto',
    4 => 'Secundario Completo',
    5 => 'Universitario Incompleto',
    6 => 'Universitario Completo',
    7 => 'Posgrado',
    8 => 'Master',
    9 => 'Tecnicaturas',
];
$informatico = [
    1 => 'Bajo',
    2 => 'Medio',
    3 => 'Alto',
];
$niveldes = [
    1 => '- SI -',
    2 => '- NO -'
];
$textodes = [
    1 => '¿Cuáles?',
    2 => '¿A qué se debe?'
];
$trabajos = [
    'Administración',
    'Agricultura',
    'Alimentación y Bebidas',
    'Artes y Entretenimiento',
    'Automotriz',
    'Bienes Raíces',
    'Bienestar y Salud Mental',
    'Ciencias',
    'Comunicación y Medios',
    'Construcción',
    'Cuidado Infantil',
    'Deportes y Fitness',
    'Derecho',
    'Diseño',
    'Economía',
    'Educación',
    'Emprendimiento',
    'Energía',
    'Finanzas',
    'Gastronomía',
    'Hospitalidad',
    'Humanidades',
    'Ingeniería',
    'Logística',
    'Marketing',
    'Manufactura',
    'Moda y Belleza',
    'Recursos Humanos',
    'Salud',
    'Seguridad',
    'Servicios Comunitarios',
    'Servicios Sociales',
    'Tecnología',
    'Telecomunicaciones',
    'Transporte',
    'Turismo',
    'Ventas',
    'Veterinaria y Cuidado de Animales',
];
$descripcion = !empty($item['IsNivelDes']) && !empty($textos[$item['IsNivelDes']]) ? $textos[$item['IsNivelDes']] : '¿Cuáles?';
$css1 = !empty($item['GrupoFamiliar']) && $item['GrupoFamiliar'] == 3 ? '' : 'd-none';
$css2 = !empty($item['Disponibilidad']) && $item['Disponibilidad'] == 3 ? '' : 'd-none';

$alert = Session::get('alert-form');
$show = '';

if (!empty($alert)) {
    $show = 'data-show="1"';
    Session::pull('alert-form');
}

$item = !empty($data['candidato']) ? $data['candidato'] : [];
?>
<div class="twm-right-section-panel site-bg-gray">
    <div class="twm-pro-view-chart-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Primer Test</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        <div class="twm-dashboard-candidates-wrap">

                            <div class="panel-body wt-panel-body bg-white mb-0">
                                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="bloque1-tab" data-bs-toggle="tab" data-bs-target="#bloque1" type="button" role="tab" aria-controls="bloque1" aria-selected="true">Bloque 1</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="bloque2-tab" data-bs-toggle="tab" data-bs-target="#bloque2" type="button" role="tab" aria-controls="bloque2" aria-selected="false">Bloque 2</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="bloque3-tab" data-bs-toggle="tab" data-bs-target="#bloque3" type="button" role="tab" aria-controls="bloque3" aria-selected="false">Bloque 3</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="bloque4-tab" data-bs-toggle="tab" data-bs-target="#bloque4" type="button" role="tab" aria-controls="bloque4" aria-selected="false">Bloque 4</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <?php if (!empty($alert)) : ?>
                                        <div id="alert-message" class="mt-20 alert alert-<?php echo $alert['type']; ?> text-center" <?php echo $show; ?>><?php echo $alert['message']; ?></div>
                                    <?php endif; ?>
                                    <div class="tab-pane fade show active" id="bloque1" role="tabpanel" aria-labelledby="bloque1-tab">
                                        <?php include 'tab-test1.php'; ?>
                                    </div>
                                    <div class="tab-pane fade" id="bloque2" role="tabpanel" aria-labelledby="bloque2-tab">
                                        <?php include 'tab-test2.php'; ?>
                                    </div>
                                    <div class="tab-pane fade" id="bloque3" role="tabpanel" aria-labelledby="bloque3-tab">
                                        <?php include 'tab-test3.php'; ?>
                                    </div>
                                    <div class="tab-pane fade" id="bloque4" role="tabpanel" aria-labelledby="bloque4-tab">
                                        <?php include 'tab-test4.php'; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>