<?php
$tabla = 'direccion';
$urlPais = URL_CMS . 'propiedades/provincias/';
$urlProv = URL_CMS . 'propiedades/departamentos/';
$urlLoc = URL_CMS . 'propiedades/localidades/';
//
$latitud = $data[$tabla]['Latitud'] = !empty($data[$tabla]['Latitud']) ? $data[$tabla]['Latitud'] : '-32.8895526';
$longitud = $data[$tabla]['Longitud'] = !empty($data[$tabla]['Longitud']) ? $data[$tabla]['Longitud'] : '-68.8470213';

$title_prov = isset($data[$tabla]['PaisID']) && $data[$tabla]['PaisID'] == 43 ? 'Región:' : 'Provincia:';
$title_dpto = isset($data[$tabla]['PaisID']) && $data[$tabla]['PaisID'] == 43 ? 'Provincia:' : 'Departamento:';
$title_loc = isset($data[$tabla]['PaisID']) && $data[$tabla]['PaisID'] == 43 ? 'Comuna:' : 'Localidad:';
?>
<div class="col-md-8">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-info-circle"></i> Contenido</h3>
    </div>
    <div class="widget-content">     
      <input type="hidden" name="<?php echo $tabla; ?>[ID]" value="<?php echo (isset($data[$tabla]['ID']) && !empty($data[$tabla]['ID'])) ? $data[$tabla]['ID'] : 0; ?>">			
      <div class="form-group">
        <label class="control-label">País:</label>
        <div class="controls">
          <select id="paises" name="<?php echo $tabla; ?>[PaisID]" onchange="changePais(this.value);" data-rel="chosen">                							
            <option value="0">- Seleccione -</option>            
            <?php
            if (isset($data['paises']) && count($data['paises']) > 0) :
              foreach ($data['paises'] as $item):
                $selected = $data[$tabla]['PaisID'] == $item['ID'] ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" id="title_prov"><?php echo $title_prov; ?></label>
        <div class="controls">
          <select id="provincia" name="<?php echo $tabla; ?>[ProvinciaID]" onchange="changeProvincia(this.value);" data-rel="chosen">                							
            <option value="0">- Seleccione -</option>            
            <?php
            if (isset($data['provincias']) && count($data['provincias']) > 0) :
              foreach ($data['provincias'] as $item):
                $selected = ($data[$tabla]['ProvinciaID'] == $item['ID']) ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" id="title_dpto"><?php echo $title_dpto; ?></label>
        <div class="controls">
          <select id="departamento" name="<?php echo $tabla; ?>[DepartamentoID]" data-rel="chosen">                							
            <option value="0">- Seleccione -</option>            
            <?php
            if (isset($data['departamentos']) && count($data['departamentos']) > 0) :
              foreach ($data['departamentos'] as $item):
                $selected = ($data[$tabla]['DepartamentoID'] == $item['ID']) ? 'selected="selected"' : '';
                ?>								
                <option value="<?php echo $item['ID']; ?>" <?php echo $selected; ?>><?php echo $item['Nombre']; ?></option>
                <?php
              endforeach;
            endif;
            ?>
          </select>  
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" id="title_loc"><?php echo $title_loc; ?></label>
        <div class="controls">
          <input type="text" class="form-control" id="localidad" name="<?php echo $tabla; ?>[Localidad]" value="<?php echo (isset($data[$tabla]['Localidad'])) ? $data[$tabla]['Localidad'] : ''; ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Dirección:</label>
        <div class="controls">
          <input type="text" class="form-control" id="direccion" name="<?php echo $tabla; ?>[Direccion]" value="<?php echo (isset($data[$tabla]['Direccion'])) ? $data[$tabla]['Direccion'] : ''; ?>" />
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Barrio:</label>
        <div class="controls">
          <input type="text" class="form-control" name="<?php echo $tabla; ?>[Barrio]" value="<?php echo (isset($data[$tabla]['Barrio'])) ? $data[$tabla]['Barrio'] : ''; ?>" />
        </div>
      </div>
      <div class="cont-hint">
        <span class="obligatory">*</span>
        <p class="help-block">Los campos son obligatorios</p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="widget">
    <div class="widget-header">
      <h3><i class="fa fa-cog"></i> Configuraci&oacute;n</h3>
    </div>
    <div class="widget-content">
      <div class="form-group">
        <label class="control-label">Latitud:</label>
        <div class="controls">
          <input type="text" class="form-control" id="latitud" name="<?php echo $tabla; ?>[Latitud]" value="<?php echo (isset($data[$tabla]['Latitud'])) ? $data[$tabla]['Latitud'] : ''; ?>" readonly="readonly"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">Longitud:</label>
        <div class="controls">
          <input type="text" class="form-control" id="longitud" name="<?php echo $tabla; ?>[Longitud]" value="<?php echo (isset($data[$tabla]['Longitud'])) ? $data[$tabla]['Longitud'] : ''; ?>" readonly="readonly"/>
        </div>
      </div>
      <div class="form-group text-right">
        <a href="javascript:getCoords();" class="btn btn-info">Calcular Coordenadas</a>  
        <p class="help-block">Puede mover el marcador para mayor precisión</p>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div id="map"></div>
</div>
<script>
  var urlPais = '<?php echo $urlPais; ?>';
  var urlProv = '<?php echo $urlProv; ?>';
  var urlLoc = '<?php echo $urlLoc; ?>';

  function changePais(id) {
    $('#provincia').html('');

    if (id == 43) {
      $('#title_prov').html('Región:');
      $('#title_dpto').html('Provincia:');
      $('#title_loc').html('Comuna:');
    } else {
      $('#title_prov').html('Provincia:');
      $('#title_dpto').html('Departamento:');
      $('#title_loc').html('Localidad:');
    }

    $.ajax({
      dataType: "json",
      url: urlPais + id,
      success: function (data) {
        $('#provincia').append('<option value="">- Seleccione -</option>');

        if (data != '') {
          $.each(data, function (i, row) {
            $('#provincia').append('<option value="' + row.ID + '">' + row.Nombre + '</option>');
          });
        }
        
        $('#provincia').trigger('chosen:updated');
      }
    });
  }

  function changeProvincia(id) {
    $('#departamento').html('');

    $.ajax({
      dataType: "json",
      url: urlProv + id,
      success: function (data) {
        $('#departamento').append('<option value="">- seleccione -</option>');

        if (data != '') {
          $.each(data, function (i, row) {
            $('#departamento').append('<option value="' + row.ID + '">' + row.Nombre + '</option>');
          });
        }

        $('#departamento').trigger('chosen:updated');
      }
    });
  }

  $(document).ready(function () {
    $("#localidad").autocomplete({
      source: function (request, response) {
        var depto = $('#departamento option:selected').val();
        var key = $("#localidad").val();

        $.post(urlLoc, {
          key: key,
          depto: depto
        }).done(function (data, status) {
          response(JSON.parse(data));
        });
      },
      minLength: 2
    });
  });

  var map = null;
  var marker = null;

  function initMap() {
    var mendoza = {
      lat: <?php echo $latitud; ?>,
      lng: <?php echo $longitud; ?>
    };

    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: mendoza
    });

    var image = '<?php echo URL_IMG; ?>marker.png';
    marker = new google.maps.Marker({
      position: mendoza,
      map: map,
      icon: image,
      draggable: true
    });

    marker.addListener('drag', handleEvent);
    marker.addListener('dragend', handleEvent);
  }

  function handleEvent(event) {
    document.getElementById('latitud').value = event.latLng.lat();
    document.getElementById('longitud').value = event.latLng.lng();
  }

  function getCoords() {
    var geocoder = new google.maps.Geocoder();
    direccion = document.getElementById('direccion').value;
//    departamento = document.getElementById('departamento').value;
    departamento = $("#departamento option:selected").text();
    provincia = 'Mendoza';

    address = direccion + ',' + departamento + ',' + provincia;

    if (address !== '') {
      geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
          document.getElementById('latitud').value = results[0].geometry.location.lat();
          document.getElementById('longitud').value = results[0].geometry.location.lng();

          marker.setPosition(results[0].geometry.location);
          map.setCenter(marker.getPosition());
        }
      });
    }
  }
</script>