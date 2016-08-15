		<footer>
 			<div id="footer-top">

				<img src="<?= get_template_directory_uri(), "/", __("-/img/logos/logo_footer.png", "adventist") ?>" class="fr" />
				<?php if (get_option("twitter_acc") != "" && get_option("twitter_acc")) { ?>
					<a href="<?= get_option("twitter_acc") ?>" id="footer-twitter"><?= __("Follow us on Twitter", "adventist") ?></a>
				<?php } ?>

				<?php if (get_option("facebook_acc") != "" && get_option("facebook_acc")) { ?>
					<a href="<?= get_option("facebook_acc") ?>" id="footer-facebook"><?= __("Like us on Facebook", "adventist") ?></a>
				<?php } ?>

				<?php if (get_option("rss_acc") != "") { ?>
					<a href="<?= get_option("rss_acc") ?>" id="footer-rss"><?= __("Subscribe to our RSS feed", "adventist") ?></a>
				<?php } ?>

			</div>

			<div id="footer-bottom">

				<span id="copyright">&copy; <?= get_option('title_copyright') ?></span>

				<?php wp_nav_menu( array( 

						'theme_location' => 'footer-menu',

						'container' => ''

						 ) ); ?>

			</div> <!-- End #footer-bottom -->

		</footer>

	</div> <!-- End .container -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script>window.jQuery || document.write('<script src="<?= get_template_directory_uri(); ?>/-/js/jquery-1.9.1.min.js"><\/script>')</script>

	<script src="<?= get_template_directory_uri(); ?>/-/js/responsiveslides.min.js"></script>

	<script src="<?= get_template_directory_uri(); ?>/-/js/script.js"></script>

	<script>

	    $(function(){

	        $('#home-slides').responsiveSlides({

	            pager: true,

	            navContainer: '#home-slides-nav'

	        });

	    });

	</script>

	<!-- Google Analytics -->

	<script>

	var _gaq=[['_setAccount','<?= get_option("googlea_acc") ?>'],['_trackPageview']];

	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];

	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';

	s.parentNode.insertBefore(g,s)}(document,'script'));

	</script>
	<?= wp_footer() ?>
</body>

</html>

