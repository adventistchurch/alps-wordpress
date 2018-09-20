/**
 * BLOCK: Paragraph
 */

import './style.scss';
import './editor.scss';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText;
  var BlockControls = wp.editor.BlockControls;
  var AlignmentToolbar = wp.editor.AlignmentToolbar;

  registerBlockType( 'alps-gutenberg-blocks/paragraph', {
    title: __('Paragraph'),
    icon: 'editor-paragraph',
    description: 'Add some basic text.',
    category: 'common',
    html: false,

    attributes: {
      body: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
      alignment: {
        type: 'string',
      },
    },

    edit: function( props ) {
      var attributes = props.attributes;

      return [
        el( BlockControls, { key: 'controls' },
          el( AlignmentToolbar, {
              value: attributes.alignment,
              onChange: function( newAlignment ) {
                props.setAttributes( { alignment: newAlignment } );
              }
            }
          )
        ),
        el( RichText, {
          key: 'editable',
          tagName: 'p',
          className: props.className,
          style: { textAlign: attributes.alignment },
          value: attributes.body,
          onChange: function( newBody ) {
            props.setAttributes( { body: newBody } );
          }
        } )
      ];
    },

    save: function( props ) {
      var attributes = props.attributes;

      return el( RichText.Content, {
        className: props.className,
        tagName: 'p',
        style: { textAlign: attributes.alignment },
        value: attributes.body
      } );
    }

  });

} )(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
);
