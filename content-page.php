
<!-- START: Single posts -->
	<article class="hentry wrapper style5">
		<div class="inner">

			<?php
			// Get featured image
			if ( has_post_thumbnail() ) {
				echo '<div class="image left">';
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
					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>
				
				<?php the_content(); ?>
			</div>

		</div>
	</article>
<!-- END: Single posts -->