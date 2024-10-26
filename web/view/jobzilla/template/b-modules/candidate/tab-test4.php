<?php
$respuestas = $data['bloque4'];
?>
<div class="twm-dashboard-candidates-wrap">
    <div class="mb-3">
        <label class="form-label">¿Si en el trabajo surge una situación de cambio repentino o una tarea nunca antes realizada, acudes al superior para informar de lo que está sucediendo?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[0]) ? $respuestas[0] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Consideras que el reconocimiento por parte de los demás es importante para ti en tu trabajo. Podrías explicar tu respuesta</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[1]) ? $respuestas[1] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Describe habilidades y capacidades con la que cuentas y tuviste que poner en práctica en alguna situación atravesada. Como fue el paso a paso de tu planificación</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[2]) ? $respuestas[2] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">El establecer límites con los demás, crees que conlleva a un impedimento de contacto, ¿en la que no suma en la relación con tus compañeros?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[3]) ? $respuestas[3] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Respecto de tu punto de vista, ¿crees que la impulsividad es una habilidad efectiva en las personas?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[4]) ? $respuestas[4] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Te ha sucedido que no hayas podido lograr tus objetivos inmediatamente?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[5]) ? $respuestas[5] : ''; ?></textarea>
    </div>
    <div class="mb-4">
        <label class="form-label">¿Prefieres que otros tomen las decisiones?</label>
        <textarea class="form-control" rows="5" style="height: 150px;" disabled><?php echo !empty($respuestas[6]) ? $respuestas[6] : ''; ?></textarea>
    </div>
</div>