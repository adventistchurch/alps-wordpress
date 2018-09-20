/**
 * BLOCK: Content Show More
 */

import './style.scss';
import './editor.scss';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText;
  var MediaUpload = wp.editor.MediaUpload;

  registerBlockType( 'alps-gutenberg-blocks/content-show-more', {
    title: __('Content Show More'),
    icon: 'editor-expand',
    description: 'Content block that has a toggle button to show more.',
    category: 'common',
    html: false,

    attributes: {
      title: {
        type: 'array',
        source: 'children',
        selector: 'strong',
      },
      description: {
        type: 'array',
        source: 'children',
        selector: '.o-description',
      },
      body: {
        type: 'array',
        source: 'children',
        selector: '.o-paragraph',
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

      return (
        el( 'div', {
          className: props.className
        },
          el( 'div', {
            className: 'o-image--' + attributes.imageID + ' o-image'
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
            tagName: 'strong',
            placeholder: 'Title',
            className: 'o-heading--l',
            keepPlaceholderOnFocus: true,
            isSelected: false,
            value: attributes.title,
            onChange: function( newTitle ) {
              props.setAttributes( { title: newTitle } );
            }
          } ),
          el( RichText, {
            tagName: 'p',
            className: 'o-description',
            placeholder: 'Description',
            keepPlaceholderOnFocus: true,
            isSelected: false,
            value: attributes.description,
            onChange: function( newDescription ) {
              props.setAttributes( { description: newDescription } );
            }
          } ),
          el( RichText, {
            tagName: 'p',
            className: 'o-paragraph',
            placeholder: 'Body (Display on click of show more button)',
            keepPlaceholderOnFocus: true,
            isSelected: false,
            value: attributes.body,
            onChange: function( newBody ) {
              props.setAttributes( { body: newBody } );
            }
          } )
        )
      );
    },

    save: function( props ) {
      var attributes = props.attributes;
      var imageClass = '';
      if (attributes.imageURL) {
        var imageClass = 'has-image ';
        var image = <img className="c-block__image" src={ `${ attributes.imageURL }` } />;
      }

      return (
        <div>
          <div className={ `${imageClass}c-block c-block__text u-theme--border-color--darker u-border--left c-block__text-expand u-spacing u-background-color--gray--light u-padding u-clear-fix can-be--dark-dark`}>
            {image}
            <h3 className="u-theme--color--darker u-font--primary--m">
              <strong>{ attributes.title }</strong>
            </h3>
            <p className="c-block__body text o-description">{ attributes.description }</p>
            <div className="c-block__content">
              <p className="o-paragraph">{ attributes.body }</p>
            </div>
            <a className="o-button o-button--outline o-button--expand js-toggle-parent"></a>
          </div>
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
