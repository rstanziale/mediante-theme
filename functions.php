<?php

require_once('includes/wp-bootstrap-navwalker.php');

if (!function_exists('mediante_logo')) :
    function mediante_logo()
    { ?>
        <style type="text/css">
            #login h1 a,
            .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
                height: 150px;
                width: 150px;
                background-size: 150px 150px;
                background-repeat: no-repeat;
                border-radius: 100px;
            }
        </style>
        <?php }
endif;
add_action('login_enqueue_scripts', 'mediante_logo');

/*Load the theme stylesheets*/
if (!function_exists('mediante_styles')) :
    function mediante_styles()
    {
        // Get modification time. Enqueue files with modification date to prevent browser from loading cached scripts and styles when file content changes.
        $modificated_styleCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/style.css'));
        $modificated_bootstrapCss = date('YmdHi', filemtime(get_template_directory() . '/css/lib/bootstrap.min.css'));

        require_once 'includes/scss-compiler.php';
        bootscore_compile_scss();
        wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.15.4/css/all.css');
        wp_enqueue_style('aos', '//unpkg.com/aos@2.3.1/dist/aos.css');
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/lib/bootstrap.min.css', array(), $modificated_bootstrapCss);
        wp_enqueue_style('mediante-style', get_stylesheet_uri(), array(), $modificated_styleCss);
    }
endif;
add_action('wp_enqueue_scripts', 'mediante_styles');

/*Load styles and scripts*/
if (!function_exists('mediante_scripts')) :
    function mediante_scripts()
    {
        $modificated_bootstrapJs = date('YmdHi', filemtime(get_template_directory() . '/js/lib/bootstrap.bundle.min.js'));
        $modificated_themeJs = date('YmdHi', filemtime(get_template_directory() . '/js/scripts.js'));
        wp_enqueue_script('font-awesome', '//use.fontawesome.com/releases/v5.15.4/js/all.js');
        // wp_enqueue_script('masonry', '//cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js');
        wp_enqueue_script('aos', '//unpkg.com/aos@2.3.1/dist/aos.js');
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/lib/bootstrap.bundle.min.js', array(), $modificated_bootstrapJs, true);
        wp_enqueue_script('script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), $modificated_themeJs, true);
        if (is_singular()) wp_enqueue_script('comment-reply');
    }
endif;
add_action('wp_enqueue_scripts', 'mediante_scripts');


/*Navigation Menus*/
if (!function_exists('mediante_menu')) :
    function mediante_menu()
    {
        register_nav_menu('header-menu', __('Header Menu'));
    }
endif;
add_action('init', 'mediante_menu');

/*Sidebar*/
if (!function_exists('mediante_widgets')) :
    function mediante_widgets()
    {
        register_sidebar(array(
            'name'          => 'Sidebar',
            'id'            => 'sidebar',
            'before_widget' => '<div class="card"><div class="card-body">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h4 class="card-title">',
            'after_title'   => '</h4>',
        ));
    }
endif;
add_action('widgets_init', 'mediante_widgets');

/*Generic setup for theme*/
if (!function_exists('mediante_setup')) :
    function mediante_setup()
    {
        // Thumbnails into post page
        add_theme_support('post-thumbnails');
        // Dynamic title
        add_theme_support('title-tag');
        // Responsive embeds
        add_theme_support('responsive-embeds');
    }
endif;
add_action('after_setup_theme', 'mediante_setup');

/*Excerpt into archive page*/
function set_excerpt_length()
{
    return 20;
}
add_filter('excerpt_length', 'set_excerpt_length');

/*Exclude Pages from WordPress Search Results Without a Plugin*/
if (!is_admin()) {
    function wpb_search_filter($query)
    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
    add_filter('pre_get_posts', 'wpb_search_filter');
}

//Registrazione di un contenuto personalizzato - base
function weblab_custom_service()
{
    $labels = array(
        'name' => 'Servizi',
        'singular_name' => 'Servizi',
        'menu_name' => 'Miei servizi',
        'add_new' => 'Aggiungi nuovo',
        'all_items' => 'Tutti i servizi',
        'add_new_item' => 'Nuovo',
        'edit_item' => 'Modifica',
        'new_item' => 'Nuovo servizio',
        'view_item' => 'Visualizza',
        'search_item' => 'Ricerca',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus'     => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'servizi'),
        'capability_type' => 'post',
        'hierarchical' => true,
        'show_in_rest' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'comments',
            'custom-fields',
            'thumbnail',
            'page-attributes'
        ),
        'taxonomies' => array('category', 'post_tag'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-products',
        'exclude_from_search' => false
    );
    register_post_type('servizi', $args);
}

add_action('init', 'weblab_custom_service');

// Comments
if (!function_exists('mediante_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function mediante_comment($comment, $args, $depth)
    {
        // $GLOBALS['comment'] = $comment;

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li class="bg-danger" id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
                <div class="comment-body">
                    <?php _e('Pingback:', 'mediante'); ?> <?php comment_author_link(); ?> <?php edit_comment_link('Modifica', '<span>', '</span>'); ?>
                </div>

            <?php else : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>

                <article id="div-comment-<?php comment_ID(); ?>" class="comment-body mt-4 d-flex">

                    <div class="flex-shrink-0 me-3">
                        <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'img-thumbnail rounded-circle')); ?>
                    </div>

                    <div class="comment-content flex-grow-1">
                        <div class="card">
                            <div class="card-header">
                                <?php printf('%1$s <span class="">il %2$s alle %3$s dice:</span>', sprintf('<span class="fw-bold">%s</span>', get_comment_author_link()), get_comment_date(), get_comment_time()); ?>
                            </div>
                            <div class="card-body">

                                <?php if ('0' == $comment->comment_approved) : ?>
                                    <p class="text-warning">In attesa di approvazione</p>
                                <?php endif; ?>

                                <div class="card-block">
                                    <?php comment_text(); ?>
                                </div>

                                <small class="text-muted mt-2">
                                    <?php edit_comment_link('Modifica', '<span>', '</span>'); ?>
                                </small>

                            </div>
                            <?php comment_reply_link(
                                array_merge(
                                    $args,
                                    array(
                                        'add_below' => 'div-comment',
                                        'depth'     => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'before'     => '<small class="card-footer">',
                                        'after'     => '</small>'
                                    )
                                )
                            ); ?>
                        </div>
                    </div>
                </article>
            </li>

<?php
        endif;
    }
endif;

/*Register new sections for API Customizer*/
if (!function_exists('mediante_customize_register')) :
    function mediante_customize_register($wp_customize)
    {
        // Carousel settings
        $wp_customize->add_section('carousel_front_page', array(
            'title' => __('Carousel pagina iniziale', 'mediante'),
            'priority' => 30,
        ));

        // Max elements custom field
        $wp_customize->add_setting('cfp_max_elements', array(
            'default' => 3,
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'custom_cfp_max_elements_label',
            array(
                'label' => __('Numero massimo di elementi', 'custom_cfp_max_elements_control'),
                'section' => 'carousel_front_page',
                'settings' => 'cfp_max_elements',
                'type' => 'number',

            )
        ));

        // Category name custom field
        $wp_customize->add_setting('cfp_category_name', array(
            'default' => 'projects',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'custom_cfp_category_name_label',
            array(
                'label' => __('Nome categoria', 'custom_cfp_category_name_control'),
                'section' => 'carousel_front_page',
                'settings' => 'cfp_category_name',
                'type' => 'text',

            )
        ));

        // CF settings
        $wp_customize->add_section('cf_footer_page', array(
            'title' => __('Codice fiscale nel footer', 'mediante'),
            'priority' => 50,
        ));

        // Text to display
        $wp_customize->add_setting('cf_text', array(
            'default' => 'INSERT HERE YOUR FISCAL CODE',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'custom_cf_text_label',
            array(
                'label' => __('Codice fiscale', 'custom_cf_text_control'),
                'section' => 'cf_footer_page',
                'settings' => 'cf_text',
                'type' => 'text',

            )
        ));
    }
endif;
add_action('customize_register', 'mediante_customize_register');

// Disable Gutenberg blocks in widgets (WordPress 5.8)
// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
// Disables the block editor from managing widgets.
add_filter('use_widgets_block_editor', '__return_false');