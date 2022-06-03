<?php
/**
 * Main class for the WordPress Theme
 */
class Longpoint {

  /**
   * Name of the directory where the theme files resides
   * @var string
   * @since 1.0
   */
  private $theme_name = "Longpoint";
  private $scripts_version = '0.90';

  function __construct() {
    add_action('init', array($this, 'init_assets'));
    add_action('init', array($this, 'init_custom_taxonomies'));
    add_action('init', array($this, 'init_custom_post_types'));
    add_action('init', array($this, 'init_custom_user_roles'));
    add_action('admin_init', array($this, 'restrict_dashboard'));
    add_action('login_form_middle', array($this, 'add_lost_password_link'));
    add_action('wp_login_failed', array($this, 'front_end_login_fail'));
    // add_action( 'gform_after_submission', array($this, 'set_gform_custom_fields'));

    add_theme_support('post-thumbnails');
    add_image_size('Page BG Photo',1200, 900, false);
    add_image_size('Profile Photo',362, 240, false);
    add_image_size('Card Photo',325, 168, false);

    add_filter('mce_buttons_2', 'my_mce_buttons_2');

    add_filter('excerpt_more', array($this, 'new_excerpt_more'));
    add_filter( 'excerpt_length', array($this, 'custom_excerpt_length'), 999 );

    // custom menu support
    add_theme_support('nav-menus');
    if (function_exists('register_nav_menus')) {
      register_nav_menus(
        array(
          'main-menu' => 'Main Menu',
          'upper-menu' => 'Upper Menu',
          'footer-menu' => 'Footer Menu'
        )
      );
    }

    // Add an options page for global options using ACF
    if( function_exists('acf_add_options_page') ) {
      acf_add_options_page();
    }
  }

  function is_logged_in_investor() {
    $current_user = wp_get_current_user();
    if(!$current_user) return false;
    foreach($current_user->roles as $role) {
      if(
        $role === 'investor_1'
        || $role === 'investor_2'
        || $role === 'investor_3'
        || $role === 'investor_1_2'
        || $role === 'investor_1_3'
        || $role === 'investor_2_3'
        || $role === 'investor_1_2_3'
      ) {
        return true;
      }
    }
    return false;
  }

  function the_user_display_name() {
    $current_user = wp_get_current_user();
    if($current_user) {
      echo $current_user->display_name;
    }
  }

  function is_in_investor_roles($roles_to_check) {
    $current_user = wp_get_current_user();
    if(!$current_user) return false;
    foreach($current_user->roles as $role) {
      foreach($roles_to_check as $role_to_check) {
        switch ($role_to_check) {
        case "investor_1":
          if (
            $role === "investor_1"
            || $role === "investor_1_2"
            || $role === "investor_1_3"
            || $role === "investor_1_2_3"
          ) { return true; }
          break;
        case "investor_2":
          if (
            $role === "investor_2"
            || $role === "investor_1_2"
            || $role === "investor_2_3"
            || $role === "investor_1_2_3"
          ) { return true; }
          break;
        case "investor_3":
          if (
            $role === "investor_3"
            || $role === "investor_1_3"
            || $role === "investor_2_3"
            || $role === "investor_1_2_3"
          ) { return true; }
          break;
        }
      }
    }
    return false;
  }

  function is_in_role($role_to_check) {
    $current_user = wp_get_current_user();
    if(!$current_user) return false;
    foreach($current_user->roles as $role) {
      if($role === $role_to_check) {
        return true;
      }
    }
    return false;
  }

  function restrict_dashboard() {
    // die("restrict dashboard");
    if ( ! defined( 'DOING_AJAX' ) && ! current_user_can( 'manage_options' ) ) {
      wp_redirect( "/" ); //add this url here to where someone logged in on the front end
    }
  }

  function add_lost_password_link() {
    return '<p><a href="/wp-login.php?action=lostpassword">Forgot Password?</a></p>';
  }

  function front_end_login_fail( $username, $password_empty = 'false', $username_empty = 'false' ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    $login_type = 'admin';
    if(array_key_exists('login_type', $_REQUEST)) {
      $login_type = $_REQUEST['login_type'];
    }

     // if there's a valid referrer, and it's not the default log-in screen
     if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {

      $pos = strpos($referrer, '?login=failed');
      if($pos === false) {
         // add the failed
         // wp_redirect( $referrer . '?login=failed&pwblank='.$password_empty.'&ublank='.$username_empty );  // let's append some information (login=failed) to the URL for the theme to use
         wp_redirect( $referrer . '?login=failed&login_type='.$login_type);  // let's append some information (login=failed) to the URL for the theme to use
      }
      else {
        // already has the failed don't appened it again
        // wp_redirect( $referrer . '&pwblank='.$password_empty.'&ublank='.$username_empty );  // already appeneded redirect back
        wp_redirect( $referrer );  // already appeneded redirect back
      }

        exit;
     }
  }

  //This forces the login fail function if the username or password is empty
  function check_login_field_empty( $user, $username, $password ) {
      if ( empty( $username ) || empty( $password ) ) {
        $username_empty = empty( $username );
        $password_empty = empty( $password );
          do_action( 'wp_login_failed', $user, $password_empty, $username_empty );
      }
      return $user;
  }

  function images_path() {
    echo get_bloginfo('template_url') . '/assets/images';
  }

  function register_nav_menus() {
    // custom menu support
    add_theme_support('menus');
    if (function_exists('register_nav_menus')) {
      register_nav_menus(
        array(
          'main-menu' => 'Main Menu',
        )
      );
    }
  }

  /**
   * Enqueues scripts and styles for this theme.
   * This function will be run on initialization.
   * @return void
   * @since 1.0
   */
  function init_assets() {
    if (!is_admin() & !is_login_page()) {
      // STYLES
      wp_enqueue_style($this->theme_name . '-styles', get_bloginfo('stylesheet_directory') . '/assets/build/css/main.css', false, $this->scripts_version, 'all');
      wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Oswald:300,400|Source+Sans+Pro:400,700,900', false, '1.0', 'all');
      // SCRIPTS
      wp_deregister_script('jquery');
      wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js", false, null, true);
      /* wp_enqueue_script('fontawesome', "http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css", false); */
      wp_enqueue_script('jquery');
      wp_enqueue_script('libs', get_bloginfo('stylesheet_directory') . '/assets/javascripts/libs.js', array('jquery'), $this->scripts_version, true);
      wp_enqueue_script($this->theme_name . '-site', get_bloginfo('stylesheet_directory') . '/assets/build/js/main.min.js', array('jquery', 'libs'), $this->scripts_version, true);
      //wp_enqueue_script($this->theme_name . '-site', get_bloginfo('stylesheet_directory') . '/assets/javascripts/main.js', array('jquery', 'libs'), $this->scripts_version, true);
    }
    if(is_login_page()) {
      wp_enqueue_style($this->theme_name . '-styles', get_bloginfo('stylesheet_directory') . '/assets/build/css/login.css', false, $this->scripts_version, 'all');
    }
  }

  /**
   * Initialize custom post types.
   */
  function init_custom_post_types() {
    // Team
    $labels = array(
      'name' => 'Profile',
      'singular_name' => 'Profile',
      'add_new' => 'Add New Profile',
      'add_new_item' => 'Add Profile',
      'edit_item' => 'Edit Profile',
      'new_item' => 'New Profile',
      'all_items' => 'All Profiles',
      'view_item' => 'View Profiles',
      'search_items' => 'Search Profiles',
      'not_found' =>  'No profiles found',
      'not_found_in_trash' => 'No profiles found in Trash',
      'menu_name' => 'Team'
    );
    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'team'),
      'capability_type' => 'post',
      'has_archive' => false,
      'hierarchical' => false,
      'menu_position' => 3,
      'exclude_from_search' => true,
      'supports' => array('title','editor','author')
    );
    register_post_type('team', $args);

    //Longpoint Features
    $labels = array(
      'name' => 'Feature',
      'singular_name' => 'Feature',
      'add_new' => 'Add New Feature',
      'add_new_item' => 'Add Feature',
      'edit_item' => 'Edit Feature',
      'new_item' => 'New Feature',
      'all_items' => 'All Features',
      'view_item' => 'View Feature',
      'search_items' => 'Search Features',
      'not_found' =>  'No features found',
      'not_found_in_trash' => 'No features found in Trash',
      'menu_name' => 'Features'
    );
    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'features'),
      'capability_type' => 'post',
      'has_archive' => false,
      'hierarchical' => false,
      'exclude_from_search' => false,
      'menu_position' => 3,
      'taxonomies' => array( 'feature_category' ),
    );
    register_post_type('longpoint-feature', $args);
  }

  /**
   * Initialize custom taxonomies.
   */
  function init_custom_taxonomies() {

    /** Feature Category **/
    $labels = array(
    'name' => __( 'Feature Category', 'feature_categories' ),
    'singular_name' => __( 'Feature Category', 'feature_category' ),
    'search_items' =>  __( 'Search Feature Categories' ),
    'all_items' => __( 'All Feature Categories' ),
    'edit_item' => __( 'Edit Feature Categories' ),
    'update_item' => __( 'Update Feature Category' ),
    'add_new_item' => __( 'Add New Feature Category' ),
    'new_item_name' => __( 'New Feature Category' ),
    'menu_name' => __( 'Feature Categories' ),
    );
    $args = array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'feature-categories'),
    );
    register_taxonomy('feature_category', array('longpoint-feature'), $args);
  }

  /**
  * Initialize custom roles
  **/
  function init_custom_user_roles() {
    // remove_role( 'investor' );
    remove_role( 'contributor' );
    remove_role( 'author' );
    remove_role( 'editor' );
    remove_role( 'subscriber' );

    $role_authorizations = array(
      'administrator' => false,
      'read'         => true,  // true allows this capability
      'edit_posts'   => false,
      'delete_posts' => false, // Use false to explicitly deny
      'delete_others_posts' => false,
      'delete_others_pages' => false,
      'edit_others_posts' => false,
      'edit_others_pages' => false,
      'manage_categories' => false,
      'moderate_comments' => false,
      'publish_posts' => true,
      'publish_pages' => false,
      'upload_files' => true,
      'update_core' => false,
      'update_plugins' => false,
      'update_themes' => false,
      'install_plugins' => false,
      'install_themes' => false,
      'delete_themes' => false,
      'delete_plugins' => false,
      'edit_plugins' => false,
      'edit_themes' => false,
      'edit_files' => false,
      'edit_users' => false,
      'create_users' => false,
      'delete_users' => false,
      'activate_plugins' => false,
      'delete_pages' => false,
    );

    $result = add_role(
        'investor_1_2_3',
        __( 'Investor Level 1, 2 and 3' ),
        $role_authorizations
    );

    $result = add_role(
        'investor_2_3',
        __( 'Investor Level 2 and 3' ),
        $role_authorizations
    );

    $result = add_role(
        'investor_1_3',
        __( 'Investor Level 1 and 3' ),
        $role_authorizations
    );

    $result = add_role(
        'investor_1_2',
        __( 'Investor Level 1 and 2' ),
        $role_authorizations
    );

    $result = add_role(
        'investor_3',
        __( 'Investor Level 3' ),
        $role_authorizations
    );

    $result = add_role(
        'investor_2',
        __( 'Investor Level 2' ),
        $role_authorizations
    );

    $result = add_role(
        'investor_1',
        __( 'Investor Level 1' ),
        $role_authorizations
    );
  }
  /**
   * Get attached image by post ID or image ID and echo an img tag with src, alt and class attributes.
   * @param number   $post_id   Post ID of the post the featured image is attached to.
   * @param number   $img_ID   Used when the image is not attached to a post, but the ID is known.
   * @param array   $classes   An array of classes to add to the image tag.
   * @param string   $size     Size of the image to grab. Defaults to 'full'.
   */
  function echo_attached_image($post_id = null, $img_ID = null, $classes = null, $size = 'full') {
    if ($img_ID === null) {
      $img_ID = get_post_thumbnail_id($post_id);
    }
    $img_src = wp_get_attachment_image_src($img_ID, $size);
    if ($img_src && $img_src != '') {
      $img_alt = get_post_meta($img_ID, '_wp_attachment_image_alt', true);
      $img_tag = '<img src="' . $img_src[0] . '" alt="' . $img_alt . '"';
      if ($classes) {
        $img_tag .= ' class="';
        foreach ($classes as $class) {
          $img_tag .= $class . ' ';
        }
        $img_tag .= '" ';
      }
      $img_tag .= '>';
      echo $img_tag;
    } else {
      echo '';
    }
  }

  function get_attached_image($post_id = null, $img_ID = null, $classes = null, $size = 'full') {
    if ($img_ID === null) {
      $img_ID = get_post_thumbnail_id($post_id);
    }
    $img_src = wp_get_attachment_image_src($img_ID, $size);
    if ($img_src && $img_src != '') {
      $img_alt = get_post_meta($img_ID, '_wp_attachment_image_alt', true);
      $img_tag = '<img src="' . $img_src[0] . '" alt="' . $img_alt . '"';
      if ($classes) {
        $img_tag .= ' class="';
        foreach ($classes as $class) {
          $img_tag .= $class . ' ';
        }
        $img_tag .= '" ';
      }
      $img_tag .= '>';
      return $img_tag;
    } else {
      return '';
    }
  }

  function has_attached_image($post_id = null, $img_ID = null) {
    if ($img_ID === null) {
      $img_ID = get_post_thumbnail_id($post_id);
    }
    $returnval = false;
    if($img_ID && $img_ID > 0) {
      $returnval = true;
    }
    return $returnval;
  }

  function get_attached_image_url($post_id = null, $img_ID = null, $classes = null, $size = 'full') {
    if ($img_ID === null) {
      $img_ID = get_post_thumbnail_id($post_id);
    }
    $img_src = wp_get_attachment_image_src($img_ID, $size);
    if ($img_src && $img_src != '') {
      return $img_src[0];
    } else {
      return '';
    }
  }

  function echo_attached_image_url($post_id = null, $img_ID = null, $classes = null, $size = 'full') {
    if ($img_ID === null) {
      $img_ID = get_post_thumbnail_id($post_id);
    }
    $img_src = wp_get_attachment_image_src($img_ID, $size);
    if ($img_src && $img_src != '') {
      echo $img_src[0];
    }
  }

  function echo_links_from_title($str) {
    $return_val = str_replace(" ", "-", strtolower($str));
    $return_val = str_replace('’', '', $return_val);
    echo ($return_val);
  }

  // Removes Trackbacks from the comment cout
  function comment_count($count) {
    if (!is_admin()) {
      global $id;
      $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
      return count($comments_by_type['comment']);
    } else {
      return $count;
    }
  }

  // custom excerpt ellipses for 2.9+
  function custom_excerpt_more($more) {
    return 'READ MORE &raquo;';
  }

  // no more jumping for read more link
  function no_more_jumping($post) {
    return '<a href="' . get_permalink($post->ID) . '" class="read-more">' . '&nbsp; Continue Reading &raquo;' . '</a>';
  }

  // category id in body and post class
  function category_id_class($classes) {
    global $post;
    foreach ((get_the_category($post->ID)) as $category) {
      $classes[] = 'cat-' . $category->cat_ID . '-id';
    }

    return $classes;
  }

  // adds a class to the post if there is a thumbnail
  function has_thumb_class($classes) {
    global $post;
    if (has_post_thumbnail($post->ID)) {$classes[] = 'has_thumb';}
    return $classes;
  }

  function security_measures() {
    // removes detailed login error information for security
    add_filter('login_errors', create_function('$a', "return null;"));
    // removes the WordPress version from your header for security
    add_filter('the_generator', create_function('$a', "return '';"));
  }

  function get_excerpt_by_id($post_id){
      $the_post = get_post($post_id); //Gets post ID
      $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
      $excerpt_length = 55; //Sets excerpt length by word count
      $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images

      if(strlen($the_excerpt) > $excerpt_length) {
        $the_excerpt = trim(substr($the_excerpt,0,$excerpt_length)).'…';
      }

      $the_excerpt = '<p>' . $the_excerpt . '</p>';

      return $the_excerpt;
  }

  /**
   * Auto login after registration.
   */
  function pi_gravity_registration_autologin( $user_id, $user_config, $entry, $password ) {
    $user = get_userdata( $user_id );
    $user_login = $user->user_login;
    $user_password = $password;

      wp_signon( array(
      'user_login' => $user_login,
      'user_password' =>  $user_password,
      'remember' => false
      ) );
  }

  function new_excerpt_more($more) {
    return '...';
  }

  function custom_excerpt_length( $length ) {
    return 20;
  }
}

$lp_theme = new Longpoint();

function register_editor_style() {
  add_editor_style('editor-styles.css');
}

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}

function is_login_page() {
  return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

show_admin_bar(false);

// disable random password
add_filter( 'random_password', 'disable_random_password', 10, 2 );

function disable_random_password( $password ) {
    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';
    if ( 'wp-login.php' === $GLOBALS['pagenow'] && ( 'rp' == $action  || 'resetpass' == $action ) ) {
        return '';
    }
    return $password;
}

/* Set a custom order for the longpoint features archive */
function wp_order_category( $query ) {
  // exit out if it's the admin or it isn't the main query
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }
  if( is_search() ) {
    $query->set( 'numberposts', '100' );
    $query->set( 'posts_per_page', '100' );
  }
  // order category archives by title in ascending order
  if($query->query && array_key_exists('post_type',$query->query) && $query->query['post_type'] === 'longpoint-feature') {
    $query->set( 'meta_key' , 'feature_date' );
    $query->set( 'order' , 'desc' );
    $query->set( 'orderby' , 'meta_value_num' );
    if(get_query_var('filter')) {
      $filter = get_query_var('filter');
      $tax_query = array(
        array(
          'taxonomy' => 'feature_category',
          'field' => 'slug',
          'terms' => $filter
        )
      );
      if($filter && $filter != '') {
        // var_dump($tax_query);
        // die($filter);
        $query->set( 'tax_query' , $tax_query );
      }
    }
    return;
  }
}
add_action( 'pre_get_posts', 'wp_order_category', 1 );

function custom_query_vars_filter($vars) {
    $vars[] = 'filter';
    return $vars;
}

add_filter('query_vars', 'custom_query_vars_filter');

/* Customize Login Message */
function custom_login_message( $message ) {
    if ( empty($message) ){
        return "<p><strong>You need to be logged in to view this page. Please login to continue</strong></p>";
    } else {
        return $message;
    }
}

add_filter( 'login_message', 'custom_login_message' );

/* Redirect all longpoint features to main features page */
add_action( 'template_redirect', 'redirect_post_type_features' );
function redirect_post_type_features(){
    if ( ! is_singular( 'longpoint-feature' ) )
        return;
    wp_redirect( get_page_link( 7 ), 301 );
    exit;
}

/* Redirect all longpoint team to about us page */
add_action( 'template_redirect', 'redirect_post_type_team' );
function redirect_post_type_team(){
    if ( ! is_singular( 'team' ) )
        return;
    wp_redirect( get_page_link( 9 ), 301 );
    exit;
}

// Return error if email is not set for password retrieval
add_action( 'lostpassword_post', 'email_only_lostpassword_post', 10, 1 );
function email_only_lostpassword_post( $errors ){
  if( !is_email($_POST['user_login']) ){
    $errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid email address.'));
    return $errors;
  }
}

// Translate some login page text
add_filter( 'gettext', 'email_only_login_labels', 20, 3 );
function email_only_login_labels( $translated_text, $text, $domain ) {
  if (in_array( $GLOBALS['pagenow'], array( 'wp-login.php' ) )) {
    if ($translated_text === 'Username or Email Address') {
      $translated_text = 'Email Address';
    }
    if ($translated_text === 'Please enter your username or email address. You will receive a link to create a new password via email.') {
      $translated_text = 'Please enter your email address. You will receive a link to create a new password via email.';
    }

  }
  return $translated_text;
}


/* ==================================================================
         Filter Gravity Forms Submissions for spammy words
================================================================== */
/*
 * Use an array to search a string
 * Allows us to pass the stop words list and our post data
 */
function strpos_arr($haystack, $needle) {
    if (!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
      if ( ($pos = stripos($haystack, $what)) !== false ) {
        return $pos;
      }
    }
    return false;
}

/* -------------------------------------------------------------------------------------- */

add_action('gform_pre_submission', 'keywords_check');
// The form ID is currently set to ID 1 - shown in the above line gform_pre_submission_1.
// If you want to apply it to form ID 2 then change _1 it to _2

function keywords_check($form){
// function keywords_check($validation_result){
  // $form = $validation_result["form"];

  //  -------> Enter all the keywords that you want to block. <------------  */
  $stop_words = array(
    'acrotomophilia',
    'alabama hot pocket',
    'alaskan pipeline',
    'anal',
    'anilingus',
    'anus',
    'apeshit',
    'arsehole',
    'ass',
    'asshole',
    'assmunch',
    'auto erotic',
    'autoerotic',
    'babeland',
    'baby batter',
    'baby juice',
    'ball gag',
    'ball gravy',
    'ball kicking',
    'ball licking',
    'ball sack',
    'ball sucking',
    'bangbros',
    'bareback',
    'barely legal',
    'barenaked',
    'bastard',
    'bastardo',
    'bastinado',
    'bbw',
    'bdsm',
    'beaner',
    'beaners',
    'beaver cleaver',
    'beaver lips',
    'bestiality',
    'big black',
    'big breasts',
    'big knockers',
    'big tits',
    'bimbos',
    'birdlock',
    'bitch',
    'bitches',
    'black cock',
    'blonde action',
    'blonde on blonde action',
    'blowjob',
    'blow job',
    'blow your load',
    'blue waffle',
    'blumpkin',
    'bollocks',
    'bondage',
    'boner',
    'boob',
    'boobs',
    'booty call',
    'brown showers',
    'brunette action',
    'bukkake',
    'bulldyke',
    'bullet vibe',
    'bullshit',
    'bung hole',
    'bunghole',
    'busty',
    'butt',
    'buttcheeks',
    'butthole',
    'camel toe',
    'camgirl',
    'camslut',
    'camwhore',
    'carpet muncher',
    'carpetmuncher',
    'chocolate rosebuds',
    'circlejerk',
    'cleveland steamer',
    'clit',
    'clitoris',
    'clover clamps',
    'clusterfuck',
    'cock',
    'cocks',
    'coprolagnia',
    'coprophilia',
    'cornhole',
    'coon',
    'coons',
    'creampie',
    'cum',
    'cumming',
    'cunnilingus',
    'cunt',
    'darkie',
    'date rape',
    'daterape',
    'debit',
    'deep throat',
    'deepthroat',
    'dendrophilia',
    'dick',
    'dildo',
    'dingleberry',
    'dingleberries',
    'dirty pillows',
    'dirty sanchez',
    'doggie style',
    'doggiestyle',
    'doggy style',
    'doggystyle',
    'dog style',
    'dolcett',
    'domination',
    'dominatrix',
    'dommes',
    'donkey punch',
    'double dong',
    'double penetration',
    'dp action',
    'dry hump',
    'dvda',
    'eat my ass',
    'ecchi',
    'ejaculation',
    'erotic',
    'erotism',
    'escort',
    'eunuch',
    'faggot',
    'fecal',
    'felch',
    'fellatio',
    'feltch',
    'female squirting',
    'femdom',
    'figging',
    'fingerbang',
    'fingering',
    'fisting',
    'foot fetish',
    'footjob',
    'frotting',
    'fuck',
    'fuck buttons',
    'fuckin',
    'fucking',
    'fucktards',
    'fudge packer',
    'fudgepacker',
    'futanari',
    'gang bang',
    'gay sex',
    'genitals',
    'giant cock',
    'girl on',
    'girl on top',
    'girls gone wild',
    'goatcx',
    'goatse',
    'god damn',
    'gokkun',
    'golden shower',
    'goodpoop',
    'goo girl',
    'goregasm',
    'grope',
    'group sex',
    'g-spot',
    'guro',
    'hand job',
    'handjob',
    'hard core',
    'hardcore',
    'hentai',
    'homoerotic',
    'honkey',
    'hooker',
    'hot carl',
    'hot chick',
    'how to kill',
    'how to murder',
    'huge fat',
    'humping',
    'incest',
    'intercourse',
    'jack off',
    'jail bait',
    'jailbait',
    'jelly donut',
    'jerk off',
    'jigaboo',
    'jiggaboo',
    'jiggerboo',
    'jizz',
    'juggs',
    'kike',
    'kinbaku',
    'kinkster',
    'kinky',
    'knobbing',
    'leather restraint',
    'leather straight jacket',
    'lemon party',
    'lolita',
    'lovemaking',
    'make me come',
    'male squirting',
    'masturbate',
    'menage a trois',
    'milf',
    'missionary position',
    'motherfucker',
    'mound of venus',
    'mr hands',
    'muff diver',
    'muffdiving',
    'nambla',
    'nawashi',
    'negro',
    'neonazi',
    'nigga',
    'nigger',
    'nig nog',
    'nimphomania',
    'nipple',
    'nipples',
    'nsfw images',
    'nude',
    'nudity',
    'nympho',
    'nymphomania',
    'octopussy',
    'omorashi',
    'one cup two girls',
    'one guy one jar',
    'orgasm',
    'orgy',
    'paedophile',
    'paki',
    'panties',
    'panty',
    'pedobear',
    'pedophile',
    'pegging',
    'penis',
    'prescription',
    'phone sex',
    'piece of shit',
    'pissing',
    'piss pig',
    'pisspig',
    'playboy',
    'pleasure chest',
    'pole smoker',
    'ponyplay',
    'poof',
    'poon',
    'poontang',
    'punany',
    'poop chute',
    'poopchute',
    'porn',
    'porno',
    'pornography',
    'prince albert piercing',
    'pthc',
    'pubes',
    'pussy',
    'queaf',
    'queef',
    'quim',
    'raghead',
    'raging boner',
    'rape',
    'raping',
    'rapist',
    'rectum',
    'reverse cowgirl',
    'rimjob',
    'rimming',
    'rosy palm',
    'rosy palm and her 5 sisters',
    'rusty trombone',
    'sadism',
    'santorum',
    'scat',
    'schlong',
    'scissoring',
    'semen',
    'sex',
    'sexo',
    'sexy',
    'shaved beaver',
    'shaved pussy',
    'shemale',
    'shibari',
    'shit',
    'shitblimp',
    'shitty',
    'shota',
    'shrimping',
    'skeet',
    'slanteye',
    'slut',
    's&m',
    'smut',
    'snatch',
    'snowballing',
    'sodomize',
    'sodomy',
    'spic',
    'splooge',
    'splooge moose',
    'spooge',
    'spread legs',
    'spunk',
    'strap on',
    'strapon',
    'strappado',
    'strip club',
    'style doggy',
    'suck',
    'sucks',
    'suicide girls',
    'sultry women',
    'swastika',
    'swinger',
    'tainted love',
    'taste my',
    'tea bagging',
    'threesome',
    'throating',
    'tied up',
    'tight white',
    'tit',
    'tits',
    'titties',
    'titty',
    'tongue in a',
    'topless',
    'tosser',
    'towelhead',
    'tranny',
    'tribadism',
    'tub girl',
    'tubgirl',
    'tushy',
    'twat',
    'twink',
    'twinkie',
    'two girls one cup',
    'undressing',
    'upskirt',
    'urethra play',
    'urophilia',
    'vagina',
    'venus mound',
    'viagra',
    'vibrator',
    'violet wand',
    'visa',
    'vorarephilia',
    'voyeur',
    'vulva',
    'wank',
    'wetback',
    'wet dream',
    'white power',
    'wrapping men',
    'wrinkled starfish',
    'xx',
    'xxx',
    'yaoi',
    'yellow showers',
    'yiffy',
    'zoophilia',
    '🖕'
  );

  $stop_id = array();

  foreach ($_POST as $id => $value) {
    if (strpos_arr($value, $stop_words) !== false) {
      $stop_id[] = $id;
    }
  }

  if (sizeof($stop_id) > 0) {
    // $validation_result['is_valid'] = false;
    $_POST['input_6'] = "No";
  }

}
