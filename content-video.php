
<!-- START: Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post hentry spotlight' ); ?>>

	<?php
	if ( has_post_format( 'video' ) ) {
		echo '<div class="image my-format-video">';
		echo wp_oembed_get( get_field( 'post_format_video' ) );
		echo '</div>';
	}
	?>

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