/**
 * BLOCK: Image (2up)
 */

import './style.scss';
import './editor.scss';
import { default as edit, defaultColumnsNumber } from './edit';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText;
	var InspectorControls = wp.editor.InspectorControls;
	var ToggleControl = wp.components.ToggleControl;

  registerBlockType( 'alps-gutenberg-blocks/image-2up', {
    title: __('Image (2up)'),
    description: 'Two images organized in a two column layout.',
    icon: 'format-gallery',
    category: 'common',
    attributes: {
      images: {
        type: 'array',
        default: [],
        source: 'query',
        selector: '.wp-block-gutenberg-blocks-image-2up .l-grid-item--m--3-col',
        query: {
          url: {
            source: 'attribute',
            selector: 'img',
            attribute: 'src',
          },
          link: {
            source: 'attribute',
            selector: 'img',
            attribute: 'data-link',
          },
          alt: {
            source: 'attribute',
            selector: 'img',
            attribute: 'alt',
            default: '',
          },
          id: {
            source: 'attribute',
            selector: 'img',
            attribute: 'data-id',
          },
          caption: {
            type: 'array',
            source: 'children',
            selector: '.o-caption',
          },
        },
      },
    },

    edit,

    save( { attributes } ) {
      const { images } = attributes;

      return (
        <div>
          <section className="l-grid l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7 u-shift--left--1-col--standard">
            { images.map( ( image ) => {
              const img = <picture className="picture">
                <img className={ 'wp-image-' + image.id + ' size-large'} itemprop="image" src={ image.url } alt={ image.alt } data-id={ image.id } />
              </picture>;
              return (
                <div className="l-grid-item--m--3-col u-padding--zero--left">
                  <figure key={ image.id || image.url } className="o-figure">
                    <div className="o-figure__image">
                      { img }
                    </div>
                    <div className="o-figure__caption">
                      <figcaption className="o-figcaption">
                        <p className="o-caption u-color--gray u-font--secondary--s">{ image.caption }</p>
                      </figcaption>
                    </div>
                  </figure>
                </div>
              );
            } ) }
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
