<?php 

get_header();

	if ( is_archive() || is_search() ) :
		echo '<header class="my-archive-header">';
		echo '<div class="my-archive-title">'. blog_aink_archive_title() .'</div>';
		echo '</header>';
	endif;

	// The loop
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() ); // get content template
		}
	} else {
		get_template_part( 'content', 'none' );
	}

	// Pagination
	get_template_part( 'includes/pagination' );

get_footer();

 ?>