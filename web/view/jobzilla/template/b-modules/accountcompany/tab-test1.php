<?php
$urlSave = URL_WEB . 'saveProfile/1';
?>
<form id="form-user" method="post" action="<?php echo $urlSave; ?>">
    <div class="twm-dashboard-candidates-wrap">
        <div class="mb-3">
            <label class="form-label">Grupo Familiar Conviviente:</label>
            <select id="grupofamiliar" name="<?php echo $tabla; ?>[GrupoFamiliar]" onchange="changeGrupo(this.value);" class="form-select">
                <?php
                if (!empty($grupos)) :
                    foreach ($grupos as $key => $value) :
                        $selected = !empty($item['GrupoFamiliar']) && $item['GrupoFamiliar'] == $key ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div id="box-hijos" class="mb-3 <?php echo $css1; ?>">
            <label class="form-label">Nro. Hijos:</label>
            <select id="hijos" name="<?php echo $tabla; ?>[Hijos]" class="form-select">
                <?php
                for ($i = 1; $i <= 10; $i++) :
                    $selected = $item['Hijos'] == $i ? 'selected="selected"' : '';
                ?>
                    <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                <?php
                endfor;
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ocupación Actual:</label>
            <input type="text" class="form-control" id="ocupacion" name="<?php echo $tabla; ?>[Ocupacion]" value="<?php echo !empty($item['Ocupacion']) ? $item['Ocupacion'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Disponibilidad Horaria:</label>
            <select id="disponibilidad" name="<?php echo $tabla; ?>[Disponibilidad]" onchange="changeDispo(this.value)" class="form-select">
                <?php
                if (!empty($dispos)) :
                    foreach ($dispos as $key => $value) :
                        $selected = !empty($item['Disponibilidad']) && $item['Disponibilidad'] == $key ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div id="box-horario" class="mb-3 <?php echo $css2; ?>">
            <label class="form-label">Franja Horaria:</label>
            <input type="text" class="form-control" id="horario" name="<?php echo $tabla; ?>[Horario]" value="<?php echo !empty($item['Horario']) ? $item['Horario'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nivel de estudios alcanzados:</label>
            <select id="niveledu" name="<?php echo $tabla; ?>[NivelEdu]" class="form-select">
                <?php
                if (!empty($niveles)) :
                    foreach ($niveles as $key => $value) :
                        $selected = !empty($item['NivelEdu']) && $item['NivelEdu'] == $key ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Puesto de trabajo que buscas:</label>
            <input type="text" class="form-control" id="Puesto" name="<?php echo $tabla; ?>[Puesto]" value="<?php echo !empty($item['Puesto']) ? $item['Puesto'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Rubro o área laboral en el que te gusta trabajar:</label>
            <select id="trabajos" name="<?php echo $tabla; ?>[AreaL]" class="form-select">
                <option value="">- Seleccione -</option>
                <?php
                if (!empty($trabajos)) :
                    foreach ($trabajos as $key => $value) :
                        $selected = !empty($item['AreaL']) && $item['AreaL'] == $key ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Si el área laboral en el que deseas trabajar no se encuentra en las opciones anteriores por favor completa:</label>
            <input type="text" class="form-control" id="areao" name="<?php echo $tabla; ?>[AreaO]" value="<?php echo !empty($item['AreaO']) ? $item['AreaO'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Rubro en el que has tenido mayor experiencia laboral:</label>
            <input type="text" class="form-control" id="AreaE" name="<?php echo $tabla; ?>[AreaE]" value="<?php echo !empty($item['AreaE']) ? $item['AreaE'] : ''; ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Nivel de manejo informático:</label>
            <select id="nivelinfor" name="<?php echo $tabla; ?>[NivelInfor]" class="form-select">
                <?php
                if (!empty($informatico)) :
                    foreach ($informatico as $key => $value) :
                        $selected = !empty($item['NivelInfor']) && $item['NivelInfor'] == $key ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Se propone niveles de desempeño a sí mismo?:</label>
            <select id="isNivelDes" name="<?php echo $tabla; ?>[IsNivelDes]" onchange="changeNivel(this.value);" class="form-select">
                <?php
                if (!empty($niveldes)) :
                    foreach ($niveldes as $key => $value) :
                        $selected = !empty($item['IsNivelDes']) && $item['IsNivelDes'] == $key ? 'selected="selected"' : '';
                ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label id="label-nivel" class="form-label"><?php echo $descripcion; ?>:</label>
            <input type="text" class="form-control" id="niveldes" name="<?php echo $tabla; ?>[NivelDes]" value="<?php echo !empty($item['NivelDes']) ? $item['NivelDes'] : ''; ?>">
        </div>
        <div class="mb-4 text-right">
            <button class="btn btn-primary" type="submit">Guardar Bloque 1</button>
        </div>
    </div>
</form>