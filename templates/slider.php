<?php
	$slides = Slide::all();
?>

<div id="home-hero">
	<ul id="home-slides">
		<?php foreach ($slides as $slide) { ?>
		    <li>
		    	<img src="<?= $slide -> image_url ?>" class="slide-bg" alt="<?= $slide->title ?>" />
		        <div class="home-slides-content">
		            <h1><?= stripslashes($slide -> title) ?></h1>
		            <p><?= stripslashes($slide -> description) ?></p>
		        </div>
		    </li>
		<?php } ?>
	</ul> <!-- End #home-slides -->
	<div id="home-slides-nav"></div>
</div> <!-- End #home-hero -->