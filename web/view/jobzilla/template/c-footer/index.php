<!-- FOOTER START -->
<footer class="footer-dark" style="background-image: url(<?php echo URL_IMG; ?>f-bg.jpg);">
  <div class="container">
    <!-- FOOTER COPYRIGHT -->
    <div class="footer-bottom">
      <div class="footer-bottom-info">
        <div class="footer-copy-right">
          <span class="copyrights-text">Copyright &copy; 2024. Encuentra Tu Puesto.</span>
        </div>
        <ul class="list-terms">
          <li><a href="<?php echo URL_WEB . 'seccion/politica-de-privacidad' ?>" target="_blank">Política de Privacidad</a></li>
          <li><a href="<?php echo URL_WEB . 'seccion/terminos-y-condiciones-de-uso' ?>" target="_blank">Términos y Condiciones de Uso</a></li>
          <li><a href="<?php echo URL_WEB . 'seccion/terminos-y-condiciones-generales-de-contratacion' ?>" target="_blank">Condiciones de Contratación</a></li>
        </ul>
        <ul class="social-icons">
          <li><a href="https://www.facebook.com/encuentratupuestocom" class="fab fa-facebook-f" target="_blank"></a></li>
          <li><a href="https://www.instagram.com/encuentratupuestocom" class="fab fa-instagram" target="_blank"></a></li>
          <li><a href="javascript:void(0);" class="fab fa-youtube"></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!-- FOOTER END -->
<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>
<!--Model Popup Section Start-->
<!--Signup popup -->
<div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" aria-labelledby="sign_up_popupLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h2 class="modal-title" id="sign_up_popupLabel">Registro</h2>
          <p>Regístrate y obtén acceso a todas las funciones de nuestra plataforma.</p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="twm-tabs-style-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <!--Signup Candidate-->
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sign-candidate" type="button"><i class="fas fa-user-tie"></i>Candidatos</button>
              </li>
              <!--Signup Employer-->
              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sign-Employer" type="button"><i class="fas fa-building"></i>Empresas</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <!--Signup Candidate Content-->
              <div class="tab-pane fade show active" id="sign-candidate">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="username" type="text" required="" class="form-control" placeholder="Nombre y Apellido">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="email" type="email" class="form-control" required="" placeholder="Correo Electrónico">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="password" type="text" class="form-control" required="" placeholder="Contraseña">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="password" type="text" class="form-control" required="" placeholder="Repetir Contraseña">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="phone" type="text" class="form-control" required="" placeholder="Teléfono">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <div class="row">
                        <div class="form-check col-lg-6">
                          <input type="checkbox" class="form-check-input" id="agree1">
                          <label class="form-check-label" for="agree1">Acepto los <a href="javascript:;">términos y condiciones</a></label>
                        </div>
                        <p class="col-lg-6 text-right">¿Estás registrado?
                          <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Iniciar Sesión</button>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="site-button">Registrarse</button>
                  </div>
                </div>
              </div>
              <!--Signup Employer Content-->
              <div class="tab-pane fade" id="sign-Employer">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="username" type="text" required="" class="form-control" placeholder="Nombre y Apellido">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="email" type="text" class="form-control" required="" placeholder="Correo Electrónico">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="password" type="text" class="form-control" required="" placeholder="Contraseña">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="password" type="text" class="form-control" required="" placeholder="Repetir Contraseña">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="phone" type="text" class="form-control" required="" placeholder="Teléfono">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <div class="row">
                        <div class="form-check col-lg-6">
                          <input type="checkbox" class="form-check-input" id="agree1">
                          <label class="form-check-label" for="agree1">Acepto los <a href="javascript:;">términos y condiciones</a></label>
                        </div>
                        <p class="col-lg-6 text-right">¿Estás registrado?
                          <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Iniciar Sesión</button>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="site-button">Registrarse</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Login popup -->
<div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" aria-labelledby="sign_up_popupLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h2 class="modal-title" id="sign_up_popupLabel2">Iniciar Sesión</h2>
          <p>Inicie sesión y obtenga acceso a todas las funciones de nuestra plataforma.</p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="twm-tabs-style-2">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
              <!--Login Candidate-->
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login-candidate" type="button"><i class="fas fa-user-tie"></i>Candidatos</button>
              </li>
              <!--Login Employer-->
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#login-Employer" type="button"><i class="fas fa-building"></i>Empresas</button>
              </li>
            </ul>
            <div class="tab-content" id="myTab2Content">
              <!--Login Candidate Content-->
              <div class="tab-pane fade show active" id="login-candidate">
                <div class="row">

                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="username" type="email" required="" class="form-control" placeholder="Correo Electrónico">
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="password" type="text" class="form-control" required="" placeholder="Contraseña">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <div class=" form-check">
                        <input type="checkbox" class="form-check-input" id="Password3">
                        <label class="form-check-label rem-forgot" for="Password3">Recordarme <a href="javascript:;">Recuperar Contraseña</a></label>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="site-button">Ingresar</button>
                    <div class="mt-3 mb-3">¿No tenés una cuenta?
                      <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Registrarse</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--Login Employer Content-->
              <div class="tab-pane fade" id="login-Employer">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="username" type="email" required="" class="form-control" placeholder="Correo Electrónico">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <input name="password" type="text" class="form-control" required="" placeholder="Contraseña*">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group mb-3">
                      <div class=" form-check">
                        <input type="checkbox" class="form-check-input" id="Password4">
                        <label class="form-check-label rem-forgot" for="Password4">Recordarme <a href="javascript:;">Recuperar Contraseña</a></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="site-button">Ingresar</button>
                    <div class="mt-3 mb-3">¿No tenés una cuenta?
                      <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Registrarse</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Model Popup Section End-->
</div>
<?php
if (!empty($data['planActivo'])) :
?>
  <a href="https://wa.me/542612696432?text=Hola!%20Me%20gustaría%20realizar%20una%20consulta" class="whatsapp zio" target="_blank">
    <i class="fab fa-whatsapp whatsapp-icon"></i>
  </a>
<?php
endif;
?>
<div id="config" data-addcart="<?php echo URL_WEB . 'addcart'; ?>" data-countcart="<?php echo URL_WEB . 'countcart'; ?>" data-removecart="<?php echo URL_WEB . 'removecart'; ?>" data-updateshop="<?php echo URL_WEB . 'updateshop'; ?>" data-removeshop="<?php echo URL_WEB . 'removeshop'; ?>" data-urldeptos="<?php echo URL_WEB . 'departamentos'; ?>" data-css1="<?php echo URL_CSS; ?>bootstrap.min.css" data-css2="<?php echo URL_CSS; ?>style.css" data-css3="<?php echo URL_CSS; ?>custom.css"></div>
<!-- JAVASCRIPT  FILES ========================================= -->
<script src="<?php echo URL_JS; ?>jquery-3.6.0.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?php echo URL_JS; ?>ajaxupload/js/AjaxUpload.2.0.js"></script>
<script src="<?php echo URL_JS; ?>fancybox/source/jquery.fancybox.js"></script>
<script src="<?php echo URL_JS; ?>fancybox/source/helpers/jquery.fancybox-media.js"></script>
<script src="<?php echo URL_JS; ?>popper.min.js"></script><!-- POPPER.MIN JS -->
<script src="<?php echo URL_JS; ?>bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo URL_JS; ?>magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script src="<?php echo URL_JS; ?>waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script src="<?php echo URL_JS; ?>counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="<?php echo URL_JS; ?>waypoints-sticky.min.js"></script><!-- STICKY HEADER -->
<script src="<?php echo URL_JS; ?>isotope.pkgd.min.js"></script><!-- MASONRY  -->
<script src="<?php echo URL_JS; ?>imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
<script src="<?php echo URL_JS; ?>owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
<script src="<?php echo URL_JS; ?>theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
<script src="<?php echo URL_JS; ?>lc_lightbox.lite.js"></script><!-- IMAGE POPUP -->
<script src="<?php echo URL_JS; ?>bootstrap-select.min.js"></script><!-- Form js -->
<script src="<?php echo URL_JS; ?>dropzone.js"></script><!-- IMAGE UPLOAD  -->
<script src="<?php echo URL_JS; ?>jquery.scrollbar.js"></script><!-- scroller -->
<script src="<?php echo URL_JS; ?>bootstrap-datepicker.js"></script><!-- scroller -->
<script src="<?php echo URL_JS; ?>jquery.dataTables.min.js"></script><!-- Datatable -->
<script src="<?php echo URL_JS; ?>dataTables.bootstrap5.min.js"></script><!-- Datatable -->
<script src="<?php echo URL_JS; ?>chart.js"></script><!-- Chart -->
<script src="<?php echo URL_JS; ?>bootstrap-slider.min.js"></script><!-- Price range slider -->
<script src="<?php echo URL_JS; ?>swiper-bundle.min.js"></script><!-- Swiper JS -->
<script src="<?php echo URL_JS; ?>fileUploader.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<script src="<?php echo URL_JS; ?>custom.js?v=<?php echo rand(); ?>"></script><!-- CUSTOM FUCTIONS  -->
</body>

</html>