<?php

/**
 * Function to collect the title of the current page
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if ( ! function_exists( 'blog_aink_archive_title' ) ) {
	function blog_aink_archive_title() {
		global $wp_query;

		$title = '';
		if ( is_category() ) :
			$title = sprintf( __( 'Category Archives: %s', 'blog_aink' ), single_cat_title( '', false ) );
		elseif ( is_tag() ) :
			$title = sprintf( __( 'Tag Archives: %s', 'blog_aink' ), single_tag_title( '', false ) );
		elseif ( is_tax() ) :
			$title = sprintf( __( '%s Archives', 'blog_aink' ), get_post_format_string( get_post_format() ) );
		elseif ( is_day() ) :
			$title = sprintf( __( 'Daily Archives: %s', 'blog_aink' ), date_i18n() );
		elseif ( is_month() ) :
			$title = sprintf( __( 'Monthly Archives: %s', 'blog_aink' ), date_i18n( 'F Y' ) );
		elseif ( is_year() ) :
			$title = sprintf( __( 'Yearly Archives: %s', 'blog_aink' ), date_i18n( 'Y' ) );
		elseif ( is_author() ) :
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$title = sprintf( __( 'Author Archives: %s', 'blog_aink' ), get_the_author_meta( 'display_name', $author->ID ) );
		elseif ( is_search() ) :
			if ( $wp_query->found_posts ) {
				$title = sprintf( __( 'Search Results for: "%s"', 'blog_aink' ), esc_attr( get_search_query() ) );
			} else {
				$title = sprintf( __( 'No Results for: "%s"', 'blog_aink' ), esc_attr( get_search_query() ) );
			}
		elseif ( is_404() ) :
			$title = __( 'Not Found', 'blog_aink' );
		else :
			$title = __( 'Blog', 'blog_aink' );
		endif;
		
		return $title;
	}
}


/**
 * Function to load comment list
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if ( ! function_exists( 'blog_aink_comment_list' ) ) {
	function blog_aink_comment_list($comment, $args, $depth) {
		global $post;
		$author_post_id = $post->post_author;
		$GLOBALS['comment'] = $comment;

		// Allowed html tags will be display
		$allowed_html = array(
			'a' => array( 'href' => array(), 'title' => array() ),
			'abbr' => array( 'title' => array() ),
			'acronym' => array( 'title' => array() ),
			'strong' => array(),
			'b' => array(),
			'blockquote' => array( 'cite' => array() ),
			'cite' => array(),
			'code' => array(),
			'del' => array( 'datetime' => array() ),
			'em' => array(),
			'i' => array(),
			'q' => array( 'cite' => array() ),
			'strike' => array(),
			'ul' => array(),
			'ol' => array(),
			'li' => array()
		);
		
		switch ( $comment->comment_type ) :
			case '' :
	?>
		
			<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
			<div class="main-comment">
				<div class="thumbnail">
					<?php echo get_avatar( $comment, 60 ); ?>
				</div>

				<div class="comment-meta">
					<span class="author"><?php comment_author(); ?></span>
					<span class="date"><?php echo get_comment_date( 'F d, Y h.i a' ); ?></span>
				</div>

				<div class="clearfix"></div>
				
				<div class="detail">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="moderate"><?php _e( 'Your comment is now awaiting moderation before it will appear on this post.', 'tonight' );?></p>
					<?php endif; ?>
					<?php echo apply_filters( 'comment_text', wp_kses( get_comment_text(), $allowed_html ) );  ?>

					<div class="reply">
					<?php echo comment_reply_link( array( 'reply_text' => __( 'Reply', 'tonight' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) );  ?>&nbsp;	
					<span class="edit-link"><?php edit_comment_link( __( 'Edit', 'tonight' ), '', '' ); ?></span>
					</div><!-- .reply -->
				</div>
			</li><!-- -->
			<hr>

	<?php
			break;
			case 'pingback'  :
			case 'trackback' :
	?>
				<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
					<div class="comment-box clearfix">
						<div class="author">
							<a href="<?php comment_author_url()?>"><?php _e('Pingback', 'blog_aink'); ?></a>
						</div>
						<div class="comment-body">
							<?php comment_author(); ?>
						</div>
						<div class="meta">
							<?php comment_date(); echo ' - '; comment_time(); ?>
							<span class="edit-link"><?php edit_comment_link(__('<i class="fa fa-edit"></i> Edit Comment', 'blog_aink'), '', ''); ?></span>
						</div>
						<hr class="comment-line"/>
					</div>
				</li>	
	<?php
			break;
		endswitch;
	}
}


if ( ! function_exists( 'blog_aink_comment_form_top' ) ) {
	function blog_aink_comment_form_top() {
}
	add_action( 'comment_form_top', 'blog_aink_comment_form_top' );

	function blog_aink_comment_form_bottom() {

	}
}
add_action( 'comment_form', 'blog_aink_comment_form_bottom', 1 );


/**
 * Gallery function
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */

if ( ! function_exists( 'my_gallery' ) ) {
	function my_gallery( $content, $attr ) {
		// Call WordPress thickbox library
		add_thickbox();

		if ( get_post_format() == 'gallery' ) {
			$post = get_post();
			static $instance = 0;
			$instance++;
			
			if ( isset( $attr['orderby'] ) ) :
				$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
				if ( !$attr['orderby'] )
					unset( $attr['orderby'] );
			endif;

			extract( shortcode_atts( array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post ? $post->ID : 0,
				'size'       => 'thumbnail',
				'include'    => '',
				'exclude'    => ''
			), $attr ) );

			$id = intval( $id );
			if ( 'RAND' == $order )
				$orderby = 'none';

			if ( !empty( $include ) ) {
				$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

				$attachments = array();
				foreach ( $_attachments as $key => $val ) {
					$attachments[ $val->ID ] = $_attachments[ $key ];
				}
			} elseif ( !empty( $exclude ) ) {
				$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
			} else {
				$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
			}

			$size = 'thumbnail';

			if ( empty( $attachments ) )
				return '';

			if ( is_feed() ) {
				$output = "\n";
				foreach ( $attachments as $att_id => $attachment )
					$output .= wp_get_attachment_image( $att_id, $size ) . "\n";
				return $output;
			}

			$output = "<div id='gallery-{$instance}' class='gallery galleryid-{$id}'>";

			$i = 0;
			foreach ( $attachments as $id => $attachment ) {
				if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] )
					$image_output = wp_get_attachment_link( $id, $size );
				elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] )
					$image_output = wp_get_attachment_link( $id, $size );
				else
					$image_output = wp_get_attachment_link( $id, $size );

				$image_meta  = wp_get_attachment_metadata( $id );

				$output .= "\n";
				$output .= "$image_output";
				$output .= "\n";
			}
			$output .= "</div>";

			return $output;
		}
	}
}
add_filter( 'post_gallery', 'my_gallery', 10, 2 );


/**
 * Function to display post meta
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if ( ! function_exists( 'blog_aink_post_meta' ) ) {
	function blog_aink_post_meta() {
		global $post;
		$author = '<a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author() . '</a>';
?>

		<div class="entry-meta">
			<span><i class="fa fa-user"></i><?php echo ' By '. $author; ?></span> / 
			<span><i class="fa fa-calendar-check-o"></i> <?php echo date_i18n( 'F jS, Y', strtotime( get_the_date('Y-m-d'), false ) ); ?></span> /
			<span><i class="fa fa-comments"></i> <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); _e( ' Comments', 'blog_aink' ); ?></a></span>
		</div>
<?php
	}
}


/**
 * Change default excerpt more text
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if( !function_exists( 'blog_aink_excerpt_more ') ) {
	function blog_aink_excerpt_more() {
		return ' ...';
	}
}
add_filter( 'excerpt_more', 'blog_aink_excerpt_more', 999 );


/**
 * Change default excerpt length
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if( !function_exists( 'blog_aink_excerpt_length ') ) {
	function blog_aink_excerpt_length( $length ) {
		global $tonight_option;
		return $tonight_option['post_excerpt_length'];
	}
}
add_filter( 'excerpt_length', 'blog_aink_excerpt_length', 999 );