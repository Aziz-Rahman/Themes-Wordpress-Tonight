<!-- START: Single posts -->
	<article class="hentry wrapper style5">
		<div class="inner">

			<?php if ( has_post_format( 'video' ) ) {
			echo '<div class="image left"><div class="fluid-width-video-wrapper">';
			echo wp_oembed_get( get_field( 'post_format_video' ) );
			echo '</div></div>';

			} else if ( has_post_format( 'status' ) ) {
			$featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); // Get featured image url
			echo '<div class="image left socmed-thumbnail" style="background: url('.$featured_image.') center center; background-size: cover;">';
			echo wp_oembed_get( esc_url( get_field( 'post_format_status' ) ) );
			echo '</div>';

			} else if ( has_post_format( 'audio' ) ) {
			echo '<div class="image left">';
			echo wp_oembed_get( get_field( 'post_format_audio' ) );
			echo '</div>';
			//etc

			} else {
			echo '<div class="image left">';
			the_post_thumbnail( 'blog-image' );
			echo '</div>';
			}
			?>

			<div class="content">
				<header class="head-article">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<?php blog_aink_post_meta(); ?>
				</header>
				
				<?php
				the_content();
				echo "<div class='post-tags'>";
				the_tags('<span><i class="fa fa-tags"></i> <b>Tags : </b></span>', ', &nbsp; ', '');
				echo "</div>";
				?>

				<?php 
					if ( is_single() ) :
					get_template_part( 'includes/share-buttons' ); // display share buttons
					endif; 
				?>
			</div>

		</div>
	</article>
<!-- END: Single posts -->