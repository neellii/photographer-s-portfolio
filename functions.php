<?php
/**
 * ph-portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ph-portfolio
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ph_portfolio_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ph-portfolio, use a find and replace
		* to change 'ph-portfolio' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ph-portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ph-portfolio' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ph_portfolio_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ph_portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ph_portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ph_portfolio_content_width', 640 );
}
add_action( 'after_setup_theme', 'ph_portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ph_portfolio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ph-portfolio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ph-portfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ph_portfolio_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function ph_portfolio_scripts() {
	wp_enqueue_style( 'ph-portfolio-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'ph-portfolio-mainstyle', get_template_directory_uri() . '/assets/styles/main.css', array(), "1.0" );

	wp_register_script( 'ph-portfolio-lenis', 'https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.29/bundled/lenis.min.js', null, "1.0.29", true );
	wp_enqueue_script( 'ph-portfolio-lenis');
	wp_register_script( 'ph-portfolio-gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js', true );
	wp_enqueue_script( 'ph-portfolio-gsap');
	wp_register_script( 'ph-portfolio-scroll', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/ScrollTrigger.min.js', true );
	wp_enqueue_script( 'ph-portfolio-scroll');

	wp_enqueue_script( 'ph-portfolio-main', get_template_directory_uri() . '/assets/scripts/script.js', array(), "1.0", true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ph_portfolio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

if (function_exists("acf_add_options_page")) {
	acf_add_options_page(array(
			"page_title" => "Footer",
			"menu_title" => "Footer",
			"menu_slug"  => "theme_settings",
	));
}

function load_scripts() {
	// Register the script
	wp_register_script( 'custom-script', get_template_directory_uri() . '/assets/scripts/load.js', array('jquery'), false, true );

	// Localize the script with new data
	$script_data_array = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'load_more_posts' ),
	);
	wp_localize_script( 'custom-script', 'blog', $script_data_array );

	// Enqueued script with localized data.
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );


function load_posts_by_ajax_callback() {
check_ajax_referer('load_more_posts', 'security');
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '6',
        'paged' => $_POST['page'],
    );
    $blog_posts = new WP_Query( $args ); ?>
 
    <?php if ( $blog_posts->have_posts() ) : ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
					<div class="p__item">
              <a href="<?php the_permalink(); ?>"
                ><img src="<?php the_field('projects_image'); ?>" alt="" />
                <p><?php the_title(); ?></p></a
              >
          </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
    <?php
    wp_die();
}

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

add_filter('show_admin_bar', '__return_false');
