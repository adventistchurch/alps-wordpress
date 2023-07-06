jQuery(function() {
  // EXPLICITLY SET HEIGHT ON TINYMCE EDITOR HERE
  jQuery( '.cf-container__tabs-item:contains("FOOTER CONTENT")' ).click(function(){
    setTimeout( function() {
      jQuery( '.cf-container-carbon_fields_container_alps_theme_settings .mce-edit-area iframe' ).css('height', '300');
    }, 400 );
  });

  // Manage editor CSS based on selected template
  let cssCheck = false;

  function editorCSS(template) {
    if (!cssCheck && template != 'Page Builder Template') {
      let css = '<style id="editor_margins">.editor-styles-wrapper .wp-block {max-width: min(calc(100vw - 8 * 25px), 610px);}</style>';
      jQuery('head').append(css);
      cssCheck = true;
    }
    if (cssCheck && template == 'Page Builder Template') {
      css = jQuery('#editor_margins');
      if (css.length) {
        css.remove();
        cssCheck = false;
      }
    }
  }

  function checkToggle() {
    let templateToggle = document.querySelector('.edit-post-post-template__toggle');
    if (jQuery(templateToggle).length && jQuery(templateToggle).text()) {
      let template = jQuery(templateToggle).text();
      editorCSS(template);
      return true;
    } else {
      return false;
    }
  }

  new MutationObserver(function(mutations) {
    let check = checkToggle();
    if (check) {
      this.disconnect();
      new MutationObserver(function(mutations) {
        checkToggle();
      }).observe(document.querySelector('.edit-post-sidebar'), {
        subtree: true,
        childList: true,
        characterData: true
      });
    }
  }).observe(document.querySelector('#editor'), {
    subtree: true,
    childList: true,
  });

});
