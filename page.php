<?php 

get_header();

	 if ( have_posts() ): 
	 	while ( have_posts() ): 
	 		the_post();
			get_template_part( 'content-page' ); // get content template
		endwhile;
	else:
		get_template_part( 'content', 'none' );
	endif;

get_footer();

?>