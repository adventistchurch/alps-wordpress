<?php
	$slides = Slide::all();
?>
<div id="home-hero">
	<ul id="home-slides" class="side-nav">
		<?php foreach ($slides as $slide) { ?>
		    <li>
		    	<img src="<?= $slide->image_url ?>" class="slide-bg" alt="<?= $slide->title ?>" />
		        <div class="home-slides-content">
		            <h1><?= stripslashes($slide->title) ?></h1>
		            <p><?= stripslashes($slide->description) ?></p>
		        </div>
		    </li>
		<?php } ?>
	</ul> <!-- End #home-slides -->
	<div id="home-slides-nav" class="side-nav"></div>
	<div class="third-left">
		<?php wp_nav_menu( array( 
				'theme_location' => 'header-menu',
				'items_wrap' => '<ul id="side-nav" class="home">%3$s</ul>',
				'container' => ''
				 ) ); ?>
	</div>
</div> <!-- End #home-hero -->