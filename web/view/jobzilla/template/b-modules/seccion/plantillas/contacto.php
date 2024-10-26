<?php
$config = $data['config'];
$direccion = $config['Direccion'];
$localidad = $config['Localidad'];
$provincia = $config['Provincia'];
$telefono = $config['Telefono'];
$celular = $config['Movil'];
$email = $config['Email'];
$email2 = $config['Email2'];
$email3 = $config['Email3'];
$email4 = $config['Email4'];
$cbu = $config['CBU'];
$latitud = !empty($config['Latitud']) ? $config['Latitud'] : '-32.8895526';
$longitud = !empty($config['Longitud']) ? $config['Longitud'] : '-68.8470213';
?>
<section class="container g-pt-50 g-pb-40">
  <div class="row justify-content-between">
    <div class="col-md-6 g-mb-40">
      <?php include 'mod-form.php'; ?>
    </div>
    <div class="col-md-5">
      <div class="mb-4">
        <h2 class="h5 g-color-gray-dark-v2 g-font-weight-600">Dirección:</h2>
        <p class="g-color-gray-dark-v4">
          <span class="">
            <?php echo $direccion . ', ' . $localidad . ', ' . $provincia; ?>
          </span>
        </p>
      </div>

      <div class="mb-4">
        <h2 class="h5 g-color-gray-dark-v2 g-font-weight-600">Correo Electrónico:</h2>
        <p class="g-color-gray-dark-v4 mb-0"><span class=""><?php echo $email; ?></span></p>
        <p class="g-color-gray-dark-v4 mb-0"><span class=""><?php echo $email2; ?></span></p>
        <p class="g-color-gray-dark-v4 mb-0"><span class=""><?php echo $email3; ?></span></p>
        <p class="g-color-gray-dark-v4 mb-0"><span class=""><?php echo $email4; ?></span></p>
      </div>

      <div class="mb-3">
        <h2 class="h5 g-color-gray-dark-v2 g-font-weight-600">Teléfono 1:</h2>
        <p class="g-color-gray-dark-v4"><span class=""><?php echo $telefono; ?></span></p>
      </div>

      <div class="mb-3">
        <h2 class="h5 g-color-gray-dark-v2 g-font-weight-600">Teléfono 2:</h2>
        <p class="g-color-gray-dark-v4"><span class=""><?php echo $celular; ?></span></p>
      </div>

      <div class="mb-3">
        <h2 class="h5 g-color-gray-dark-v2 g-font-weight-600">CBU:</h2>
        <p class="g-color-gray-dark-v4"><span class=""><?php echo $cbu; ?></span></p>
      </div>

      <?php if (isset($data['redes'])) : ?>
        <!-- Figure Social Icons -->
        <ul class="list-inline g-mt-30">
          <?php
          foreach ($data['redes'] as $item) :
            ?>
            <li class="list-inline-item">
              <a target="_blank" class="u-icon-v1 g-color-white g-bg-gray-dark-v2 g-color-white--hover g-bg-primary--hover rounded-circle" href="<?php echo $item['URL']; ?>">
                <i class="g-font-size-default fab <?php echo $item['Icono']; ?>"></i>
              </a>
            </li>
            <?php
          endforeach;
          ?>
        </ul>
        <!-- End Figure Social Icons -->
      <?php endif; ?>
    </div>
  </div>
</section>