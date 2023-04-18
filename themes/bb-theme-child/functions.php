<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );


// Classes
require_once 'classes/class-fl-child-theme.php';


// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );


// Add excerpt to Pages
add_post_type_support( 'page', 'excerpt' );

// Additional image sizes
add_image_size('x-medium', 600, 400, false);
function insert_custom_image_sizes($sizes) {
  global $_wp_additional_image_sizes;
  if (empty($_wp_additional_image_sizes)) {
    return $sizes;
  }
  foreach ($_wp_additional_image_sizes as $id => $data) {
    if (!isset($sizes[$id])) {
      $sizes[$id] = ucfirst(str_replace('-', ' ', $id));
    }
  }
  return $sizes;
}
add_filter('image_size_names_choose', 'insert_custom_image_sizes');


// Wistia Embed
add_action( 'init', function () {
    wp_oembed_add_provider( '/https?:\/\/(.+)?(wistia\.com|wi\.st)\/(medias|embed)\/.*/', 'http://fast.wistia.net/oembed', true );
});

//* TriMech Login Logo
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/trimech-logo.svg);
        }
    </style>
<?php }

//* Add custom login logo
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//* Custom WP Editor Style Sheet
function my_theme_add_editor_styles() {
    add_editor_style( 'wp-editor-style-v5.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );


// SVG Upload
function enable_svg_upload( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}

add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );


//* Add Taxonomy to pages
function add_taxonomies_to_pages() {
 register_taxonomy_for_object_type( 'post_tag', 'page' );
 register_taxonomy_for_object_type( 'category', 'page' );
 }
add_action( 'init', 'add_taxonomies_to_pages' );
 if ( ! is_admin() ) {
 add_action( 'pre_get_posts', 'category_and_tag_archives' );
 
 }
function category_and_tag_archives( $wp_query ) {
$my_post_array = array('post','page');
 
 if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
 $wp_query->set( 'post_type', $my_post_array );
 
 if ( $wp_query->get( 'tag' ) )
 $wp_query->set( 'post_type', $my_post_array );
}

// Add Google Fonts
function add_google_fonts() {
wp_enqueue_style( ' add_google_fonts ', ' https://fonts.googleapis.com/css2?family=Inter:wght@100;400;800;900&display=swap', false );}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// Filter to disable multiple Rank Math SEO Contest tests
add_filter('rank_math/researches/tests', function ($tests, $type) {
	unset(
		$tests['titleHasNumber'],
		$tests['contentHasTOC'],
		$tests['titleSentiment'],
        $tests['linksHasExternals'],
        $tests['linksNotAllExternals'],
        $tests['hasContentAI'],
        $tests['lengthPermalink'],
		$tests['titleHasPowerWords']
	);
	return $tests;
}, 10, 2);

//* Hide uncategorized posts from search
function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('cat','-1');
    }
    return $query;
}

add_filter('pre_get_posts','SearchFilter');


//* Hide uncategorized posts from site
function exclude_category($query) {
 if ( $query->is_home() ) {
 $query->set( 'cat', '-1' );
 }
 return $query;
 }
 add_filter( 'pre_get_posts', 'exclude_category' );
