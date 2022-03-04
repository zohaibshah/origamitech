<?php
// EXIT IF ACCESSED DIRECTLY.
defined( 'ABSPATH' ) || exit;

add_action('admin_menu', 'lc_main_options_page');
function lc_main_options_page(){
	$lc_settings = get_option('lc_settings');
	
	// add top level menu page
	add_menu_page('LiveCanvas - Web Authoring Suite', 'LiveCanvas', 'manage_options', 'livecanvas', 'lc_options_page_func', 'dashicons-heart');
	
	add_submenu_page('livecanvas', // Parent slug
		'LiveCanvas Home', // Page title
		'Home', // Menu title
		'manage_options', // Capability
		'livecanvas', // Slug
		false // Function
	);
	
	// add child pages 
	if (isset($lc_settings['header']) or isset($lc_settings['footerV2'])) 
	add_submenu_page('livecanvas', // Parent slug
		'Template Partials', // Page title
		'Template Partials', // Menu title
		'manage_options', // Capability
		'edit.php?post_type=lc_partial', // Slug
		false // Function
	);
	
	add_submenu_page('livecanvas', // Parent slug
		'Your Custom HTML Blocks', // Page title
		'Blocks', // Menu title
		'manage_options', // Capability
		'edit.php?post_type=lc_block', // Slug
		false // Function
	);
	
	if (isset($lc_settings['gtblocks'])) 
	add_submenu_page('livecanvas', // Parent slug
		'Gutenberg Blocks', // Page title
		'Gutenberg Blocks', // Menu title
		'manage_options', // Capability
		'edit.php?post_type=lc_gt_block', // Slug
		false // Function
	);
	
	add_submenu_page('livecanvas', // Parent slug
		'Your Custom HTML Sections', // Page title
		'Sections', // Menu title
		'manage_options', // Capability
		'edit.php?post_type=lc_section', // Slug
		false // Function
	);
	
	add_submenu_page('livecanvas', // Parent slug
		'License', // Page title
		'License', // Menu title
		'manage_options', // Capability
		'livecanvas_license', // Slug
		'lc_license_page_func'	// Function
	);
	
	
}

function lc_admin_menu_active(){
	global $parent_file, $post_type;
	//if ( $post_type == 'CPT' ) {
	$parent_file = 'post';
	//}
				
}
//add_action('admin_head', 'lc_admin_menu_active'); //commented to fix learndash issue




function lc_options_page_func(){
	if (!current_user_can('administrator')) return;
	//show current_settings
	//echo "<pre>";  var_dump(get_option('lc_settings'));  echo "</pre>";
	//delete current settings
	//delete_option('lc_settings');die("DELETED");
	
	
	//GET SETTINGS ARRAY FROM DB
	$lc_settings = get_option('lc_settings');
	?>
	<div class="wrap">
		<img id="lc-logo" src="<?php echo plugins_url("/livecanvas/images/lc-logo.svg") ?>" style="width:200px;height: auto;margin:20px 0 10px;">
		<h1>Welcome to LiveCanvas!</h1>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/P-LsFfZ3o68?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		 <p> <br></p>
	
		<a href="#" onclick='document.querySelector("#wp-admin-bar-lc-add-new-page a").click();' class="button large">Create new LiveCanvas Page Draft</a>
		<a style="margin-left:40px;display:inline-block;margin-top:5px;" target="_blank" href="https://livecanvas.com/documentation/intro/">Plugin Documentation</a>
			
		<br><br>
	
		<h2>Optional Extras</h2>
		
		<style>
			table#lc-settings-table {padding:10px 0 30px;}
			table#lc-settings-table th[scope=row] { text-align: left;padding-right:10px;}
			table#lc-settings-table tr {line-height: 40px;     white-space: nowrap;}
		</style>
		
		<form method="post">
			<?php wp_nonce_field('lc_settings_update'); ?>
		   
			<table id="lc-settings-table">
			  
				<tr>
					<th scope="row" >Add Animations</th>
					<td>
						 <label> 	<input name="aos" type="checkbox" value="1" <?php if (isset($lc_settings['aos'])) echo "checked"; ?> > Adds the <b><a href="https://michalsnik.github.io/aos/" target="_blank">Animate On Scroll</a></b> Library <a target="_blank" href="https://livecanvas.com/blog/adding-animations-with-the-aos-library/">Learn more</a></label> 
					</td>
				</tr>
				<tr>
					<th scope="row" > Gutenberg Blocks</th>
					<td>
						 <label> 	<input name="gtblocks" type="checkbox" value="1" <?php if (isset($lc_settings['gtblocks'])) echo "checked"; ?> > Add admin UX to craft custom blocks with Gutenberg (embeddable via Shortcodes) </label> 
					</td>
				</tr>
				<tr>
					<th scope="row"  >Handle Header  </th>
					<td>
						<label>
							<input name="header" type="checkbox" value="1" <?php if (isset($lc_settings['header'])) echo "checked"; ?> > Use LiveCanvas to design the header <i style="color:red">(requires picostrap or CustomStrap > 2.6)</i>
							<?php if (isset($lc_settings['header'])): ?>		<a style="margin-left:40px;margin-top:6px" target="_blank" class="button" href="<?php  echo add_query_arg(array('lc_action_launch_editing' => '1'),
																																		get_permalink(    lc_get_partial_postid('is_header', "1")  ));  ?>">Launch Header Editor</a>		<?php endif ?>
							
						</label>
					 </td>
				</tr>
				<tr>
					<th scope="row"  >Handle Footer  </th>
					<td>
						<label>
							<input name="footerV2" type="checkbox" value="1" <?php if (isset($lc_settings['footerV2'])) echo "checked"; ?> > Use LiveCanvas to design the footer <i style="color:red">(requires picostrap or CustomStrap > 2.5)</i>
							<?php if (isset($lc_settings['footerV2'])): ?>		<a style="margin-left:40px;margin-top:6px" target="_blank" class="button" href="<?php  echo add_query_arg(array('lc_action_launch_editing' => '1'),
																																		get_permalink(    lc_get_partial_postid('is_footer', "1")  ));  ?>">Launch Footer Editor</a>		<?php endif ?>
							
						</label>
					 </td>
				</tr>
				<tr class="lc-experimental-feature">
					<th scope="row"  >Handle Single Post Template  </th>
					<td>
						<label>
							<input name="single_post_template" type="checkbox" value="1" <?php if (isset($lc_settings['single_post_template'])) echo "checked"; ?> > Use LiveCanvas to design the single post template <i style="color:red">(experimental)</i>
							<?php if (isset($lc_settings['single_post_template'])): ?>		<a style="margin-left:40px;margin-top:6px" target="_blank" class="button" href="<?php  echo add_query_arg(array('lc_action_launch_editing' => '1'),
																																		get_permalink(    lc_get_partial_postid('is_single_post', "1")  ));  ?>">Launch Single Post Template Editor</a>		<?php endif ?>
							
						</label>
					 </td>
				</tr>
				<!--				
				<tr class="lc-experimental-feature">
					<th scope="row"  >  Add the Bootstrap CSS   </th>
					<td>
						<label>
							<input name="add-bootstrap-css" type="checkbox" value="1" <?php if (isset($lc_settings['add-bootstrap-css'])) echo "checked"; ?> >  Enqueue the Bootstrap 4.5.2 CSS (from official CDN). If checked, you'll want to use also the following option </i>
						</label>
					 </td>
				</tr>
				-->				
				<tr>
					<th scope="row"  >  Use on any Theme   </th>
					<td>
						<label>
							<input name="force-embedded-template-for-lc-pages" type="checkbox" value="1" <?php if (isset($lc_settings['force-embedded-template-for-lc-pages'])) echo "checked"; ?> >
							  Enforce Embedded Single Template for pages/posts where LC is enabled. <i style="color:red">(Requires that Theme is using the  BS4 or BS5 CSS)</i>
						</label>
					 </td>
				</tr>

				<tr>
					<th scope="row"  > Use Bootstrap 5    </th>
					<td>
						<label>
							<input name="enable-bs-5" type="checkbox" value="1" <?php if (isset($lc_settings['enable-bs-5'])) echo "checked"; ?> > My Theme is using Bootstrap v5 (instead of v4) <i style="color:red">(Not necessary to check when using picostrap5)</i>
						</label>
					 </td>
				</tr>

				<tr>
					<th scope="row"  >  White Labeling    </th>
					<td>
						<label>
							<input name="whitelabel" type="checkbox" value="1" <?php if (isset($lc_settings['whitelabel'])) echo "checked"; ?> >  Whitelabel the editor</i>
						</label>
					 </td>
				</tr>
				<tr>
					<th scope="row"  > ACF Compatibility Extra    </th>
					<td>
						<label>
							<input name="allow_multiple_editors" type="checkbox" value="1" <?php if (isset($lc_settings['allow_multiple_editors'])) echo "checked"; ?> >  Allow Custom Wysiwyg Editors in the post editing screen (rare use case, leave unchecked)</i>
						</label>
					 </td>
				</tr>
				<!-- 
				<tr class="lc-experimental-feature">
					<th scope="row"  > Legacy Footer </th>
					<td>
						  <label style="opacity:0.4">    <input name="footer" type="checkbox" value="1" <?php if (isset($lc_settings['footer'])) echo "checked"; ?> > [LEGACY - obsolete]	Use a #global-footer SECTION in homepage as a global site footer </label> 
					</td>
				</tr>	
				-->
				<!-- 					
				<tr class="lc-experimental-feature">
					<th scope="row"  > Legacy Content Filtering </th>
					<td>
						  <label style="opacity:0.4">    <input name="legacy-filtering" type="checkbox" value="1" <?php if (isset($lc_settings['legacy-filtering'])) echo "checked"; ?> > [LEGACY - obsolete]	Legacy filtering		</label> 
					</td>
				</tr>
				-->
				<tr class="NOT-lc-experimental-feature">
					<th scope="row"> Disable OB handling </th>
					<td>
						  <label>    
								<input name="disable-ob-handling" type="checkbox" value="1" <?php if (isset($lc_settings['disable-ob-handling'])) echo "checked"; ?> >
                           		DO NOT USE THIS OPTION unless prompted. Breaks optimization plugins. For peculiar PHP environments. 
						 </label> 
					</td>
				</tr>

				<tr class="NOT-lc-experimental-feature">
					<th scope="row"> Disable the Compatibility Filters Plugin </th>
					<td>
						  <label>    
								<input name="disable-mu-plugin" type="checkbox" value="1" <?php if (isset($lc_settings['disable-mu-plugin'])) echo "checked"; ?> >
								Keep unchecked for better compatibility with performance optimization  plugins such as caching, EWWW, etc.
						 </label> 
					</td>
				</tr>

			</table>
			<input class="button-primary" type="submit" name="lc-save-settings" value="Save Settings">
		</form>
	
	</div>
	
	<style>
		.lc-experimental-feature {color:red; display: none}
	</style>
	<script>
		///enable experimental features: CTRL ALT E
		jQuery("#lc-logo").dblclick(function(e) {
			 jQuery('.lc-experimental-feature').show(); 
		});
	</script>
	<?php
}




//OPTIONS SAVING / SUBMIT
add_action('plugins_loaded', function(){
	if (!current_user_can('administrator') OR !is_admin()) return;
	//process eventual submit
	if (isset($_POST['lc-save-settings'])):
		check_admin_referer('lc_settings_update');
		unset($_POST['lc-save-settings']);
		update_option('lc_settings', $_POST, true);
	endif;
	
});
 


function lc_check_license_code($code){
	$response = wp_remote_post( 'https://livecanvas.com/remote/clc/'.$code.'/',array('timeout' => 30, 'method' => 'POST', 'body' =>  "theurl=".get_bloginfo("url")) ); 
	 
	if ( is_array( $response ) && ! is_wp_error( $response ) ) 	return ($response['body']=="OK"); else return FALSE;
}

function lc_license_page_func(){
	if (!current_user_can('administrator')) return;
	
	//process eventual submit
	if (isset($_POST['lc-save-license'])):
					
		check_admin_referer('lc_license_update');

		if ($_POST['license-code']=="" OR lc_check_license_code( $_POST['license-code'])) { 
		
			$lc_settings = get_option('lc_settings');
			$lc_settings['license-code']= $_POST['license-code'];
			update_option('lc_settings', $lc_settings, true);
			if ($lc_settings['license-code']=="") $feedback_message = "<h2> License removed</h2>";
				else $feedback_message = "<h2> License activated successfully</h2>
										<p>The license is valid. </p><p>You will be notified inside the WordPress admin upon availability of upgrades,
										and you will be able to easily upgrade the plugin in one click, as you are used with other Plugins.</p>";
		}
		 else $feedback_message= "<h2>Invalid license code.</h2>";
	endif;
	
	//show current_settings
	//echo "<pre>";  var_dump(get_option('lc_settings'));  echo "</pre>";
	//delete current settings
	//delete_option('lc_settings');die("DELETED");
	
	
	//GET SETTINGS ARRAY FROM DB
	$lc_settings = get_option('lc_settings');
	?>
	<div class="wrap  ">
	<img src="<?php echo plugins_url("/livecanvas/images/lc-logo.svg") ?>" style="width:200px;height: auto;margin:20px 0 10px;">
		<h1>License Management</h1>
		<?php if (isset($feedback_message)) echo $feedback_message; else
				if(  !lc_get_license_code()) {  ?>
					<h3>Plugin updates are important to enjoy new features, maximum stability and security. </h3>
					<p> To enable automatic plugin updates, a valid license code is needed. <br>
					Get it from the <a target="_new" href="https://livecanvas.com/members-area/">members area</a> </p>
					<?php } else { ?>
					
					<?php }	?>
		
		
		<form method="post" style="margin:50px 0; width:400px;font-size:3em; background: #ddd;padding: 20px" >
			<?php wp_nonce_field('lc_license_update'); ?>
		   
			 <input name="license-code" type="password" style="min-width: 100%;" <?php if (isset($lc_settings['license-code'])) echo "value='".esc_attr($lc_settings['license-code'])."'"; ?> placeholder="Paste your license code here..." > 
			 
			<input class="button-primary" type="submit" style="min-width: 100%;" name="lc-save-license" value="Save">
		</form>
	
	
	
	</div>
	<?php
}


 
