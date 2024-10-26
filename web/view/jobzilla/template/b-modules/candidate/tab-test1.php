<div class="twm-dashboard-candidates-wrap">
    <div class="mb-3">
        <label class="form-label">Grupo Familiar Conviviente:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['GrupoFamiliar']) ? $grupos[$item['GrupoFamiliar']] : ''; ?>" disabled>
    </div>
    <div id="box-hijos" class="mb-3 <?php echo $css1; ?>">
        <label class="form-label">Nro. Hijos:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['Hijos']) ? $item['Hijos'] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Ocupación Actual:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['Ocupacion']) ? $item['Ocupacion'] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Disponibilidad Horaria:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['Disponibilidad']) ? $dispos[$item['Disponibilidad']] : ''; ?>" disabled>
    </div>
    <div id="box-horario" class="mb-3 <?php echo $css2; ?>">
        <label class="form-label">Franja Horaria:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['Horario']) ? $item['Horario'] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nivel de estudios alcanzados:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['NivelEdu']) ? $niveles[$item['NivelEdu']] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Puesto de trabajo que buscas:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['Puesto']) ? $item['Puesto'] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Rubro o área laboral en el que te gusta trabajar:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['AreaL']) ? $trabajos[$item['AreaL']] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Si el área laboral en el que deseas trabajar no se encuentra en las opciones anteriores por favor completa:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['AreaO']) ? $item['AreaO'] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Rubro en el que has tenido mayor experiencia laboral:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['AreaE']) ? $item['AreaE'] : ''; ?>" disabled>
    </div>
    <div class="mb-4">
        <label class="form-label">Nivel de manejo informático:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['NivelInfor']) ? $informatico[$item['NivelInfor']] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">¿Se propone niveles de desempeño a sí mismo?:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['IsNivelDes']) ? $niveldes[$item['IsNivelDes']] : ''; ?>" disabled>
    </div>
    <div class="mb-3">
        <label id="label-nivel" class="form-label"><?php echo $descripcion; ?>:</label>
        <input type="text" class="form-control" value="<?php echo !empty($item['NivelDes']) ? $item['NivelDes'] : ''; ?>" disabled>
    </div>
</div>