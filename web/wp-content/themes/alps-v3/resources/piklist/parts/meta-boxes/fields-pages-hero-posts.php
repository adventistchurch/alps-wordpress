<?php
/*
  Title: Hero
  Post Type: page
  Order: 2
  Template: views/template-posts.blade
*/
  piklist( 'field', array(
    'type' => 'select',
    'field' => 'hero_featured_post',
    'label' => 'Hero Featured Post',
    'description' => 'Select a post to display.',
    'columns' => 12,
    'choices' => piklist(
      get_posts(
        array(
          'post_type' => 'post',
          'numberposts' => -1,
          'orderby' => 'title',
          'order' => 'ASC'
        )
      ),
      array(
        'ID',
        'post_title'
      )
    )
  ));
?>
