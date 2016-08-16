<?php 
global $post;
while ( have_posts() ) {
	the_post();
	get_template_part('templates/post', 'excerpt');
} 

?>