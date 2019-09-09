$(function() {
  // EXPLICITLY SET HEIGHT ON TINYMCE EDITOR HERE
  $( '.cf-container__tabs-item:contains("FOOTER CONTENT")' ).click(function(){
    setTimeout( function() {
      $( '.cf-container-carbon_fields_container_alps_theme_settings .mce-edit-area iframe' ).css('height', '300');
    }, 400 );
  });
});


