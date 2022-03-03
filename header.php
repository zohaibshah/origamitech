<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- wp_head begin -->
    <?php wp_head(); ?>
    <!-- wp_head end -->
  </head>
  <body <?php body_class(); ?> >
    <?php wp_body_open(); ?>  
    
    <?php if(function_exists('lc_custom_header')) lc_custom_header(); else {
      
      //STANDARD NAV
      
      if (get_theme_mod("enable_topbar") ) : ?>
        <!-- ******************* The Topbar Area ******************* -->
        <div id="wrapper-topbar" class="py-2 <?php echo get_theme_mod('topbar_bg_color_choice','bg-light') ?> <?php echo get_theme_mod('topbar_text_color_choice','text-dark') ?>">
          <div class="container">
            <div class="row">
              <div id="topbar-content" class="col-md-12 text-left text-center text-md-left small"> <?php echo do_shortcode(get_theme_mod('topbar_content')) ?>  </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        

       <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- Uncomment below if you prefer to use an image logo -->
       <?php if ( ! has_custom_logo() ) { ?>

            <?php if ( is_front_page() && is_home() ) : ?>

              <div class="navbar-brand mb-0 h3"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></div>

            <?php else : ?>

              <a class="navbar-brand mb-0 h3" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

            <?php endif; ?>


          <?php } else {
            the_custom_logo();
          } ?>
        <?php 
          wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => '',
            'fallback_cb' => '__return_false',
            'items_wrap' => '<nav id="navbar" class="navbar"><ul>%3$s</ul><i class="bi bi-list mobile-nav-toggle"></i></nav>',
            'walker' => new bootstrap_5_wp_nav_menu_walker()
        ));
        ?>
        
    </div>
  </header>
  <!-- End Header -->

      
    <?php 
    } // END ELSE CASE 
    ?>

<main id='theme-main'>