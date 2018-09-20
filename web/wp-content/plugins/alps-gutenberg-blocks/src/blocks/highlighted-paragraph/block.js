/**
 * BLOCK: Highlighted Paragraph
 */

import './style.scss';
import './editor.scss';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText

  registerBlockType( 'alps-gutenberg-blocks/highlighted-paragraph', {
    title: __('Highlighted Paragraph'),
    icon: 'media-text',
    description: 'Highlight a block of text.',
    category: 'common',

    attributes: {
      content: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
    },

    edit: function( props ) {
      var attributes = props.attributes;

      return (
        el( 'div', {
          className: props.className
        },
          el( RichText, {
            tagName: 'p',
            placeholder: 'Content goes here...',
            keepPlaceholderOnFocus: true,
            value: attributes.content,
            isSelected: false,
            onChange: function( newContent ) {
              props.setAttributes( { content: newContent } );
            }
          } )
        )
      );
    },

    save: function( props ) {
      var attributes = props.attributes;

      return (
        el( 'div', {
          className: props.className
        },
          el( RichText.Content, {
            tagName: 'p',
            className: 'o-highlight u-padding u-background-color--gray--light can-be--dark-dark',
            value: attributes.content
          } )
        )
      );
    }

  } );

} )(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
);
