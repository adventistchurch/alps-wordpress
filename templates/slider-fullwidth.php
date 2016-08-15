<?php
	$slides = Slide::all();
?>

<div id="home-hero">
	<ul id="home-slides" class="full-width">
		<?php foreach ($slides as $slide) { ?>
		    <li>
		    	<img src="<?= $slide->image_url ?>" class="slide-bg" alt="<?= $slide->title?>" />
		    </li>
		<?php } ?>
	</ul> <!-- End #home-slides -->
	<div id="home-slides-nav" class="full-width"></div>
</div> <!-- End #home-hero -->