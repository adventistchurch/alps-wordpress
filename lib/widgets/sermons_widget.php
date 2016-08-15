<?php
class SermonsWidget extends WP_Widget {
  function SermonsWidget() {
    $widget_ops = array('classname' => 'SermonsWidget', 'description' => __('Adventist - Recent Sermons', 'adventist') );
    $this->WP_Widget('SermonsWidget', __('Adventist - Recent Sermons', 'adventist'), $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => __('Recent Sermons', 'adventist'), 'number_posts' => 4, 'category' => 1 ) );
    $title = $instance['title'];
    $nopost = $instance['number_posts'];
    $category = $instance['category'];
	?>
	  <p>
	  	<label for="<?php echo $this->get_field_id('title'); ?>">
	  		<?= __("Title:", "adventist") ?>
	  		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
	  	</label>
	  </p>
	  <p>
	  	<label for="<?php echo $this->get_field_id('number_posts'); ?>">
	  		<?= __("Number posts:", "adventist") ?>
	  		<input class="widefat" id="<?php echo $this->get_field_id('number_posts'); ?>" name="<?php echo $this->get_field_name('number_posts'); ?>" type="text" value="<?php echo attribute_escape($nopost); ?>" />
	  	</label>
	  </p>
	  <p>
	  	<label for="<?php echo $this->get_field_id('category'); ?>">
	  		<?= __("Category:", "adventist") ?>
	  		<select name="<?php echo $this->get_field_name('category'); ?>">
	  			<?php
					$categories = get_all_category_ids();
					foreach($categories as $categor) {
						?>
							<option value="<?php echo $categor; ?>" <?php if ($category == $categor) echo "selected"; ?>><?php echo get_cat_name($categor); ?></option>
						<?php
					}
				?>
	  		</select>
	  	</label>
	  </p>
	<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['number_posts'] = $new_instance['number_posts'];
    $instance['category'] = $new_instance['category'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $nopost = empty($instance['number_posts']) ? 3 : $instance['number_posts'];
    $category = empty($instance['category']) ? 1 : $instance['category'];
  
	$args = array(
	  'posts_per_page' => $nopost,
	  'paged' => 1,
	  'cat' => $category
	);
	query_posts($args); 

	    // WIDGET CODE GOES HERE
	    echo $before_widget;
	    echo $before_title, $title, $after_title;
		?>

			<?php while (have_posts()) { the_post(); ?>
				<div class="sermon">
					<a href="<?= the_permalink() ?>"><?= the_title() ?></a>
					<?php
						$value = get_the_author();
						$aux = get_post_meta(get_the_ID(), 'adventist_bx_post_pastor', true);
						$aux = intval($aux);
						if ($aux > 0) {
							$pastor = new Pastor( intval($aux) );
							$value = $pastor -> name;
						}?>
					<?= $value ?>, <?= get_the_date() ?>
				</div>
			<?php } ?>
			<a href="<?= get_category_link($category) ?>" class="btn"><?= __("View all sermons", "adventist") ?></a>
		<?php
	    echo $after_widget;

    wp_reset_query();
  }
 
}
?>