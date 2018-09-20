/**
 * BLOCK: Blockquote
 */

import './style.scss';
import './editor.scss';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText;
  var InspectorControls = wp.editor.InspectorControls;
  var ToggleControl = wp.components.ToggleControl;

  registerBlockType( 'alps-gutenberg-blocks/blockquote', {
    title: __('Blockquote'),
    icon: 'format-quote',
    category: 'common',
    html: false,

    attributes: {
      body: {
        type: 'array',
        source: 'children',
        selector: '.o-paragraph',
      },
      citation: {
        type: 'array',
        source: 'children',
        selector: '.o-citation',
      },
      applyStyles: {
        type: 'string',
        default: '',
      },
    },

    edit: function( props ) {
      var attributes = props.attributes;

      function updateStyles() {
        if (attributes.applyStyles) {
          props.setAttributes( { applyStyles: '' } );
        } else {
          props.setAttributes( { applyStyles: 'o-pullquote--extended' } );
        }
      }

      return [
        el(
          InspectorControls, {
            key: 'inspector'
          },
          el(
            ToggleControl, {
              label: 'Extend Quote',
              help: 'Extends the quote outside the page content.',
              checked: attributes.applyStyles,
              onChange: updateStyles
            }
          ),
        ),
        el ( 'blockquote', {
          className: props.className,
        },
          el ( 'blockquote', {},
            el( RichText, {
              tagName: 'p',
              placeholder: 'Write a quote...',
              keepPlaceholderOnFocus: true,
              isSelected: false,
              value: attributes.body,
              onChange: function( newBody ) {
                props.setAttributes( { body: newBody } );
              }
            } ),
            el( RichText, {
              tagName: 'cite',
              placeholder: 'Citation',
              keepPlaceholderOnFocus: true,
              isSelected: false,
              value: attributes.citation,
              onChange: function( newCitation ) {
                props.setAttributes( { citation: newCitation } );
              }
            } ),
          ),
        )
      ];
    },

    save: function( props ) {
      var attributes = props.attributes;

      return (
        <blockquote className={ 'pullquote u-theme--border-color--darker--left u-theme--color--darker u-padding--right ' + attributes.applyStyles }>
          <p className="o-paragraph">{ attributes.body }</p>
          <cite className="o-citation u-theme--color--base">{ attributes.citation }</cite>
        </blockquote>
      );
    }

  });

} )(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
);
