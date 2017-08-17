<?php
require_once 'wp-bootstrap-navwalker.php';
require_once 'lib/widgets/class-wp-widget-categories.php';
require_once 'lib/widgets/class-wp-widget-recent-posts.php';
require_once 'lib/widgets/class-wp-widget-twitter-tweets.php';
require_once 'lib/widgets/class-wp-widget-facebook_like_box.php';
require_once 'lib/widgets/class-wp-widget-stay-in-touch.php';
require_once 'theme-options/theme-options.php';

function theme_setup() {
    //Featured Image Support
    add_theme_support('post-thumbnails');

    // Add Feature for custom logo
    add_theme_support('custom-logo');
    
    
    add_post_type_support( 'page', 'excerpt' );

    //register navigation menu
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'rtpanel-new'),
        'footer' => esc_html__('Secondary Menu', 'rtpanel-new'),
    ));
}

add_action('after_setup_theme', 'theme_setup');

// Sidebar Widget Location Register
function rtpanel_new_widgets_init($id) {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'rtpanel-new'),
        'id' => 'sidebar',
        'before_widget' => '<div class="panel-default">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
        'after_title' => '</h3></div><div class="panel-body">',
    ));
}

add_action('widgets_init', 'rtpanel_new_widgets_init');

// Footer Widget Location Register
function rtpanel_new_footer_widgets_init($id) {
    register_sidebar(array(
        'name' => esc_html__('Footer', 'rtpanel-new'),
        'id' => 'footer',
        'before_widget' => '<div class="col-md-3">',
        'after_widget' => '</div>',
    ));
}

add_action('widgets_init', 'rtpanel_new_footer_widgets_init');

// Add 'list-group-item' to Categories <li> tag\
function add_new_class_list_categories($list) {
    $list = str_replace('cat-item', 'cat-item list-group-item', $list);
    return $list;
}

add_filter('wp_list_categories', 'add_new_class_list_categories');

// Register Widgets
function rtpanel_new_register_widgets() {
    register_widget('WP_Widget_Categories_Custom');
    register_widget('WP_Widget_Recent_Posts_Custom');
    register_widget('WP_Widget_Fetch_Twitter_Tweets');
    register_widget('WP_Widget_Facebook_Like_Box');
    register_widget('WP_Widget_Stay_In_Touch');
}

add_action('widgets_init', 'rtpanel_new_register_widgets');

//Add Comments
function add_theme_comments($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li class="well comment-item list-unstyled"';
        $add_below = 'div-comment';
    }
    ?>

    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
        <div class="row">
            <div class="comment-author vcard col-md-2">
    <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>

            </div>
            <div class="col-md-10">
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()); ?>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em>
                    <br />
    <?php endif; ?>

                <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
    <?php
    /* translators: 1: date, 2: time */
    printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time());
    ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
    ?>
                </div>

                <?php comment_text(); ?>

                <div class="reply">
                    <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </div>
                <?php if ('div' != $args['style']) : ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php
}

/**
 * Enqueues scripts and styles.
 *
 * For rtTheme-bootstrap
 */
function rttheme_bootstrap_scripts() {
    wp_enqueue_style('font-awesome-style', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");
//    wp_enqueue_script( 'font-awesome', "https://use.fontawesome.com/ac2f4da711.js" );
}

add_action('wp_enqueue_scripts', 'rttheme_bootstrap_scripts');

//Bootstrap Pagination
function wpc_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo '<div class="text-center"><h3>Posts Navigation</h3>';
        echo '<ul class="pagination pagination-lg text-center">';
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo '<li><a href="' . get_pagenum_link(1) . '">FIRST</a></li>';
        if ($paged > 1 && $showitems < $pages)
            echo '<li><a href="' . get_pagenum_link($paged - 1) . '" rel="prev">previous</a></li>';

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                echo ($paged == $i) ? '<li class="active"><a href="#">' . $i . '</a></li>' : '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
            }
        }

        if ($paged < $pages && $showitems < $pages)
            echo '<li><a href="' . get_pagenum_link($paged + 1) . '" rel="next">next</a></li>';
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo '<li><a href="' . get_pagenum_link($pages) . '">LAST</a></li>';
        echo '</ul></div>';
    }
}


// Custom Post type for Glimplses of Exhibition
function create_custom_post_type_exhibition() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Exhibition', 'Post Type General Name', 'rtTheme-bootstrap'),
        'singular_name' => _x('Exhibition', 'Post Type Singular Name', 'rtTheme-bootstrap'),
        'menu_name' => __('Exhibition', 'rtTheme-bootstrap'),
        'parent_item_colon' => 'Parent Exhibition',
        'all_items' => __('All Exhibition', 'rtTheme-bootstrap'),
        'view_item' => __('View Exhibition', 'rtTheme-bootstrap'),
        'add_new_item' => __('Add New Exhibition', 'rtTheme-bootstrap'),
        'add_new' => __('Add New', 'rtTheme-bootstrap'),
        'edit_item' => __('Edit Exhibition', 'rtTheme-bootstrap'),
        'update_item' => __('Update Exhibition', 'rtTheme-bootstrap'),
        'search_items' => __('Search Exhibition', 'rtTheme-bootstrap'),
        'not_found' => __('Not Found', 'rtTheme-bootstrap'),
        'not_found_in_trash' => __('Not found in Trash', 'rtTheme-bootstrap'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label' => __('exhibition', 'rtTheme-bootstrap'),
        'description' => __('Exhibition news and reviews', 'rtTheme-bootstrap'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array(
            'title', 
            'editor', 
            'excerpt', 
            'author', 
            'thumbnail', 
            'comments', 
            'revisions', 
            'custom-fields',
        ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies' => array('category', 'post_tag'),
        /* A hierarchical CPT is like Pages and can have
         * Parent and child items. A non-hierarchical CPT
         * is like Posts.
         */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'show_in_menu' => true,
        'rewrite' => array( 'slug' => 'exhibition', 'with_front' => false ),
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    // Registering your Custom Post Type
    register_post_type('exhibition', $args);
}

// Hooking up custom post type exhibition function to theme setup
add_action( 'init', 'create_custom_post_type_exhibition');


// Custom Post type for Glimplses of Exhibition
function create_custom_post_type_slider() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Slider', 'Post Type General Name', 'rtTheme-bootstrap'),
        'singular_name' => _x('Slider', 'Post Type Singular Name', 'rtTheme-bootstrap'),
        'menu_name' => __('Slider', 'rtTheme-bootstrap'),
        'parent_item_colon' => 'Parent Slider',
        'all_items' => __('All Slider', 'rtTheme-bootstrap'),
        'view_item' => __('View Slider', 'rtTheme-bootstrap'),
        'add_new_item' => __('Add New Slider', 'rtTheme-bootstrap'),
        'add_new' => __('Add New', 'rtTheme-bootstrap'),
        'edit_item' => __('Edit Slider', 'rtTheme-bootstrap'),
        'update_item' => __('Update Slider', 'rtTheme-bootstrap'),
        'search_items' => __('Search Slider', 'rtTheme-bootstrap'),
        'not_found' => __('Not Found', 'rtTheme-bootstrap'),
        'not_found_in_trash' => __('Not found in Trash', 'rtTheme-bootstrap'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label' => __('slider', 'rtTheme-bootstrap'),
        'description' => __('Slider', 'rtTheme-bootstrap'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => array(
            'title', 
            'author', 
            'thumbnail', 
            'revisions', 
        ),
        /* A hierarchical CPT is like Pages and can have
         * Parent and child items. A non-hierarchical CPT
         * is like Posts.
         */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'show_in_menu' => true,
        'rewrite' => array( 'slug' => 'slider', 'with_front' => false ),
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );

    // Registering your Custom Post Type
    register_post_type('slider', $args);
}

// Hooking up custom post type exhibition function to theme setup
add_action( 'init', 'create_custom_post_type_slider');


/* Flush rewrite rules for custom post types. */
add_action( 'after_switch_theme', 'bt_flush_rewrite_rules' );

/* Flush your rewrite rules */
function bt_flush_rewrite_rules() {
     flush_rewrite_rules();
}



