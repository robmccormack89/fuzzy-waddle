<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package DC_Brochure_Theme
 */

// Define paths to Twig templates
Timber::$dirname = array(
  'views/',
  'views/custom-pages',
  'views/page-templates',
  'views/parts',
  'views/parts/sections',
);

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class DCBrochureTheme extends Timber\Site
{
  
    /** Add timber support. */
    public function __construct()
    {
        // timber stuff
        add_action('after_setup_theme', array( $this, 'theme_supports' ));
        add_action('wp_enqueue_scripts', array( $this, 'dc_brochure_theme_enqueue_assets'));
        add_action('widgets_init', array( $this, 'dc_brochure_custom_uikit_widgets_init'));
        add_filter('timber/context', array( $this, 'add_to_context' ));
        add_filter('timber/twig', array( $this, 'add_to_twig' ));
        add_action('init', array( $this, 'register_post_types' ));
        add_action('init', array( $this, 'register_taxonomies' ));
        add_action('init', array( $this, 'register_widget_areas' ));
        add_action('init', array( $this, 'register_navigation_menus' ));
        parent::__construct();
    }

    public function register_post_types()
    {
      
      
      // Register Custom Post Type
        $labels = array(
          'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
          'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
          'menu_name'             => __( 'Testimonials', 'text_domain' ),
          'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
          'archives'              => __( 'Item Archives', 'text_domain' ),
          'attributes'            => __( 'Item Attributes', 'text_domain' ),
          'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
          'all_items'             => __( 'All Items', 'text_domain' ),
          'add_new_item'          => __( 'Add New Item', 'text_domain' ),
          'add_new'               => __( 'Add New', 'text_domain' ),
          'new_item'              => __( 'New Item', 'text_domain' ),
          'edit_item'             => __( 'Edit Item', 'text_domain' ),
          'update_item'           => __( 'Update Item', 'text_domain' ),
          'view_item'             => __( 'View Item', 'text_domain' ),
          'view_items'            => __( 'View Items', 'text_domain' ),
          'search_items'          => __( 'Search Item', 'text_domain' ),
          'not_found'             => __( 'Not found', 'text_domain' ),
          'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
          'featured_image'        => __( 'Featured Image', 'text_domain' ),
          'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
          'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
          'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
          'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
          'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
          'items_list'            => __( 'Items list', 'text_domain' ),
          'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
          'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
          'label'                 => __( 'Testimonial', 'text_domain' ),
          'description'           => __( 'Customer Testimonials & Reviews', 'text_domain' ),
          'labels'                => $labels,
          'supports'              => array( 'title', 'editor', 'revisions' ),
          'hierarchical'          => false,
          'public'                => false,  // it's not public, it shouldn't have it's own permalink, and so on
          'publicly_queryable'    => true,  // you should be able to query it
          'show_ui'               => true,  // you should be able to edit it in wp-admin
          'exclude_from_search'   => true,  // you should exclude it from search results
          'show_in_nav_menus'     => false,  // you shouldn't be able to add it to menus
          'has_archive'           => false,  // it shouldn't have archive page
          'rewrite'               => false,  // it shouldn't have rewrite rules
          'capability_type'       => 'post',
        );
        register_post_type( 'testimonial', $args );
        
        
        
        // Register Custom Post Type
          $labels = array(
            'name'                  => _x( 'Brand Logos', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Brand Logo', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Brand Logos', 'text_domain' ),
            'name_admin_bar'        => __( 'Brand Logo', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'attributes'            => __( 'Item Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'All Items', 'text_domain' ),
            'add_new_item'          => __( 'Add New Item', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Item', 'text_domain' ),
            'edit_item'             => __( 'Edit Item', 'text_domain' ),
            'update_item'           => __( 'Update Item', 'text_domain' ),
            'view_item'             => __( 'View Item', 'text_domain' ),
            'view_items'            => __( 'View Items', 'text_domain' ),
            'search_items'          => __( 'Search Item', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
          );
          $args = array(
            'label'                 => __( 'Brand Logo', 'text_domain' ),
            'description'           => __( 'Logos of Brands we repair', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail', 'revisions' ),
            'hierarchical'          => false,
            'public'                => false,  // it's not public, it shouldn't have it's own permalink, and so on
            'publicly_queryable'    => true,  // you should be able to query it
            'show_ui'               => true,  // you should be able to edit it in wp-admin
            'exclude_from_search'   => true,  // you should exclude it from search results
            'show_in_nav_menus'     => false,  // you shouldn't be able to add it to menus
            'has_archive'           => false,  // it shouldn't have archive page
            'rewrite'               => false,  // it shouldn't have rewrite rules
            'capability_type'       => 'post',
          );
          register_post_type( 'brand-logo', $args );
          
          
          // Register Custom Post Type
            $labels = array(
              'name'                  => _x( 'Home Slides', 'Post Type General Name', 'text_domain' ),
              'singular_name'         => _x( 'Home Slide', 'Post Type Singular Name', 'text_domain' ),
              'menu_name'             => __( 'Home Slides', 'text_domain' ),
              'name_admin_bar'        => __( 'Home Slide', 'text_domain' ),
              'archives'              => __( 'Item Archives', 'text_domain' ),
              'attributes'            => __( 'Item Attributes', 'text_domain' ),
              'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
              'all_items'             => __( 'All Items', 'text_domain' ),
              'add_new_item'          => __( 'Add New Item', 'text_domain' ),
              'add_new'               => __( 'Add New', 'text_domain' ),
              'new_item'              => __( 'New Item', 'text_domain' ),
              'edit_item'             => __( 'Edit Item', 'text_domain' ),
              'update_item'           => __( 'Update Item', 'text_domain' ),
              'view_item'             => __( 'View Item', 'text_domain' ),
              'view_items'            => __( 'View Items', 'text_domain' ),
              'search_items'          => __( 'Search Item', 'text_domain' ),
              'not_found'             => __( 'Not found', 'text_domain' ),
              'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
              'featured_image'        => __( 'Featured Image', 'text_domain' ),
              'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
              'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
              'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
              'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
              'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
              'items_list'            => __( 'Items list', 'text_domain' ),
              'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
              'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
            );
            $args = array(
              'label'                 => __( 'Home Slide', 'text_domain' ),
              'description'           => __( 'Homepage Slides', 'text_domain' ),
              'labels'                => $labels,
              'show_in_rest'          => true,
              'supports'              => array( 'title', 'thumbnail', 'editor', 'revisions' ),
              'hierarchical'          => false,
              'public'                => false,  // it's not public, it shouldn't have it's own permalink, and so on
              'publicly_queryable'    => true,  // you should be able to query it
              'show_ui'               => true,  // you should be able to edit it in wp-admin
              'exclude_from_search'   => true,  // you should exclude it from search results
              'show_in_nav_menus'     => false,  // you shouldn't be able to add it to menus
              'has_archive'           => false,  // it shouldn't have archive page
              'rewrite'               => false,  // it shouldn't have rewrite rules
              'capability_type'       => 'post',
            );
            register_post_type( 'home-slide', $args );
            
            // Register Custom Post Type
              $labels = array(
                'name'                  => _x( 'Home About Tabs', 'Post Type General Name', 'text_domain' ),
                'singular_name'         => _x( 'Home About Tab', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'             => __( 'Home About Tabs', 'text_domain' ),
                'name_admin_bar'        => __( 'Home About Tab', 'text_domain' ),
                'archives'              => __( 'Item Archives', 'text_domain' ),
                'attributes'            => __( 'Item Attributes', 'text_domain' ),
                'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
                'all_items'             => __( 'All Items', 'text_domain' ),
                'add_new_item'          => __( 'Add New Item', 'text_domain' ),
                'add_new'               => __( 'Add New', 'text_domain' ),
                'new_item'              => __( 'New Item', 'text_domain' ),
                'edit_item'             => __( 'Edit Item', 'text_domain' ),
                'update_item'           => __( 'Update Item', 'text_domain' ),
                'view_item'             => __( 'View Item', 'text_domain' ),
                'view_items'            => __( 'View Items', 'text_domain' ),
                'search_items'          => __( 'Search Item', 'text_domain' ),
                'not_found'             => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
                'featured_image'        => __( 'Featured Image', 'text_domain' ),
                'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
                'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
                'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
                'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
                'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
                'items_list'            => __( 'Items list', 'text_domain' ),
                'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
                'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
              );
              $args = array(
                'label'                 => __( 'Home About Tab', 'text_domain' ),
                'description'           => __( 'Home About section Tabbed Content', 'text_domain' ),
                'labels'                => $labels,
                'show_in_rest'          => true,
                'supports'              => array( 'title', 'thumbnail', 'editor', 'revisions' ),
                'hierarchical'          => false,
                'public'                => false,  // it's not public, it shouldn't have it's own permalink, and so on
                'publicly_queryable'    => true,  // you should be able to query it
                'show_ui'               => true,  // you should be able to edit it in wp-admin
                'exclude_from_search'   => true,  // you should exclude it from search results
                'show_in_nav_menus'     => false,  // you shouldn't be able to add it to menus
                'has_archive'           => false,  // it shouldn't have archive page
                'rewrite'               => false,  // it shouldn't have rewrite rules
                'capability_type'       => 'post',
              );
              register_post_type( 'home-about-tab', $args );
          
          
          
          $labels = array(
        		'name'                  => _x( 'Services', 'Post Type General Name', 'text_domain' ),
        		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
        		'menu_name'             => __( 'Services', 'text_domain' ),
        		'name_admin_bar'        => __( 'Service', 'text_domain' ),
        		'archives'              => __( 'Services', 'text_domain' ),
        		'attributes'            => __( 'Item Attributes', 'text_domain' ),
        		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        		'all_items'             => __( 'All Items', 'text_domain' ),
        		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        		'add_new'               => __( 'Add New', 'text_domain' ),
        		'new_item'              => __( 'New Item', 'text_domain' ),
        		'edit_item'             => __( 'Edit Item', 'text_domain' ),
        		'update_item'           => __( 'Update Item', 'text_domain' ),
        		'view_item'             => __( 'View Item', 'text_domain' ),
        		'view_items'            => __( 'View Items', 'text_domain' ),
        		'search_items'          => __( 'Search Item', 'text_domain' ),
        		'not_found'             => __( 'Not found', 'text_domain' ),
        		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        		'featured_image'        => __( 'Featured Image', 'text_domain' ),
        		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        		'items_list'            => __( 'Items list', 'text_domain' ),
        		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        	);
        	$args = array(
        		'label'                 => __( 'Service', 'text_domain' ),
        		'description'           => __( 'The Services we offer', 'text_domain' ),
        		'labels'                => $labels,
            'show_in_rest'          => true,
        		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        		'hierarchical'          => false,
            'rewrite'               => array('slug' => 'services-repairs/%service-type%'),
        		'public'                => true,
        		'show_ui'               => true,
        		'show_in_menu'          => true,
        		'menu_position'         => 5,
        		'show_in_admin_bar'     => true,
        		'show_in_nav_menus'     => true,
        		'can_export'            => true,
        		'exclude_from_search'   => false,
        		'publicly_queryable'    => true,
            'has_archive'           => 'services-repairs',
        		'capability_type'       => 'page',
        	);
        	register_post_type( 'services-repairs', $args );     
      
      
    }

    public function register_taxonomies()
    {

      $labels = array(
        'name'                       => _x( 'Service Type', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Service Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Service Types', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
      );
      $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
      );
      register_taxonomy( 'service-type', array( 'services-repairs'), $args );

    }

    public function register_widget_areas()
    {
        // Register widget areas
        if (function_exists('register_sidebar')) {
            register_sidebar(array(
                'name' => esc_html__('Main Sidebar Area', 'dc-brochure-theme'),
                'id' => 'sidebar-main',
                'description' => esc_html__('Sidebar Area for Right Sidebar Templates, you can add multiple widgets here.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h6 class="uk-text-primary uk-text-uppercase uk-margin-small-bottom">',
                'after_title' => '</h6>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area', 'dc-brochure-theme'),
                'id' => 'sidebar-footer',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<div hidden>',
                'after_title' => '</div>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Area 1', 'dc-brochure-theme'),
                'id' => 'sidebar-footer-1',
                'description' => esc_html__('Footer Widget Area 1; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h5 class="widget-title uk-text-uppercase">',
                'after_title' => '</h5>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Area 2', 'dc-brochure-theme'),
                'id' => 'sidebar-footer-2',
                'description' => esc_html__('Footer Widget Area 2; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h5 class="widget-title uk-text-uppercase">',
                'after_title' => '</h5>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Area 3', 'dc-brochure-theme'),
                'id' => 'sidebar-footer-3',
                'description' => esc_html__('Footer Widget Area 3; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h5 class="widget-title uk-text-uppercase">',
                'after_title' => '</h5>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Area 4', 'dc-brochure-theme'),
                'id' => 'sidebar-footer-4',
                'description' => esc_html__('Footer Widget Area 4; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h5 class="widget-title uk-text-uppercase">',
                'after_title' => '</h5>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Topbar Widget Area', 'dc-brochure-theme'),
                'id' => 'sidebar-topbar',
                'description' => esc_html__('Topbar Widget Area; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<div hidden>',
                'after_title' => '</div>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Header Button Area', 'dc-brochure-theme'),
                'id' => 'sidebar-header-button',
                'description' => esc_html__('Header Button Area; works best with the current widget only.', 'dc-brochure-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<div hidden>',
                'after_title' => '</div>'
            ));
        }
    }

    public function register_navigation_menus()
    {
        // This theme uses wp_nav_menu() in one locations.
        register_nav_menus(array(
            'main' => __('Main Menu', 'dc-brochure-theme'),
            'mobile' => __('Mobile Menu', 'dc-brochure-theme'),
        ));
    }

    public function add_to_context($context)
    {
        // optional args for Timber/Menu below. see options https://timber.github.io/docs/guides/menus/
        $main_menu_args = array(
          'depth' => 3,
        );
        // Initializing our menus
        $context['menu_main'] = new Timber\Menu('main');
        $context['menu_mobile'] = new Timber\Menu('mobile');
      
        // check for whether a menu exists
        $context['has_menu_main'] = has_nav_menu('main');
        $context['has_menu_mobile'] = has_nav_menu('mobile');
      
        //add the site data to the context globally
        $context['site'] = $this;
      
        // check if archive is paginated, see theme-functions.php
        $context['is_paginated'] = is_paginated();
      
        // get the current year, see theme-functions.php
        $context['current_year'] =  currentYear();
       
        // get the theme logo id
        $theme_logo_id = get_theme_mod('custom_logo');
        // get the theme logo url via the theme logo id
        $theme_logo_url = wp_get_attachment_image_url($theme_logo_id, 'full');
        // add theme logo url to the context
        $context['theme_logo_url'] = $theme_logo_url;
      
        // add sidebars to them context
        $context['sidebar'] = Timber::get_widgets('Main Sidebar Area');
        
        $context['sidebar_footer'] = Timber::get_widgets('Main Footer Area');
        $context['sidebar_footer_1'] = Timber::get_widgets('Footer Widget Area 1');
        $context['sidebar_footer_2'] = Timber::get_widgets('Footer Widget Area 2');
        $context['sidebar_footer_3'] = Timber::get_widgets('Footer Widget Area 3');
        $context['sidebar_footer_4'] = Timber::get_widgets('Footer Widget Area 4');
        
        $context['topbar_widget_area'] = Timber::get_widgets('Topbar Widget Area');
        
        $context['sidebar_header_button'] = Timber::get_widgets('Header Button Area');
        
        $context['site_default_img'] = '/wp-content/uploads/2020/08/dc-appliances-image-5-1920.jpg';
        
        // checks for: if is left sidebar template, if is right sidebar templates. theme-functions.php
        $context['is_left_sidebar'] = is_left_sidebar_template();
        $context['is_right_sidebar'] = is_right_sidebar_template();
        
        $context['template_section_class'] = template_section_class();
        $context['template_width_class'] = template_width_class();
        $context['article_width_class'] = article_width_class();

        $context['is_services_page'] = is_services_page();
        
        
        $logo_posts_args = array(
         'post_type' => 'brand-logo',
         'orderby' => 'title',
         'order'   => 'ASC',
        );
        $context['logo_posts'] = new Timber\PostQuery( $logo_posts_args );
        
        $testimonial_posts_args = array(
         'post_type' => 'testimonial',
         'orderby' => 'title',
         'order'   => 'ASC',
        );
        $context['testimonial_posts'] = new Timber\PostQuery( $testimonial_posts_args );
        
        $home_slide_posts_args = array(
         'post_type' => 'home-slide',
         'orderby' => 'title',
         'order'   => 'ASC',
        );
        $context['home_slides'] = new Timber\PostQuery( $home_slide_posts_args );
        
        $home_about_tabs_posts_args = array(
         'post_type' => 'home-about-tab',
        );
        $context['home_about_tabs'] = new Timber\PostQuery( $home_about_tabs_posts_args );
        
        $services_posts_args = array(
         'post_type' => 'services-repairs',
        );
        $context['services_posts'] = new Timber\PostQuery( $services_posts_args );
        

        return $context;
    }
    
    public function theme_supports()
    {

      // theme support for title tag
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support('post-formats', array(
          'gallery',
          'quote',
          'video',
          'aside',
          'image',
          'link'
        ));
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('woocommerce');

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', array(
          'search-form',
          'comment-form',
          'comment-list',
          'gallery',
          'caption'
        ));

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
          'height' => 30,
          'width' => 261,
          'flex-width' => true,
          'flex-height' => true
        ));

        // add custom thumbs sizes.
        add_image_size('dc-brochure-theme-hero', 1920, 750, true);
        add_image_size('dc-brochure-theme-service-featured', 300, 360, true);
        add_image_size('dc-brochure-theme-featured-image-archive', 800, 300, true);
        add_image_size('dc-brochure-theme-post-slider-image', 600, 600, true);
        
        load_theme_textdomain( 'dc-brochure-wp-theme', get_template_directory() . '/languages' );
    }
    
    public function dc_brochure_theme_enqueue_assets()
    {
        wp_enqueue_style('dc-brochure-theme-css', get_template_directory_uri() . '/assets/css/base.css');
        wp_enqueue_script('dc-brochure-theme-js', get_template_directory_uri() . '/assets/js/main/main.js', '', '', false);
        wp_enqueue_style('dc-brochure-theme-styles', get_stylesheet_uri());
    }
    
    public function dc_brochure_custom_uikit_widgets_init()
    {
        register_widget("DC_Brochure_Theme_Custom_UIKIT_Widget_Class");
    }

    public function add_to_twig($twig)
    {
        /* this is where you can add your own functions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());

        return $twig;
    }
}

new DCBrochureTheme();
