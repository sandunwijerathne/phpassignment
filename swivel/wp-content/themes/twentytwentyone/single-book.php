<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content/content-single' );

	
	
endwhile; // End of the loop.
get_sidebar( 'content' );
get_sidebar();
get_footer();

?>