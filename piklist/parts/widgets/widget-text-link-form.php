<?php
  piklist('field', array(
    'type' => 'text',
    'field' => 'title',
    'label' => 'Title',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'textarea',
    'field' => 'content',
    'label' => 'Content',
    'attributes' => array(
      'rows' => 10,
      'cols' => 50
    )
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'url_text',
    'label' => 'Url Text',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'url',
    'label' => 'Url',
    'columns' => 6
  ));
?>
