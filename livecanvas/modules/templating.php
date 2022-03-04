<?php


//FOR SINGLE PAGES & POSTS WITH LC and PARTIALS: ENFORCE a plugin-based, THEME - INDEPENDENT, clean SINGLE TEMPLATE 

//add_filter( 'page_template', 'lc_load_custom_template_for_posts_using_livecanvas');//old 
//add_filter( 'single_template', 'lc_load_custom_template_for_posts_using_livecanvas');// old
add_filter( 'template_include', 'lc_load_custom_template_for_posts_using_livecanvas', 99); //more powerful, intercepts also CPTs - added in 2.1.1



function lc_load_custom_template_for_posts_using_livecanvas ($single_template){
	global $post; 
	if ( lc_plugin_option_is_set("force-embedded-template-for-lc-pages")  &&  is_singular() &&  lc_post_is_using_livecanvas($post->ID) ) 
		$single_template = dirname( __FILE__ ) . '/templates/single-lc-template.php';
	return $single_template;

}



// EXPERIMENTAL: add BS CSS on the fly

add_action('wp_head',function(){ 
	if (!lc_plugin_option_is_set("add-bootstrap-css") )return;
	?>
	<!-- THE FOLLOWING CODE IS ADDED BY THE LIVECANVAS PLUGIN, add-bootstrap-css BECAUSE YOU HAVE THE OPTION ACTIVATED IN THE BACKEND -->
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!--  
	<style>
		#lc-main {
			width: 100vw;
			position: relative;
			margin-left: -50vw;
			height: 100px;
			margin-top: 100px;
			left: 50%;
		} 
	</style>
	-->
	<!-- /THE FOLLOWING CODE IS ADDED BY THE LIVECANVAS PLUGIN, add-bootstrap-css BECAUSE YOU HAVE THE OPTION ACTIVATED IN THE BACKEND -->
<?php }); 








//OPT-IN DYNAMIC SINGLE POST TEMPLATE 
add_filter( 'single_template', function($single_template){
	global $post;
	if (  lc_plugin_option_is_set("single_post_template")  &&  is_single() &&  'post' === $post->post_type ) $single_template = dirname( __FILE__ ) . '/templates/single-post-dynamic-template.php';
	return $single_template;
} );

//SHORTCODE FOR GRABBING SINGLE POST DATA IN DYNAMIC SINGLE TEMPLATE 
add_shortcode( 'single_post_data', function( $atts ) {
	
	$attributes = shortcode_atts( array(
		'field' => 'default',	 
	), $atts );
 
    global $post;
	
	switch ($attributes['field']) {
		case 'title':
			return get_the_title( absint( $post->id ) );
			break;
		case 'content':
			remove_filter('the_content', 'wptexturize'); //remove #38
			return apply_filters('the_content', $post -> post_content);
			break;
	}

	return "Please specify field";
});

