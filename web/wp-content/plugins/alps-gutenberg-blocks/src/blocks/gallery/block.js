/**
 * External dependencies
 */
const { filter, every } = lodash;
import './style.scss';
import Edit, { defaultColumnsNumber } from './edit';

/**
 * WordPress dependencies
 */

const { __ } = wp.i18n;
const el = wp.element.createElement;
const { registerBlockType } = wp.blocks;
const RichText = wp.editor.RichText;
const editorMediaUpload = wp.editor.editorMediaUpload;
const name = 'core/gallery';

registerBlockType( 'alps-gutenberg-blocks/gallery', {
  title: __('Gallery'),
  description: __('Display a gallery images in a container that expands on click.'),
  icon: 'format-gallery',
  category: 'common',
  attributes: {
    title: {
      type: 'array',
      source: 'children',
      selector: '.o-title',
    },
    images: {
      type: 'array',
      default: [],
      source: 'query',
      selector: '.wp-block-alps-gutenberg-blocks-gallery .c-gallery-block__image',
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
          selector: '.c-gallery-block__caption',
        },
      },
    },
  },

  edit: function( props ) {
  	return <Edit {...props} />
  },

  save: function( { attributes } ) {
    const { images } = attributes;
    return (
      <div className="c-gallery-block__image">
        <div className="js-this c-gallery-block c-block u-background-color--gray--light u-border--left u-theme--border-color--darker--left can-be--dark-dark">
          <div className="c-gallery-block__header">
            <div className="c-gallery-block__title u-padding u-spacing--half">
              <h2 className="u-font--primary--s u-theme--color--darker">
                <span className="u-theme--color--base"><em>Gallery</em></span> <span className="o-title">{ attributes.title }</span>
              </h2>
              <button className="c-gallery-block__toggle js-toggle o-button o-button--outline o-button--toggle o-button--small" data-toggled="this" data-prefix="this"><span class="u-icon u-icon--xs u-path-fill--white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>o-icon__plus</title><path d="M10,4H6V0H4V4H0V6H4v4H6V6h4Z" fill="#9b9b9b"/></svg></span></button>
            </div>
            <div className="c-gallery-block__thumb u-background--cover" style={ { backgroundImage: `url('${ images.map( ( image, index ) => image.url )[0] }');` } }>
            </div>
          </div>

          <div className="c-gallery-block__body">
            { images.map( ( image ) =>
              <div key={ image.id || image.url } className="c-gallery-block__image">
                <img src={ image.url } alt={ image.alt } data-id={ image.id } />
                <div className="c-gallery-block__caption u-font--secondary--s u-color--gray u-padding u-padding--double--bottom">
                  { image.caption }
                </div>
              </div>
            ) }
          </div>
        </div>
      </div>
    );
  },
} );
