<?php
$mensaje = !empty($data['error']['message']) ? $data['error']['message'] : 'Por favor, complete sus datos';
$type = !empty($data['error']['type']) ? $data['error']['type'] : 'info';
$item = isset($data['info']) ? $data['info'] : [];
?> 
<!-- Signup -->
<section class="g-bg-gray-light-v5">
  <div class="container g-py-80">

    <div class="row">
      <div class="col-md-12">        
        <div class="row justify-content-center g-py-30">
          <div class="col-sm-10 col-md-9 col-lg-6">
            <div class="u-shadow-v21 g-bg-white rounded g-py-40 g-px-30">
              <header class="text-center mb-4">
                <h3 class="h2 g-color-black g-font-weight-600">Boletín de Noticias</h3>                    
              </header>     
              <?php
              if (Session::get('wb_news') == 'subscribe') :
                ?>
                <div class="suscribe">
                  <p class="font-weight-bold text-center"><?php echo $data['subscribe']; ?></p>
                  <div class="text-center">
                    <a href="<?php echo URL_WEB; ?>" class="btn btn-md u-btn-primary rounded g-py-13 g-px-25">Volver al Inicio</a>
                  </div>
                </div>
                <?php
              else:
                ?>
                <!-- Form -->
                <form id="form-register" action="<?php echo URL_WEB . 'subscribe'; ?>" method="post">
                  <div class="g-mt-15 text-center alert alert-<?php echo $type; ?>"><?php echo $mensaje; ?></div>
                  <input type="hidden" id="register" name="subscribe" value="1" />

                  <div class="mb-4">
                    <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Nombre:</label>
                    <input id="nombre" name="usuarios[Nombre]" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text"
                           value="<?php echo isset($item['Nombre']) ? $item['Nombre'] : ''; ?>" required>
                  </div>

                  <div class="mb-4">
                    <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Correo Electrónico:</label>
                    <input id="email" name="usuarios[Email]" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="email"
                           value="<?php echo isset($item['Email']) ? $item['Email'] : ''; ?>" required>
                  </div>

                  <div class="mb-4 text-right">
                    <button class="btn btn-md u-btn-primary rounded g-py-13 g-px-25" type="submit">Suscribirse</button>
                  </div>
                </form>
                <!-- End Form -->
              <?php
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- End Signup -->

