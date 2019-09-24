<?php

get_header();

	 if ( have_posts() ): 
	 	while ( have_posts() ): 
	 		the_post();
			get_template_part( 'content-single', get_post_format() );// get content template
			comments_template( '', true ); // display comments
		endwhile;
	else :
		get_template_part( 'content', 'none' );
	endif;

get_footer();

?>