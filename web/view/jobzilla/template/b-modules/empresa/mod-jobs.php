<!-- FEATURED Cities SECTION START -->
<?php
$examples[] = [
  'Nombre' => 'Francisco Pérez',
  'Imagen' => 'candidates/pic1.jpg',
  'Provincia' => 'Mendoza',
  'Ocupacion' => 'Contador',
  'ShowImage' => 1,
  'IsTest' => 1
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

if (!empty($data['candidatos'])) :
?>
  <div class="section-full p-t120 p-b90 p-l60 p-r60 site-bg-white twm-featured-city-carousal-area">
    <div class="section-content bg-yellow p-t40 p-b10">
      <div class="section-header">
        <!-- TITLE START-->
        <div class="wt-separator-two-part ">
          <div class="row wt-separator-two-part-row">
            <div class="col-xl-7 col-lg-7 col-md-12 wt-separator-two-part-left">
              <!-- TITLE START-->
              <div class="section-head left wt-small-separator-outer">
                <h3 class="wt-title site-text-custom">Buscadores de Oportunidades</h3>
              </div>
              <!-- TITLE END-->
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-right text-right">
              <a href="" class=" site-button">Ver todos</a>
            </div>
          </div>
        </div>
        <!-- TITLE END-->
      </div>
      <div class="twm-featured-city-carousal-wrap">
        <div class="owl-carousel twm-featured-city-carousal">
          <?php
          foreach ($data['candidatos'] as $item) :
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
            <div class="item">
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
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
endif;
?>