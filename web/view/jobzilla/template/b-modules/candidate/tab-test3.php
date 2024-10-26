<?php
$respuestas = $data['bloque3'];
?>
<div class="twm-dashboard-candidates-wrap">
    <div class="mb-3">
        <label class="form-label">¿Cuál sería su objetivo a lograr en un nuevo puesto de trabajo?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[0]) ? $respuestas[0] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Podría describir cómo aplicó un proceso de toma de decisiones para enfrentar una situación crítica en la que tuvo que considerar múltiples factores y opciones, y cómo gestionó la presión emocional y las consecuencias potenciales de su elección final?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[1]) ? $respuestas[1] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Cuáles son sus objetivos a largo plazo más importantes?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[2]) ? $respuestas[2] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Cuando debe trabajar por primera vez con alguien, ¿Cómo averigua su estilo de trabajo, sus virtudes y defectos?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[3]) ? $respuestas[3] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Realizas Ejercicio Físico?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[4]) ? $respuestas[4] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Qué acciones específicas ha tomado usted en el último año para desafiarse a sí mismo y salir de su zona de confort, aprender nuevas habilidades y conocimientos, establecer metas desafiantes y trabajar sistemáticamente para lograrlas, y buscar oportunidades para contribuir significativamente al crecimiento y éxito de su organización o comunidad?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[5]) ? $respuestas[5] : ''; ?></textarea>
    </div>
    <div class="mb-4">
        <label class="form-label">¿Cómo te mantienes motivado y enfocado en tus objetivos a largo plazo durante períodos de cambio y transición?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[6]) ? $respuestas[6] : ''; ?></textarea>
    </div>
</div>