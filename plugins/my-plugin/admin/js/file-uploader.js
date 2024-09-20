(function ($) {
  "use strict";
  var custom_uploader;
  var preview = $(".mp-preview");
  var input = $('input[name="mp_settings_file"]');
  $(document.body).on("click", ".add-file-button", function () {
    if (custom_uploader) {
      custom_uploader.open();
      return;
    }
    custom_uploader = wp.media.frames.file_frame = wp.media({
      title: "Choose Image",
      button: {
        text: "Choose Image",
      },
      multiple: false,
    });

    custom_uploader.on("select", function () {
      var attachment = custom_uploader
        .state()
        .get("selection")
        .first()
        .toJSON();
      preview.attr("src", attachment.url);
      input.val(attachment.id);
    });
    custom_uploader.open();
    return false;
  });

  $(document.body).on("click", ".remove-file-button", function () {
    if (confirm("Are you sure?")) {
      preview.removeAttr("src");
      input.val(0);
    }
    return false;
  });
})(jQuery);
