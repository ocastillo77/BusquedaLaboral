<?php
$tabla = 'usuarios';
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : '';
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$item = !empty($data['candidato']) ? $data['candidato'] : [];
$user = $data['candidato'];

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
$textos = [
  1 => '¿Cuáles?',
  2 => '¿A qué se debe?'
];
$sexo = [
  1 => 'Masculino',
  2 => 'Femenino'
];

$descripcion = !empty($item['IsNivelDes']) && !empty($textos[$item['IsNivelDes']]) ? $textos[$item['IsNivelDes']] : '¿Cuáles?';
$css1 = !empty($item['GrupoFamiliar']) && $item['GrupoFamiliar'] == 3 ? '' : 'd-none';
$css2 = !empty($item['Disponibilidad']) && $item['Disponibilidad'] == 3 ? '' : 'd-none';
?>
<div class="twm-right-section-panel site-bg-gray">
  <div class="twm-pro-view-chart-wrap">
    <div class="row">
      <div class="col-lg-12 col-md-12 mb-4">
        <div class="panel panel-default">
          <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-tittle m-a0">Mi Perfil</h4>
          </div>
          <div class="panel-body wt-panel-body bg-white">
            <div id="message" class="text-center"></div>
            <div class="twm-dashboard-candidates-wrap">
              <div class="mb-3">
                <label class="form-label">Nombre y Apellido:</label>
                <input class="form-control" type="text" value="<?php echo !empty($item['Nombre']) ? $item['Nombre'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">DNI:</label>
                <input class="form-control" type="text" value="<?php echo !empty($item['DNI']) ? $item['DNI'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Correo Electrónico:</label>
                <input class="form-control" type="email" value="<?php echo !empty($item['Email']) ? $item['Email'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Teléfono:</label>
                <input class="form-control" type="text" value="<?php echo !empty($item['Celular']) ? $item['Celular'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Sexo:</label>
                <input class="form-control" type="text" value="<?php echo !empty($item['Sexo']) ? $sexo[$item['Sexo']] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento:</label>
                <input type="text" class="form-control" value="<?php echo !empty($item['FechaNac']) ? $item['FechaNac'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Edad:</label>
                <input type="number" class="form-control" value="<?php echo !empty($item['Edad']) ? $item['Edad'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Dirección:</label>
                <input type="text" class="form-control" value="<?php echo !empty($item['Direccion']) ? $item['Direccion'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Provincia:</label>
                <input type="text" class="form-control"value="<?php echo !empty($item['Provincia']) ? $item['Provincia'] : ''; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Localidad / Departamento:</label>
                <input type="text" class="form-control" value="<?php echo !empty($item['Localidad']) ? $item['Localidad'] : ''; ?>" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
