<?php
  piklist('field', array(
    'type' => 'text',
    'field' => 'text_link_title',
    'label' => 'Title',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'textarea',
    'field' => 'text_link_content',
    'label' => 'Content',
    'attributes' => array(
      'rows' => 10,
      'cols' => 50
    )
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'text_link_url',
    'label' => 'Url',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'text_link_url_text',
    'label' => 'Url Text',
    'columns' => 6
  ));
?>
