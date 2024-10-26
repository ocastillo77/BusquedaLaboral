<div id="config-form" data-url="<?php echo URL_WEB . 'sendcontact' ?>"
     data-captcha="<?php echo URL_WEB . 'changecaptcha' ?>"></div>
<div class="bg-full">
  <div class="center-hv text-center rectdom">
    <img src="<?php echo URL_IMG; ?>loader100.gif" alt="Enviando" width="80"/>
    <h3>Enviando!</h3>
    <p>Por favor, espere...</p>
  </div>
</div>
<div id="alert-text"></div>
<form id="form-contact" method="post">
  <input type="hidden" id="enviar" name="enviar" value="1">
  <div class="row">
    <div class="col-md-12 form-group g-mb-20">
      <label class="g-color-gray-dark-v2 g-font-size-13">Nombre y Apellido:</label>
      <input id="nombre" name="nombre" class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text">
    </div>

    <div class="col-md-12 form-group g-mb-20">
      <label class="g-color-gray-dark-v2 g-font-size-13">Correo Electrónico:</label>
      <input id="email" name="email" class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="email">
    </div>

    <div class="col-md-12 form-group g-mb-20">
      <label class="g-color-gray-dark-v2 g-font-size-13">Teléfono:</label>
      <input id="telefono" name="telefono" class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="tel">
    </div>

    <div class="col-md-12 form-group g-mb-20">
      <label class="g-color-gray-dark-v2 g-font-size-13">Consulta:</label>
      <textarea id="consulta" name="consulta" class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7"></textarea>
    </div>    
  </div>
  <div class="row form-group g-mb-40">
    <div class="col-md-7 g-mb-20">
      <div class="d-inline-block">
        <img id="captcha-img" class="captcha-img" src="<?php echo $data['captcha']; ?>">
      </div>
      <div class="d-inline-block">                                
        <input type="text" class="w-135 form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus rounded-3 g-py-13 g-px-15" id="captcha" name="captcha" 
               placeholder="Copie el Código" autocomplete="off">
      </div>
    </div>
    <div class="col-md-5 text-right">
      <button class="btn u-btn-primary btn-block rounded-3 g-py-12 g-px-20" onclick="$('#form-contact').submit();" role="button">Enviar Consulta</button>
    </div>
  </div>
</form>