<?php
$urlSave = URL_WEB . 'saveBloque/2';
$respuestas = $data['bloque2'];
?>
<form id="form-user" method="post" action="<?php echo $urlSave; ?>">
    <div class="twm-dashboard-candidates-wrap">       
        <div class="mb-3">
            <label class="form-label">Comente de alguna vez en que usted anticipó un problema</label>
            <textarea class="form-control" id="pregunta1" name="bloque2[0]" rows="5" style="height: 150px;"><?php echo !empty($respuestas[0]) ? $respuestas[0] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Has tenido la oportunidad de desempeñarte en algún trabajo haciendo lo que más disfruta?</label>
            <textarea class="form-control" id="pregunta2" name="bloque2[1]" rows="5" style="height: 150px;"><?php echo !empty($respuestas[1]) ? $respuestas[1] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Ha trabajado en equipo antes?</label>
            <textarea class="form-control" id="pregunta3" name="bloque2[2]" rows="5" style="height: 150px;"><?php echo !empty($respuestas[2]) ? $respuestas[2] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Usted prefiere una relación formal o informal con su equipo?</label>
            <textarea class="form-control" id="pregunta4" name="bloque2[3]" rows="5" style="height: 150px;"><?php echo !empty($respuestas[3]) ? $respuestas[3] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Cómo describiría su experiencia, en cuanto al trabajo en equipo?</label>
            <textarea class="form-control" id="pregunta5" name="bloque2[4]" rows="5" style="height: 150px;"><?php echo !empty($respuestas[4]) ? $respuestas[4] : ''; ?></textarea>
        </div>
        <div class="mb-4">
            <label class="form-label">Su rotación laboral, ha tenido significado más por la decisión de la empresa, ¿o por decisión suya?</label>
            <textarea class="form-control" id="pregunta6" name="bloque2[5]" rows="5" style="height: 150px;"><?php echo !empty($respuestas[5]) ? $respuestas[5] : ''; ?></textarea>
        </div>
        <div class="mb-4 text-right">
            <button class="btn btn-primary" type="submit">Guardar Bloque 2</button>
        </div>
    </div>
</form>