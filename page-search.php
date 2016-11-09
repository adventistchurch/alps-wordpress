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
            				<legend class="is-vishidden">Search</legend>
            				<div class="field-container field-container--inline" style="display: block;">
            					<input name="q" class="term search__results__input font--secondary--s" type="search" data-l="0" value="" autocomplete="off">
            					<button class="search__submit font--secondary--s upper theme--secondary-background-color">Search</button>

            					<div style="position: relative;">
            						<ul class="secondary-nav__subnav__list theme--secondary-background-color searchSuggestions" role="menu" style="top: 0;">
            							<li class="secondary-nav__subnav__list-item hide" role="presentation">
            								<a class="secondary-nav__subnav__link theme--secondary-background-hover-color--at-medium" role="menuitem" tabindex="-1" href="#"></a>
            							</li>
            						</ul>
            					</div>
            				</div>
            			</fieldset>
            		</form><!-- /.search-form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/components/aside.php')); ?>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
<?php get_template_part('templates/page', 'footer'); ?>
