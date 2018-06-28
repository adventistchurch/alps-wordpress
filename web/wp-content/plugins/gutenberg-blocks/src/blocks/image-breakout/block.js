/**
 * BLOCK: Image (Breakout)
 // <style>
 //   .c-breakout-image__background  { background-image: url(https://unsplash.it/500/800); }
 //   @media(min-width: 500px) {
 //     .c-breakout-image__background  { background-image: url(https://unsplash.it/700/800); }
 //   }
 //   @media(min-width: 700px) {
 //     .c-breakout-image__background  { background-image: url(https://unsplash.it/1200/800); }
 //   }
 //   @media(min-width: 1200px) {
 //     .c-breakout-image__background  { background-image: url(https://unsplash.it/1500/900); }
 //   }
 // </style>
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
  var BlockControls = wp.editor.BlockControls;
  var MediaUpload = wp.editor.MediaUpload;

  registerBlockType( 'gutenberg-blocks/image-breakout', {
    title: __('Image (Breakout)'),
    icon: 'format-image',
    description: 'Image that expands the width of the page.',
    category: 'common',

    attributes: {
      caption: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
      imageID: {
        type: 'number',
      },
      imageURL: {
        type: 'string',
        source: 'attribute',
        attribute: 'src',
        selector: 'img',
      },
    },

    edit: function( props ) {
      var attributes = props.attributes;

      var onSelectImage = function( media ) {
        return props.setAttributes( {
          imageURL: media.url,
          imageID: media.id,
        } );
      };

      return [
        el ( 'div', {
          className: props.className,
        },
          el( 'div', {
            className: attributes.imageID,
            style: attributes.imageID ? { backgroundImage: 'url('+attributes.imageURL+')' } : {}
          },
            el( MediaUpload, {
              onSelect: onSelectImage,
              type: 'image',
              value: attributes.imageID,
              render: function( obj ) {
                return el( components.Button, {
                  className: attributes.imageID ? 'image-button' : 'button button-large',
                  onClick: obj.open
                  },
                  ! attributes.imageID ? __( 'Upload Image' ) : el( 'img', { src: attributes.imageURL } )
                );
              }
            } )
          ),
          el( RichText, {
            tagName: 'p',
            placeholder: 'Caption',
            keepPlaceholderOnFocus: true,
            isSelected: false,
            value: attributes.citation,
            onChange: function( newCaption ) {
              props.setAttributes( { caption: newCaption } );
            }
          } ),
        )
      ];
    },

    save: function( props ) {
      var attributes = props.attributes;

      return (
        <div className="u-shift--left--1-col--at-large">
          <section className="l-grid l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7">
            <div className="u-width--100p u-padding--zero--sides">
              <div className="c-breakout-image">
                <div className="c-breakout-image__background u-image--breakout u-background--cover" style={ { backgroundImage: `url('${ attributes.imageURL }');` } }></div>
                <div className="c-breakout-image__caption">
                  <figcaption className="o-figcaption">
                    <p className="o-caption u-color--gray u-font--secondary--s">{ attributes.caption }</p>
                  </figcaption>
                </div>
              </div>
            </div>
          </section>
        </div>
      );
    }

  });

} )(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
);
