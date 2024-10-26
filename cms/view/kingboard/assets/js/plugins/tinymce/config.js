/* 
 * CONFIG
 */

tinymce.init({
  selector: ".full-editor",
  language: 'es_419',
  theme: "modern",
  plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "save table contextmenu directionality emoticons template textcolor paste textcolor colorpicker codesample"
  ],
  content_css: "config.css",
  add_unload_trigger: false,
  autosave_ask_before_unload: false,

  toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink | preview",
  toolbar2: "styleselect formatselect fontselect fontsizeselect | image media | forecolor backcolor | code fullscreen",
  toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons",
  menubar: false,
  toolbar_items_size: 'small',
  height: 350,

  spellchecker_callback: function (method, data, success) {
    if (method == "spellcheck") {
      var words = data.match(this.getWordCharPattern());
      var suggestions = {};
      for (var i = 0; i < words.length; i++) {
        suggestions[words[i]] = ["First", "second"];
      }
      success({words: suggestions, dictionary: true});
    }
    if (method == "addToDictionary") {
      success();
    }
  }
});

tinymce.init({
  selector: ".mini-editor",
  language: 'es_419',
  theme: "modern",
  plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "save table contextmenu directionality emoticons template textcolor paste textcolor colorpicker codesample"
  ],
  content_css: "config.css",
  add_unload_trigger: false,  
  toolbar: "styleselect | undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink | preview",
  menubar: false,
  toolbar_items_size: 'small'
});
