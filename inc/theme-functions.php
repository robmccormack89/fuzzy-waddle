<?php
/**
 * Theme functions & bits
 *
 * @package DC_Brochure_Theme
 */
 
//
function add_tax_base_to_service_permalinks( $post_link, $id = 0 ){
   $post = get_post($id);  
   if ( is_object( $post ) ){
       $terms = wp_get_object_terms( $post->ID, 'service-type' );
       if( $terms ){
           return str_replace( '%service-type%' , $terms[0]->slug , $post_link );
       }
   }
   return $post_link;  
}
add_filter( 'post_type_link', 'add_tax_base_to_service_permalinks', 1, 3 );

// get the current year, this is passed onto twig as a global variable in timber-functions.php
function currentYear()
{
    return date('Y');
}

// check for if the archive is paginated, for use in templates to conditionally display the pagi block
function is_paginated()
{
    global $wp_query;
    if ($wp_query->max_num_pages > 1) {
        return true;
    } else {
        return false;
    }
}

// 
function is_left_sidebar_template()
{
  if (is_page_template('page-templates/left-sidebar-template.php')) {
    return true;
  } else {
    return false;
  };
}

// 
function is_right_sidebar_template()
{
  if ( is_page_template( 'page-templates/right-sidebar-template.php' ) || is_page( array( 'air-conditioning', 'beer-cooling-systems', 'catering-equipment', 'cold-freezer-rooms', 'dishwashers', 'fridges-freezers', 'ovens', 'washing-machines' ) ) || is_singular('services-repairs') ) {
    return true;
  } else {
    return false;
  };
}

// 
function template_section_class()
{
  if (is_page_template('page-templates/full-width-template.php')) {
      return 'no-section-class';
  } elseif (is_page_template('page-templates/container-width-template.php')) {
      return 'uk-section uk-section-large uk-section-default';
  } else {
      return 'uk-section uk-section-default';
  };
}

// 
function template_width_class()
{
  if (is_page_template(array( 'page-templates/left-sidebar-template.php', 'page-templates/right-sidebar-template.php' )) || is_singular('services-repairs')) {
      return 'uk-container uk-container-small';
  } elseif (is_page_template('page-templates/container-width-template.php')) {
      return 'uk-container';
  } elseif (is_page_template('page-templates/full-width-template.php')) {
      return 'no-container';
  } else {
      return 'uk-container uk-container-xsmall';
  }
}

// 
function article_width_class()
{
  if (is_page_template(array( 'page-templates/left-sidebar-template.php', 'page-templates/right-sidebar-template.php' )) || is_singular('services-repairs')) {
      return 'uk-width-2-3@m';
  } else {
      return 'uk-width-1-1';
  };
}

function is_services_page()
{
  if (is_page( array( 'air-conditioning', 'beer-cooling-systems', 'catering-equipment', 'cold-freezer-rooms', 'dishwashers', 'fridges-freezers', 'ovens', 'washing-machines' ))) {
    return true;
  } else {
    return false;
  };
}

// stuff to say we need timber activated!! see TGM Plugin activation library
function dc_brochure_theme_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'Timber',
            'slug' => 'timber-library',
            'required' => true
        )
    );
    $config  = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '' // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'dc_brochure_theme_register_required_plugins');
