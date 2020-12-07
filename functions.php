<?php
  // Add RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  // Enable support for Post Thumbnails, and declare two sizes.
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'primary'   => __( 'Главное меню', 'redaction' ),
    'secondary' => __( 'Левое Меню', 'redaction' ),
    'tertiary' => __( 'Меню в  Футере', 'redaction' ),
  ) );
  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

  /*
   * Enable support for Post Formats.
   * See https://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
  ) );

  // This theme allows users to set a custom background.
  add_theme_support( 'custom-background', apply_filters( 'redaction_custom_background_args', array(
    'default-color' => 'ffffff',
  ) ) );

  // Цитаты
  add_post_type_support( 'page', 'excerpt' );

  // колонка "ID"
  if (is_admin()) {
  // колонка "ID" для таксономий (рубрик, меток и т.д.) в админке
  foreach (get_taxonomies() as $taxonomy) {
    add_action("manage_edit-${taxonomy}_columns", 'tax_add_col');
    add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');
    add_filter("manage_${taxonomy}_custom_column", 'tax_show_id', 10, 3);
  }
  add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
  function tax_add_col($columns) {return $columns + array ('tax_id' => 'ID');}
  function tax_show_id($v, $name, $id) {return 'tax_id' === $name ? $id : $v;}
  function tax_id_style() {print '<style>#tax_id{width:4em}</style>';}

  // колонка "ID" для постов и страниц в админке
  add_filter('manage_posts_columns', 'posts_add_col', 5);
  add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);
  add_filter('manage_pages_columns', 'posts_add_col', 5);
  add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);
  add_action('admin_print_styles-edit.php', 'posts_id_style');
  function posts_add_col($defaults) {$defaults['wps_post_id'] = __('ID'); return $defaults;}
  function posts_show_id($column_name, $id) {if ($column_name === 'wps_post_id') echo $id;}
  function posts_id_style() {print '<style>#wps_post_id{width:4em}</style>';}
  }

  // просмотры
  function getPostViews($postID){
      $count_key = 'post_views_count';
      $count = get_post_meta($postID, $count_key, true);
      if($count==''){
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
          return "0";
      }
      return $count;
  }
  function setPostViews($postID) {
      $count_key = 'post_views_count';
      $count = get_post_meta($postID, $count_key, true);
      if($count==''){
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
      }else{
          $count++;
          update_post_meta($postID, $count_key, $count);
      }
  }
  add_filter('manage_posts_columns', 'posts_column_views');
  add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
  function posts_column_views($defaults){
      $defaults['post_views'] = __('Просмотры');
      return $defaults;
  }
  function posts_custom_column_views($column_name, $id){
          if($column_name === 'post_views'){
          echo getPostViews(get_the_ID());
      }
  }

/**
 * Проверка активности плагина не на странице плагинов.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Add a sidebar.
 */
register_sidebar( array(
    'name'          => 'Левый Сайдбар',
    'id'            => 'left-sidebar',
    'description'   => 'Widgets in this area will be shown on all posts and pages.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
register_sidebar( array(
    'name'          => 'Правый Сайдбар',
    'id'            => 'right-sidebar',
    'description'   => 'Widgets in this area will be shown on all posts and pages.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
register_sidebar( array(
    'name'          => 'Сайдбар Шапки',
    'id'            => 'header-sidebar',
    'description'   => 'Widgets in this area will be shown on all posts and pages.',
    'before_widget' => '<section>',
    'after_widget'  => '</section>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
) );
register_sidebar( array(
    'name'          => 'Сайдбар Футера',
    'id'            => 'footer-sidebar',
    'description'   => 'Widgets in this area will be shown on all posts and pages.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
/**
 * Enqueue scripts and styles.
 */
function redaction_scripts() {
      wp_enqueue_style('style', get_template_directory() . 'style.css' );
  }
add_action( 'wp_enqueue_scripts', 'redaction_scripts' );

/**
* woocommerce валюта
**/
add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
$currencies['ABC'] = __( 'UA гривня', 'woocommerce' );
return $currencies;
}
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
switch( $currency ) {
case 'ABC': $currency_symbol = 'грн.'; break;
}
return $currency_symbol;
}

/**
* woocommerce
**/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 7);

//Удаляем хлебные крошки
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
//Удаляем табы в одиночном товаре
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 2);
//Удаляем отзывы о товаре
remove_action( 'woocommerce_product_tabs', 'woocommerce_product_reviews_tab', 30 );
remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_reviews_panel', 30 );

add_action('redaction_single_product_price_info', 'woocommerce_template_single_price', 10);
add_action('redaction_single_product_price_info', 'woocommerce_template_single_add_to_cart', 20);
/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function woo_related_products_limit() {
  global $product;
  
  $args['posts_per_page'] = 3;
  return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'redaction_related_products_args' );
  function redaction_related_products_args( $args ) {
  $args['posts_per_page'] = 3; // 4 related products
  $args['columns'] = 2; // arranged in 2 columns
  return $args;
}

add_filter( 'woocommerce_cart_item_name', 'add_sku_in_cart', 20, 3);

function add_sku_in_cart( $title, $values, $cart_item_key ) {
    $sku = $values['data']->get_sku();
    return $sku ? $title . sprintf(" (Артикул: %s)", $sku) : $title;
}

add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

?>