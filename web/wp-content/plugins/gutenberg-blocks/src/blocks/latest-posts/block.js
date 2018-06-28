/**
 * BLOCK: Latest Posts
 class LatestPostsEdit extends Component {
 	constructor() {
 		super( ...arguments );

 		this.toggleDisplayPostDate = this.toggleDisplayPostDate.bind( this );
 	}

 	toggleDisplayPostDate() {
 		const { displayPostDate } = this.props.attributes;
 		const { setAttributes } = this.props;

 		setAttributes( { displayPostDate: ! displayPostDate } );
 	}

 	render() {
 		const latestPosts = this.props.latestPosts.data;
 		const { attributes, categoriesList, setAttributes } = this.props;
 		const { displayPostDate, align, order, orderBy, categories, postsToShow } = attributes;

 		const inspectorControls = (
 			<InspectorControls>
 				<PanelBody title={ __( 'Latest Posts Settings' ) }>
 					<QueryControls
 						{ ...{ order, orderBy } }
 						numberOfItems={ postsToShow }
 						categoriesList={ get( categoriesList, [ 'data' ], {} ) }
 						selectedCategoryId={ categories }
 						onOrderChange={ ( value ) => setAttributes( { order: value } ) }
 						onOrderByChange={ ( value ) => setAttributes( { orderBy: value } ) }
 						onCategoryChange={ ( value ) => setAttributes( { categories: '' !== value ? value : undefined } ) }
 						onNumberOfItemsChange={ ( value ) => setAttributes( { postsToShow: value } ) }
 					/>
 				</PanelBody>
 			</InspectorControls>
 		);

 		const hasPosts = Array.isArray( latestPosts ) && latestPosts.length;
 		if ( ! hasPosts ) {
 			return (
 				<Fragment>
 					{ inspectorControls }
 					<Placeholder
 						icon="admin-post"
 						label={ __( 'Latest Posts' ) }
 					>
 						{ ! Array.isArray( latestPosts ) ?
 							<Spinner /> :
 							__( 'No posts found.' )
 						}
 					</Placeholder>
 				</Fragment>
 			);
 		}

 		// Removing posts from display should be instant.
 		const displayPosts = latestPosts.length > postsToShow ?
 			latestPosts.slice( 0, postsToShow ) :
 			latestPosts;

 		return (
 			<Fragment>
 				{ inspectorControls }
 				<ul className={ classnames( this.props.className ) } >
 					{ displayPosts.map( ( post, i ) =>
 						<li key={ i }>
 							<a href={ post.link } target="_blank">{ decodeEntities( post.title.rendered.trim() ) || __( '(Untitled)' ) }</a>
 							{ displayPostDate && post.date_gmt &&
 								<time dateTime={ moment( post.date_gmt ).utc().format() } className={ `${ this.props.className }__post-date` }>
 									{ moment( post.date_gmt ).local().format( 'MMMM DD, Y' ) }
 								</time>
 							}
 						</li>
 					) }
 				</ul>
 			</Fragment>
 		);
 	}
 }
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
	var withAPIData = wp.components.withAPIData;

  registerBlockType( 'gutenberg-blocks/latest-posts', {
		title: __( 'Latest Posts' ),
		description: __( 'Display a list of your most recent posts.' ),
		icon: 'list-view',
		category: 'common',
		supports: {
			html: false,
		},
		attributes: {
			categories: {
				type: 'string',
			},
			className: {
				type: 'string',
			},
			postsToShow: {
				type: 'number',
				default: 5,
			},
			displayPostDate: {
				type: 'boolean',
				default: false,
			},
			order: {
				type: 'string',
				default: 'desc',
			},
			orderBy: {
				type: 'string',
				default: 'date',
			},
		},

		edit: withAPIData( function( props ) {
			var attributes = props.attributes;

			// var latestPostsQuery = function() {
			// 	JSON.stringify(
			// 		pickBy( {
			// 			attributes.categories ,
			// 			attributes.order ,
			// 			orderby: attributes.orderBy ,
			// 			per_page: attributes.postsToShow ,
			// 			_fields: [ 'date_gmt', 'link', 'title' ],
			// 		},
			// 			( value ) => ! isUndefined( value )
			// 		)
			// 	);
			// };

			var latestPostsQuery = Object.keys(attributes).map(function(key) {
			    return key + '=' + params[key]
			}).join('&');

			return {
				latestPosts: `/wp/v2/posts?${ latestPostsQuery }`,
			};
		} ),

		save: function() {
      // Rendering in PHP
      return null;
    },
  });

} )(
  window.wp.blocks,
  window.wp.components,
  window.wp.i18n,
  window.wp.element,
);
