
<!-- START: Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post hentry spotlight' ); ?>>

	 <?php if( function_exists('get_field') && get_field( 'post_format_status' ) ) :
		$featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); // Get featured image url ?>
		<div class="image format-status-article" style="background: url(<?php echo $featured_image; ?>) center center; background-size: cover;">
			<?php echo wp_oembed_get( esc_url( get_field( 'post_format_status' ) ) ); // Get external status ?>
		</div>
	<?php endif; ?>

	<div class="content">
		<header class="head-article">
			<?php if ( ! is_single() ) : ?>
				<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>
			<!-- Post meta -->
			<?php blog_aink_post_meta(); ?>
		</header>

		<div class="entry-content">
			<?php
			if ( ! is_single() ) :
				the_excerpt();
			endif;
			?>
		</div>
	</div> <!-- END: class content -->

</article>
<!-- END: Article -->