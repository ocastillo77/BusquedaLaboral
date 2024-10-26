
$.datepicker.regional['es'] = {
  closeText: 'Cerrar',
  currentText: 'Hoy',
  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
  dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
  weekHeader: 'Sm',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''
};

$.datepicker.setDefaults($.datepicker.regional['es']);

$(document).ready(function () {
  $('[data-rel="chosen"],[rel="chosen"]').chosen({width: '100%'});

  $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
  });
});

function compararFechas(fechaInicial, fechaFinal) {
  var valuesStart = fechaInicial.split('-');
  var valuesEnd = fechaFinal.split('-');

  var dateStart = new Date(valuesStart[0], (valuesStart[1] - 1), valuesStart[2]);
  var dateEnd = new Date(valuesEnd[0], (valuesEnd[1] - 1), valuesEnd[2]);

  if (dateEnd >= dateStart) {
    return true;
  }

  return false;
}

function alertMessage(style, message) {
  var style = 'alert-' + style || '';
  var message = message || '';

  if (message !== '') {
    $('#message').addClass(style);
    $('.top-general-alert').delay(800).slideDown('medium');
    setTimeout("alertMessage('')", 10000);
    $('body,html').animate({scrollTop: 0}, 800);
  } else {
    $('#message').removeClass(style);
    $('.top-general-alert').slideUp('fast');
  }
  $('#message').html('<span>' + message + '</span>');
}

function str2url(str, encoding, ucfirst) {
  str = str.toUpperCase();
  str = str.toLowerCase();
  str = str.replace(/[\u0105\u0104\u00E0\u00E1\u00E2\u00E3\u00E4\u00E5]/g, 'a');
  str = str.replace(/[\u00E7\u0107\u0106]/g, 'c');
  str = str.replace(/[\u00E8\u00E9\u00EA\u00EB\u0119\u0118]/g, 'e');
  str = str.replace(/[\u00EC\u00ED\u00EE\u00EF]/g, 'i');
  str = str.replace(/[\u0142\u0141]/g, 'l');
  str = str.replace(/[\u00F2\u00F3\u00F4\u00F5\u00F6\u00F8\u00D3]/g, 'o');
  str = str.replace(/[\u015B\u015A]/g, 's');
  str = str.replace(/[\u00F9\u00FA\u00FB\u00FC]/g, 'u');
  str = str.replace(/[\u00FD\u00FF]/g, 'y');
  str = str.replace(/[\u017C\u017A\u017B\u0179]/g, 'z');
  str = str.replace(/[\u00F1]/g, 'n');
  str = str.replace(/[\u0153]/g, 'oe');
  str = str.replace(/[\u00E6]/g, 'ae');
  str = str.replace(/[\u00DF]/g, 'ss');
  str = str.replace(/[^a-z0-9\s\'\:\/\[\]-]/g, '');
  str = str.replace(/[\s\'\:\/\[\]-]+/g, ' ');
  str = str.replace(/[ ]/g, '-');

  if (ucfirst == 1) {
    c = str.charAt(0);
    str = c.toUpperCase() + str.slice(1);
  }
  return str;
}

function updateFriendlyURL(input, friendly_url) {
  $('#' + input).val(str2url($('#' + input).val(), 'UTF-8'));
  $('#' + friendly_url).html($('#' + input).val());
}

function str2const(str, encoding, ucfirst) {
  str = str.toUpperCase();
  str = str.toLowerCase();
  str = str.replace(/[\u0105\u0104\u00E0\u00E1\u00E2\u00E3\u00E4\u00E5]/g, 'a');
  str = str.replace(/[\u00E7\u0107\u0106]/g, 'c');
  str = str.replace(/[\u00E8\u00E9\u00EA\u00EB\u0119\u0118]/g, 'e');
  str = str.replace(/[\u00EC\u00ED\u00EE\u00EF]/g, 'i');
  str = str.replace(/[\u0142\u0141]/g, 'l');
  str = str.replace(/[\u00F2\u00F3\u00F4\u00F5\u00F6\u00F8\u00D3]/g, 'o');
  str = str.replace(/[\u015B\u015A]/g, 's');
  str = str.replace(/[\u00F9\u00FA\u00FB\u00FC]/g, 'u');
  str = str.replace(/[\u00FD\u00FF]/g, 'y');
  str = str.replace(/[\u017C\u017A\u017B\u0179]/g, 'z');
  str = str.replace(/[\u00F1]/g, 'n');
  str = str.replace(/[\u0153]/g, 'oe');
  str = str.replace(/[\u00E6]/g, 'ae');
  str = str.replace(/[\u00DF]/g, 'ss');
  str = str.replace(/[^a-z0-9\s\'\:\/\[\]-]/g, '_');
  str = str.replace(/[\s\'\:\/\[\]-]+/g, ' ');
  str = str.replace(/[ ]/g, '_');

  if (ucfirst == 1) {
    c = str.charAt(0);
    str = c.toUpperCase() + str.slice(1);
  }
  return str;
}

function updateConstant(input, constant) {
  $('#' + input).val(str2const($('#' + input).val(), 'UTF-8'));
  $('#' + constant).html($('#' + input).val());
}

function toUnicode(str) {
  str = (str.indexOf('&aacute;') != -1) ? str.replace(/&aacute;/g, '\u00e1') : str;
  str = (str.indexOf('&iacute;') != -1) ? str.replace(/&eacute;/g, '\u00e9') : str;
  str = (str.indexOf('&iacute;') != -1) ? str.replace(/&iacute;/g, '\u00ed') : str;
  str = (str.indexOf('&oacute;') != -1) ? str.replace(/&oacute;/g, '\u00f3') : str;
  str = (str.indexOf('&uacute;') != -1) ? str.replace(/&uacute;/g, '\u00fa') : str;
  str = (str.indexOf('&Aacute;') != -1) ? str.replace(/&Aacute;/g, '\u00c1') : str;
  str = (str.indexOf('&Eacute;') != -1) ? str.replace(/&Eacute;/g, '\u00c9') : str;
  str = (str.indexOf('&Iacute;') != -1) ? str.replace(/&Iacute;/g, '\u00cd') : str;
  str = (str.indexOf('&Oacute;') != -1) ? str.replace(/&Oacute;/g, '\u00d3') : str;
  str = (str.indexOf('&Uacute;') != -1) ? str.replace(/&Uacute;/g, '\u00da') : str;
  str = (str.indexOf('&ntilde;') != -1) ? str.replace(/&ntilde;/g, '\u00f1') : str;
  str = (str.indexOf('&Ntilde;') != -1) ? str.replace(/&Ntilde;/g, '\u00d1') : str;
  str = (str.indexOf('&iquest;') != -1) ? str.replace(/&iquest;/g, '\u00BF') : str;

  return str;
}

function set_editor(textareas) {
//  CKEDITOR.replace(textareas);
}

function set_minieditor(textareas) {
//  CKEDITOR.inline(textareas);
}
function createTab(urlTab) {
  id = $('#tabs a').length + 1;

  if (id <= 20) {
    if (id == 20)
      $('#new-tab').hide();

    url = $('<a />', {
      'href': '#tab_' + id
    }).html(id);
    div = $('<div />', {
      'id': 'tab_' + id,
      'class': 'vtab-min-content'
    });

    $.ajax({
      url: urlTab + '/' + id,
      success: function (data) {
        div.html(data);
      }
    });

    $('#new-tab').before(url);
    (id != 1) ? $('#tab_' + (id - 1)).after(div) : $('#tabs').after(div);
    $('#tabs a').tabs(id);
  }
}

function closeTab(i, id, urlTab) {
  if (i == 1 && id == 0)
    return false;
  if (!confirm(toUnicode('Esta seguro que desea eliminar este p&aacute;rrafo?')))
    return false;

  if (id != 0) {
    var formData = {id: id};

    $.ajax({
      type: 'POST',
      data: formData,
      url: urlTab,
      success: function (data) {
        alertMessage('success', data);
        $('#tab_' + i).remove();
        $('#tabs a').eq(i - 1).remove();
        $('#tabs a').tabs(i - 1);
      }
    });
  } else {
    $('#tab_' + i).remove();
    $('#tabs a').eq(i - 1).remove();
    $('#tabs a').tabs(i - 1);
  }
  if (id < 13)
    $('#new-tab').show();
}

function uploadImage(code, checkext, urlUp, urlCrop, category) {
  category || (category = '');
  var button = $('#btn-' + code);
  var param = '';

  new AjaxUpload(button, {
    action: urlUp,
    onChange: function (file, ext) {
      if (category != '') {
        param = $('#' + category + ' option:selected').val();
        this.setData({
          'categoria': param
        });
      }
    },
    onSubmit: function (file, ext) {
      if (!(ext && checkext.test(ext))) {
        alertMessage('danger', 'El tipo de archivo que intenta subir es incorrecto!');
        return false;
      } else {
        $('#ldr-' + code).show();
        this.disable();
      }
    },
    onComplete: function (file, response) {
      button.html('<i class="icon icon-plus icon-white"></i> Cambiar');
      isJson = true;
      //alert(response)
      try {
        data = $.parseJSON(response);
      } catch (e) {
        isJson = false;
        $('#ldr-' + code).hide();
        alertMessage('danger', response);
      }

      if (isJson) {
        switch (data.success) {
          case 0:
            alertMessage('danger', 'Hubo un error al subir la imagen!');
            break;
          case 1:
            setImage(code, data.name, data.url);
            break;
          case 2:
            array = data.image.split('.');
            ext = array.pop();
            image = array.toString();

            jQuery.fancybox.open({
              type: 'iframe',
              href: urlCrop + '/' + code + '/' + image + '/' + ext + '/' + param,
              closeBtn: false,
              autoSize: false,
              width: data.width + 40,
              height: data.height + 190,
              modal: true
            });
            break;
        }

        $('#ldr-' + code).hide();
        this.enable();
      }
    }
  });
}

function uploadFile(code, checkext, urlUp, icon, category) {
  var button = $('#btn-' + code);
  category || (category = '');

  new AjaxUpload(button, {
    action: urlUp,
    onChange: function () {
      if (category != '') {
        var param = $('#' + category + ' option:selected').val();
        this.setData({
          'categoria': param
        });
      }
    },
    onSubmit: function (file, ext) {
      if (checkext != '*') {
        if (!(ext && checkext.test(ext))) {
          alertMessage('danger', 'El tipo de archivo que intenta subir es incorrecto!');
          return false;
        }
      }
      $('#ldr-' + code).show();
      this.disable();
    },
    onComplete: function (file, response) {
      isJson = true;

      try {
        data = $.parseJSON(response);
      } catch (e) {
        isJson = false;
        $('#ldr-' + code).hide();
        alertMessage('danger', response);
      }

      if (isJson) {
        switch (data.success) {
          case 0:
            alertMessage('danger', 'Hubo un error al subir el archivo!');
            break;
          case 1:
            setFile(code, data.name, data.url, icon);
            break;
        }
        $('#ldr-' + code).hide();
        this.enable();
      }
    }
  });
}

function delVideo(code, nofoto) {
  $('#' + code).val('');
  $('#img-' + code).removeAttr('scr');
  $('#img-' + code).attr('src', nofoto);
  $('#gal-' + code).attr({'href': '#'});
  alertMessage('success', 'El enlace del video ha sido eliminado correctamente!');
}

function delImage(code, nofoto, urlDel) {
  img = $('#img-' + code).attr('src');
  arr1 = img.split('.');
  ext = arr1.pop();

  arr2 = arr1.toString().split('/');
  arr3 = arr2.pop().split('_');
  image = arr3.pop();

  var formData = {img: image + '.' + ext};

  $.ajax({
    type: 'POST',
    data: formData,
    url: urlDel,
    success: function (data) {
      $('#' + code).val('');
      $('#img-' + code).removeAttr('scr');
      $('#img-' + code).attr('src', nofoto);
      $('#gal-' + code).attr({'href': '#'});
      alertMessage('success', 'La imagen ' + image + '.' + ext + ' ha sido eliminada correctamente!');
    }
  });
}

function delFile(code, nofoto, urlDel) {
  img = $('#img-' + code).attr('src');
  arr1 = img.split('.');
  ext = arr1.pop();

  arr2 = arr1.toString().split('/');
  arr3 = arr2.pop().split('_');
  image = arr3.pop();

  var formData = {img: image + '.' + ext};

  $.ajax({
    type: 'POST',
    data: formData,
    url: urlDel,
    success: function (data) {
      $('#' + code).val('');
      $('#img-' + code).removeAttr('scr');
      $('#img-' + code).attr('src', nofoto);
      $('#gal-' + code).attr({'href': '#'});
      alertMessage('success', 'La imagen ' + image + '.' + ext + ' ha sido eliminada correctamente!');
    }
  });
}

function delGallery(code, id, urlDel) {
  img = $('#img-' + code).attr('src');
  arr1 = img.split('.');
  ext = arr1.pop();

  arr2 = arr1.toString().split('/');
  arr3 = arr2.pop().split('_');
  image = arr3.pop();

  var formData = {img: image + '.' + ext, id: id};

  $.ajax({
    type: 'POST',
    data: formData,
    url: urlDel,
    success: function (data) {
      $('#' + code).fadeOut('normal', function () {
        $(this).remove();
      });
      alertMessage('success', 'El Archivo ha sido eliminado correctamente!');
    }
  });
}

function setImage(code, name, url) {
  $('#' + code).val(name);
  $('#img-' + code).removeAttr('scr');
  $('#img-' + code).attr('src', url + 'thumbs/TH_' + name);
  $('#gal-' + code).attr({'href': url + 'images/IM_' + name,
    'class': 'fancybox'});
  $('#link-' + code).html(url + 'images/IM_' + name);
  $('.fancybox').fancybox();
  alertMessage('success', 'El archivo ' + name + ' ha subido correctamente!');
}

function setFileV1(code, name, url, width, height, swfoto) {
  $('#' + code).val(name);
  $('#img-' + code).removeAttr('scr');
  $('#img-' + code).attr('src', swfoto);

  getPopFlash('popflash', url + 'files/' + name, width, height);

  $('#gal-' + code).attr({'class': 'fancybox'});
  $('.fancybox').fancybox();
  alertMessage('success', 'El archivo ' + name + ' ha subido correctamente!');
}

function setFile(code, name, url, thumb) {
  $('#' + code).val(name);
  $('#img-' + code).removeAttr('scr');
  $('#img-' + code).attr('src', thumb);

  new_url = url + name;
  $('#gal-' + code).attr({'href': new_url});
  alertMessage('success', 'El archivo ' + code + ' ' + name + ' ha subido correctamente!');
}

function getPopFlash(id, url_swf, width, height) {
  $('#' + id).flash({
    swf: url_swf,
    width: width,
    height: height,
    flashvars: {name1: 'jQuery', name2: 'SWFObject'},
    params: {wmode: 'transparent'}
  });
}

function getCodeYoutube(url) {
  if (url === null) {
    return '';
  }
  var results = url.match("[\\?&]v=([^&#]*)");
  var code = (results === null) ? url : results[1];
  return code;
}

function getImageYoutube(code, size) {
  size = (size === null) ? 'small' : size;
  num = (size == 'small') ? 2 : 0;
  return 'http://img.youtube.com/vi/' + code + '/' + num + '.jpg';
}

function setVideoYoutube(id, urlTemp) {
  var value = $('#' + id).val();

  if (value != '') {
    var code = getCodeYoutube(value);
    var thumb = getImageYoutube(code);
    var url = 'http://www.youtube.com/watch?v=' + code;

    count = $('#box-gallery .item').size();
    var num = count + 1;

    $.ajax({
      url: urlTemp,
      data: {num: num, thumb: thumb, image: url, name: code},
      type: 'post',
      success: function (data) {
        $('#box-gallery').find('p').remove();
        $('#box-gallery').append(data);
      }
    });

    $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
      openEffect: 'none',
      closeEffect: 'none',
      prevEffect: 'none',
      nextEffect: 'none',
      arrows: false,
      helpers: {
        media: {},
        buttons: {}
      }
    });

    showControls();
    $('#' + id).val('');
  }
}

function addUrlYoutube(id) {
  var value = $('#url-' + id).val();
  if (value != '') {
    var code = getCodeYoutube(value);
    var thumb = getImageYoutube(code);
    var url = 'http://www.youtube.com/watch?v=' + code;
    $('#' + id).val(code);
    $('#img-' + id).removeAttr('scr');
    $('#img-' + id).attr({'src': thumb, 'width': '150px'});
    $('#gal-' + id).parent().css('min-height', 110);
    $('#gal-' + id).attr({'href': url,
      'class': 'fancybox-media'});

    $('.fancybox-media').attr('rel', 'media-gallery').fancybox({
      openEffect: 'none',
      closeEffect: 'none',
      prevEffect: 'none',
      nextEffect: 'none',
      arrows: false,
      helpers: {
        media: {},
        buttons: {}
      }
    });
    $('#url-' + id).val('');
    jQuery.fancybox.close();
  }
}

function setMetas(id, str) {
  var array = str.split(',');
  var title = $('#' + id).val();
  for (i = 0; i < array.length; i++) {
    $('#' + array[i]).val(title);
  }
}

function uploadGalery(id, count, urlSwf, urlUp, urlTemp) {
  Dropzone.autoDiscover = false;

  $(document.body).dropzone({
    url: urlUp,
    paramName: 'Filedata',
    previewsContainer: "#previews",
    clickable: '#' + id,
    autoProcessQueue: false,
    parallelUploads: 100,
    addRemoveLinks: true,
    maxFilesize: 20,
    dictDefaultMessage: "Arrastre sus archivos aqu&iacute;",
    dictCancelUpload: 'Cancelar Subida',
    dictRemoveFile: 'Eliminar Archivo',
    dictResponseError: 'Ha ocurrido un error en el servidor',
    acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
    init: function () {
      var myDropzone = this;
      $('#' + id + '_now').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });
    },
    success: function (file, data) {
      var isJson = true;

      try {
        json = $.parseJSON(data);
      } catch (e) {
        isJson = false;
        alertMessage('danger', data);
      }
      //alert(data)
      if (isJson && json.success == 1) {
        thumb = json.url + 'thumbs/TH_' + json.image;
        image = json.url + 'images/IM_' + json.image;
        boxid = $(file.previewElement).attr('id');
        array = boxid.split('_');
        numero = parseInt(array[1]);

        count = $('#box-gallery #sortable .gal-item').size();

        var num = numero + count;

        $.ajax({
          url: urlTemp,
          data: {
            num: num,
            thumb: thumb,
            image: image,
            name: json.name,
            title: json.title
          },
          type: 'post',
          success: function (data) {
            $('#box-gallery #sortable').find('p').remove();
            $('#box-gallery #sortable').append(data);
            var name = file.previewElement;

            if (name != null) {
              $(name).fadeOut('normal', function () {
                $(this).remove();
              });
            }
          }
        });
      }
      $('.fancybox').fancybox();
      showControls();
    },
    complete: function (file) {
      if (file.status == 'success') {
        alertMessage('success', 'Los archivos han subido correctamente!');
      }
    },
    error: function (file) {
      alertMessage('danger', 'Error al subir archivo: ' + file.name);
    }
  });
}

function uploadGalery2(id, count, urlSwf, urlUp, urlTemp) {
  $('#' + id).uploadify({
    'swf': urlSwf + 'uploadify/js/uploadify.swf',
    'uploader': urlUp,
    'buttonText': 'Seleccionar Im&aacute;genes',
    'queueID': 'uploadQueque',
    'buttonClass': 'btn btn-info',
    'auto': false,
    'width': 150,
    'height': 18,
    'onUploadSuccess': function (file, data, response) {
      var isJson = true;

      try {
        json = $.parseJSON(data);
      } catch (e) {
        isJson = false;
        alertMessage('danger', response);
      }
      //alert(data)
      if (isJson && json.success == 1) {
        thumb = json.url + 'thumbs/TH_' + json.image;
        image = json.url + 'images/IM_' + json.image;
        count = $('#box-gallery .item').size();

        var str = file.id;
        var array = str.split('_');
        var num = ((array[2] * 1) + 1) + (count * 1);

        $.ajax({
          url: urlTemp,
          data: {num: num, thumb: thumb, image: image, name: json.name},
          type: 'post',
          success: function (data) {
            $('#box-gallery').find('p').remove();
            $('#box-gallery').append(data);
          }
        });
      }
      $('.fancybox').fancybox();
      showControls();
    },
    'onQueueComplete': function (queueData) {
      alertMessage('success', 'Los ' + queueData.uploadsSuccessful + ' archivos han subido correctamente!');
    }
  });
}

function editGallery(id) {
  var button = $('#' + id).find('.bt-edit').html();

  if (button == 'Editar') {
    $('#' + id).find('.list-desc').hide();
    $('#' + id).find('.list-edit').show();
    $('#' + id).find('textarea').show()
    $('#' + id).find('.bt-edit').html('Guardar');
  } else {
    text = $('#' + id).find('textarea').val();
    if (text !== '') {
      $('#' + id).find('.list-desc').html(text).show();
    } else {
      $('#' + id).find('.list-desc').show();
    }
    $('#' + id).find('.list-edit').hide();
    $('#' + id).find('.bt-edit').html('Editar');
  }
}

function showControls() {
  $('.image-gallery').hover(function () {
    $('img', this).fadeTo(500, 0.60);
    $(this).find('.gallery-controls').show();
  }, function () {
    $('img', this).fadeTo(500, 1);
    $(this).find('.gallery-controls').hide();
  });
}

function paginar(urlPag) {
  var limite = $('#limite :selected').val();
  $.ajax({
    url: urlPag + '/' + limite,
    success: function (data) {
      alertMessage('success', 'Se concluy&oacute; satisfactoriamente la carga de registros!');
      $('#div-content').html(data);
    }
  });
}

function sortable(id, pos, url) {
  $('#' + id).tableDnD({
    onDragClass: 'sortable-dnd',
    onDrop: function (table, row) {
      var j = 1;
      $('#' + id + ' tr').each(function () {
        $(this).find('td:eq(0)').html(j);
        j++;
      });

      var num = $('#' + row.id).find('td:eq(0)').text();
      $('#' + pos).val(num);

      $.ajax({
        type: 'POST',
        url: url,
        data: $.tableDnD.serialize(),
        success: function (data) {
          alertMessage('success', data);
        }
      });
    }
  });
}

function setCheckBox(id, name) {
  if ($(id).is(':checked'))
    $('#' + name).val(1);
  else
    $('#' + name).val(0);
}

function showhide(id) {
  if ($('#' + id).is(':visible')) {
    $('#' + id).hide();
  } else {
    $('#' + id).show();
  }
}

/* ultimas funciones agregadas 2015 */
function checker(id) {
  $('input[name*=\'selected\']').attr('checked', id.checked);
}

function validate(form, input, action) {
  switch (action) {
    case 'duplicate':
      if ($('input:checkbox:checked').size() == 1) {
        if (!confirm('Confirma duplicar el registro seleccionado?'))
          return false;
        $('#' + input).val(8);
        $('#' + form).submit();
      } else
        alertMessage('danger', 'Seleccione sólo un registro');
      break;
    case 'publicar':
      if ($('input:checkbox:checked').size() > 0) {
        if (!confirm('Confirma publicar registro(s) seleccionado(s)?'))
          return false;
        $('#' + input).val(1);
        $('#' + form).submit();
      } else
        alertMessage('danger', 'Seleccione por lo menos un registro');
      break;
    case 'archivar':
      if ($('input:checkbox:checked').size() > 0) {
        if (!confirm('Confirma archivar registro(s) seleccionado(s)?'))
          return false;
        $('#' + input).val(3);
        $('#' + form).submit();
      } else
        alertMessage('danger', 'Seleccione por lo menos un registro');
      break;
    case 'delete':
      if ($('input:checkbox:checked').size() > 0) {
        if (!confirm('Confirma eliminar registro(s) seleccionado(s)?'))
          return false;
        $('#' + input).val(4);
        $('#' + form).submit();
      } else
        alertMessage('danger', 'Seleccione por lo menos un registro');
      break;
    case 'spam':
      if ($('input:checkbox:checked').size() > 0) {
        if (!confirm('Confirma mover los registro(s) seleccionado(s)?'))
          return false;
        $('#' + input).val(6);
        $('#' + form).submit();
      } else
        alertMessage('danger', 'Seleccione por lo menos un registro');
      break;
    case 'vaciar':
      $('input[name*=\'selected\']').attr('checked', 'checked');

      if ($('input:checkbox:checked').size() > 0) {
        if (!confirm('Confirma vaciar la carpeta eliminados?'))
          return false;
        $('#' + input).val(7);
        $('#' + form).submit();
      } else
        alertMessage('danger', 'Seleccione por lo menos un registro');
      break;
  }
}

function check_email(urlPag) {
  $.ajax({
    url: urlPag,
    success: function (data) {
      (data == 'true') ? alertMessage('danger', 'El correo electr&oacute;nico ya esta siendo usado!')
        : alertMessage('success', 'Correo electr&oacute;nico aceptado!');
    }
  });
}

function check_user(urlPag) {
  $.ajax({
    url: urlPag,
    success: function (data) {
      (data == 'true') ? alertMessage('danger', 'El nombre de usuario ya esta siendo usado!')
        : alertMessage('success', 'Usuario aceptado!');
    }
  });
}

function getTableList(aTableName, aUrlFilter, aAligns) {
  var sAligns = aAligns || null;

  $('#' + aTableName).DataTable({
    'iDisplayLength': 25,
    'bProcessing': true,
    'bServerSide': true,
    'bAutoWidth': false,
    'sAjaxSource': aUrlFilter,
    'aoColumns': sAligns,
    'aoColumnDefs': [
      {'aTargets': ['sisort'], 'bSortable': true},
      {'aTargets': ['nosort'], 'bSortable': false}
    ],
    'oLanguage': {
      'sSearch': 'Buscar:',
      'sProcessing': 'Procesando...',
      'sLengthMenu': 'Mostrar _MENU_ registros por pagina',
      'sZeroRecords': 'No se encontraron resultados',
      'sInfo': 'Listando de _START_ a _END_ de _TOTAL_ registros',
      'sInfoEmpty': 'Listando de 0 a 0 de 0 registros',
      'sInfoFiltered': '(filtrando desde _MAX_ total de registros)',
      'oPaginate': {
        'sFirst': 'Primero',
        'sLast': '&Uacute;ltimo',
        'sNext': 'Siguiente',
        'sPrevious': 'Anterior'
      }
    },
    'sPaginationType': 'bootstrap'
  });
}

function addComment(id) {
  var comment = $('#' + id).val();
  var url = $('#config-comment').attr('data-url');
  var ordenId = $('#config-comment').attr('data-ordenid');

  if (comment != '') {
    $.ajax({
      type: 'POST',
      url: url,
      data: {
        ordenId: ordenId,
        comment: comment
      },
      success: function (data) {
        if ($("#mssgenull").length > 0) {
          $("#mssgenull").remove();
        }

        $('#box-comments').append(data);
        $('#' + id).val('');

        if ($("#box-comments li").length > 0) {
          $("#box-comments").stop().animate({
            scrollTop: $("#box-comments")[0].scrollHeight
          }, 1000);
        }
        $('#comentario').focus();
      }
    });
  }
}

$(document).ready(function () {
  if ($("#box-comments").length > 0) {
    if ($("#box-comments li").length > 0) {
      $("#box-comments").stop().animate({
        scrollTop: $("#box-comments")[0].scrollHeight
      }, 1000);
    }
  }

  $('#comentario').keydown(function (e) {
    if (e.keyCode == 13) {
      //addComment('comentario');
      //e.preventDefault();
    }
  });
});

function changeTipo(value) {
  if (value == 0) {
    $('.box-tipo').removeClass('d-none');
  } else {
    $('.box-tipo').addClass('d-none');
  }
}