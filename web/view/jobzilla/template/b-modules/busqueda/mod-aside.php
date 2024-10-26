<?php
$rangoFechas = [
  1 => 'Últimas 24 horas',
  7 => 'Últimos 7 días',
  14 => 'Últimos 14 días',
  30 => 'Últimos 30 días',
];

$urlClean = URL_WEB . 'busqueda';
?>
<div class="side-bar">
  <div class="sidebar-elements search-bx">
    <form id="form-filter" method="get">
      <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">Área Laboral</h4>
        <select name="area" class="wt-select-bar-large selectpicker" data-live-search="true" data-bv-field="size">
          <option value="">- Todas -</option>
          <?php
          if (!empty($data['trabajos'])) :
            foreach ($data['trabajos'] as $item) :
              $selected = $item['ID'] == $data['area'] ? 'selected="selected"' : '';
          ?>
              <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
          <?php
            endforeach;
          endif;
          ?>
        </select>
      </div>
      <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">Palabra Clave</h4>
        <div class="input-group">
          <input name="key" type="text" class="form-control" placeholder="Buscar" value="<?php echo $data['key']; ?>">
          <button class="btn" type="button"><i class="feather-search"></i></button>
        </div>
      </div>
      <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">Ubicación</h4>
        <select name="province[]" class="wt-select-bar-large selectpicker" data-live-search="true" data-bv-field="size" data-none-selected-text="- Todas -" multiple>
          <?php
          if (!empty($data['provincias'])) :
            foreach ($data['provincias'] as $item) :
              $selected = !empty($data['province']) && in_array($item['ID'], $data['province']) ? 'selected="selected"' : '';
          ?>
              <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
          <?php
            endforeach;
          endif;
          ?>
        </select>
      </div>
      <div class="twm-sidebar-ele-filter">
        <h4 class="section-head-small mb-4">Disponibilidad</h4>
        <select name="time" class="wt-select-bar-large selectpicker" data-live-search="true" data-bv-field="size">
          <option value="">- Todas -</option>
          <?php
          if (!empty($data['disponibilidad'])) :
            foreach ($data['disponibilidad'] as $item) :
              $selected = $item['ID'] == $data['time'] ? 'selected="selected"' : '';
          ?>
              <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
          <?php
            endforeach;
          endif;
          ?>
        </select>
      </div>

      <div class="twm-sidebar-ele-filter">
        <h4 class="section-head-small mb-4">Rango de Fechas</h4>
        <select name="date" class="wt-select-bar-large selectpicker" data-live-search="true" data-bv-field="size">
          <option value="">- Todas -</option>
          <?php
          if (!empty($rangoFechas)) :
            foreach ($rangoFechas as $key => $value) :
              $selected = $item['ID'] == $data['date'] ? 'selected="selected"' : '';
          ?>
              <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
          <?php
            endforeach;
          endif;
          ?>
        </select>
      </div>
      <div class="text-right">
        <a href="<?php echo $urlClean; ?>" class="site-button bg-yellow">Limpiar</a>
        <button type="submit" class="site-button bg-fucsia">Buscar</button>
      </div>
    </form>
  </div>
</div>
<div class="twm-advertisment" style="background-image:url(<?php echo URL_IMG; ?>add-bg.jpg);">
  <div class="overlay"></div>
  <h3 class="twm-title">¿Buscas trabajo?</h3>
  <p>Crea una cuenta en nuestra plataforma y accede a un nuevo mundo de oportunidades!</p>
  <a href="<?php echo URL_WEB . 'register'; ?>" class="site-button white">Registrarme</a>
</div>