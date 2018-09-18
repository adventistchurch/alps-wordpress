/**
 * BLOCK: Content Expand
 */

import './style.scss';
import './editor.scss';

( function( blocks, components, i18n, element ) {
  var __ = wp.i18n.__;
  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
  var RichText = wp.editor.RichText;

  registerBlockType( 'alps-gutenberg-blocks/content-expand', {
    title: __('Content Expand'),
    icon: 'arrow-down-alt',
    description: 'Content block that expands the content on click.',
    category: 'common',
    html: false,

    attributes: {
      kicker: {
        type: 'array',
        source: 'children',
        selector: 'em',
      },
      title: {
        type: 'array',
        source: 'children',
        selector: 'font',
      },
      body: {
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
            tagName: 'em',
            placeholder: 'Kicker',
            className: 'o-kicker',
            keepPlaceholderOnFocus: true,
            isSelected: false,
            value: attributes.kicker,
            onChange: function( newKicker ) {
              props.setAttributes( { kicker: newKicker } );
            }
          } ),
          el( RichText, {
            tagName: 'font',
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
            placeholder: 'Body',
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

      return (
        <div>
          <div className="js-this c-block c-block c-block__expand u-background-color--gray--light u-border--left u-theme--border-color--darker--left can-be--dark-dark">
            <div className="c-block__header">
              <div className="c-block__title u-padding">
                <h2 className="u-font--primary--s u-theme--color--darker">
                  <span className="u-theme--color--base"><em>{ attributes.kicker }</em> </span><font>{ attributes.title }</font>
                </h2>
                <div className="c-block__toggle">
                  <button className="js-toggle o-button o-button--outline o-button--toggle o-button--small" data-toggled="this" data-prefix="this"><span className="u-icon u-icon--xs u-path-fill--white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>o-icon__plus</title><path d="M10,4H6V0H4V4H0V6H4v4H6V6h4Z" fill="#9b9b9b"/></svg></span></button>
                </div>
              </div>
            </div>
            <div className="c-block__body u-padding u-padding--zero--top u-spacing">
              <p>{ attributes.body }</p>
            </div>
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
