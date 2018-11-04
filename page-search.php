<?php get_template_part('templates/page', 'header'); ?>
<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white can-be--dark-light">
      <div class="spacing--double">
        <div class="spacing text">
          <div class="tx-solr">
            <div class="search__results spacing--one-and-half">
              <div class="search__options pad--primary no-pad--btm spacing--half">
                <form class="solrForm search__results__form" action="<?php echo home_url( '/' ); ?>" role="search" method="get" accept-charset="utf-8">
                  <fieldset>
                    <legend class="is-vishidden"><?php _e("Search", "sage"); ?></legend>
                    <div class="field-container field-container--inline" style="display: block;">
                      <input name="q" class="term search__results__input font--secondary--s" type="search" data-l="0" value="" autocomplete="off">
                      <button class="search__submit font--secondary--s upper theme--secondary-background-color"><?php _e("Search", "sage"); ?></button>
                    </div>
                  </fieldset>
                </form><!-- /.search-form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.shift-left--fluid -->
    <?php get_sidebar(); ?>
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
<?php get_template_part('templates/page', 'footer'); ?>
