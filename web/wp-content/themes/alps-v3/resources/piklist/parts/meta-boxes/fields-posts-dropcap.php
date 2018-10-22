<?php
/*
  Title: Hide the Dropcap
  Post Type: post
  Order: 6
  Context: side
*/

  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'hide_dropcap',
    'label' => 'Hide the Dropcap',
    'description' => 'Hides the dropcap on the page/post body.',
    'columns' => 12,
    'choices' => array(
      'true' => 'Hide the dropcap'
    )
  ));
?>
