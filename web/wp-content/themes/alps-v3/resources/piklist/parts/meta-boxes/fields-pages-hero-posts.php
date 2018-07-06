<?php
/*
  Title: Hero
  Post Type: page
  Order: 2
  Template: views/template-posts.blade
*/


  piklist( 'field', array(
    'type' => 'checkbox',
    'field' => 'show_hero_featured_post',
    'label' => 'Hero Featured Post',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to display a featured post in the hero.'
    )
  ));
  piklist( 'field', array(
    'type' => 'select',
    'field' => 'hero_featured_post',
    'label' => 'Post',
    'description' => 'Select a post to display.',
    'columns' => 12,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'show_hero_featured_post',
        'value' => 'true'
      )
    ),
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
