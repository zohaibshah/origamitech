<?php

get_header(); 



$variant=1;
$header_html = get_post_field( 'post_content', lc_get_partial_postid('is_single_post', $variant), 'raw' );
echo "\n\n\n<main id='lc-single'>".do_shortcode(lc_neutralize_section_tags(lc_strip_lc_attributes($header_html)))."</main>\n\n\n";


/*
if(have_posts()):
  
	while(have_posts()):
		the_post();
		 
		the_content();
	endwhile;
 endif;
 */

 
 
 get_footer();