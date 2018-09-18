/**
 * BLOCK: Content Block
 */

import './style.scss';
import './editor.scss';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText;
  var TextControl = wp.components.TextControl;
  var BlockControls = wp.editor.BlockControls;
  var AlignmentToolbar = wp.editor.AlignmentToolbar;

  registerBlockType( 'alps-gutenberg-blocks/content-block', {
    title: __('Content Block'),
    description: 'Content block that highlights a row to text.',
    icon: 'welcome-write-blog',
    category: 'common',
    html: false,

    attributes: {
      title: {
        type: 'array',
        source: 'children',
        selector: 'strong',
      },
      body: {
        type: 'array',
        source: 'children',
        selector: 'p',
      },
      link: {
        type: 'url',
      },
    },

    edit: function( props ) {
      var attributes = props.attributes;

      return [
        el ( 'div', {
          className: props.className,
        },
          el ( 'div', {},
            el( RichText, {
              tagName: 'strong',
              value: attributes.title,
              placeholder: 'Title',
              keepPlaceholderOnFocus: true,
              isSelected: false,
              onChange: function( newTitle ) {
                props.setAttributes( { title: newTitle } );
              }
            } ),
            el( RichText, {
              tagName: 'p',
              value: attributes.body,
              placeholder: 'Write a description...',
              keepPlaceholderOnFocus: true,
              isSelected: false,
              onChange: function( newBody ) {
                props.setAttributes( { body: newBody } );
              }
            } ),
            el( TextControl, {
              type: 'url',
              label: __( 'Link Url' ),
              value: attributes.link,
              placeholder: 'http://',
              keepPlaceholderOnFocus: true,
              isSelected: false,
              onChange: function( newLink ) {
                props.setAttributes( { link: newLink } );
              }
            } ),
          ),
        )
      ];
    },

    save: function( props ) {
      var attributes = props.attributes;

      if (attributes.link) {
        var title =
        <h3 className="u-theme--color--darker u-font--primary--m">
          <a href={ `${ attributes.link }` } className="c-block__title-link u-theme--link-hover--dark">
            <strong>{ attributes.title }</strong>
          </a>
        </h3>;
        var button =
        <a href={ `${ attributes.link }` } className="c-block__button o-button o-button--outline">Read More<span className="u-icon u-icon--m u-path-fill--base u-space--half--left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18.29,8.59l-3.5-3.5L13.38,6.5,15.88,9H.29v2H15.88l-2.5,2.5,1.41,1.41,3.5-3.5L19.71,10Z"></path></svg></span></a>;
      } else {
        var title =
        <h3 className="u-theme--color--darker u-font--secondary--m u-text-transform--upper">
          <strong>{ attributes.title }</strong>
        </h3>;
      }

      return (
        <div>
          <div className="c-block c-block__text u-theme--border-color--darker u-border--left u-spacing--half">
            {title}
            <p className="c-block__body text">{ attributes.body }</p>
            {button}
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
