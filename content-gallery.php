
<!-- START: Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post hentry spotlight' ); ?>>
	<?php
	// Get featured image
	if ( has_post_thumbnail() ) {
		echo '<div class="image">';
		the_post_thumbnail( 'blog-image' );
		echo '</div>';
	} else {
		echo '<div class="image">';
		echo '<img src="http://placehold.it/780x440/f5f5f5/666666/&text=&nbsp;" alt="" />';
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