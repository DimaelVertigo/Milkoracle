<?php
/**
 * Milkoracle functions and definitions
 *
 * @package Milkoracle
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'milkoracle_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function milkoracle_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Milkoracle, use a find and replace
	 * to change 'milkoracle' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'milkoracle', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'milkoracle' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'milkoracle_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	register_nav_menu( 'primary', 'Main menu' );
}
endif; // milkoracle_setup
add_action( 'after_setup_theme', 'milkoracle_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function milkoracle_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'milkoracle' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'milkoracle_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function milkoracle_scripts() {
	wp_enqueue_style( 'milkoracle-style', get_stylesheet_uri() );

	wp_enqueue_script( 'milkoracle-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );


  wp_enqueue_script( 'milkoracle-library', get_template_directory_uri() . '/js/library.js', array(), false );

	wp_enqueue_script( 'milkoracle-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
	
	
  wp_enqueue_script('jquery.mmenu.min.all.js', get_template_directory_uri() . '/js/jquery.mmenu.min.all.js');
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js' );
	
}
add_action( 'wp_enqueue_scripts', 'milkoracle_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Подсчет количества посещений страниц
---------------------------------------------------------- */
add_action('wp_head', 'kama_postviews');
function kama_postviews() {

/* ------------ Настройки -------------- */
$meta_key		= 'views';	// Ключ мета поля, куда будет записываться количество просмотров.
$who_count 		= 1; 			// Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированых пользователей.
$exclude_bots 	= 1;			// Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.
/* СТОП настройкам */

global $user_ID, $post;
	if(is_singular()) {
		$id = (int)$post->ID;
		static $post_views = false;
		if($post_views) return true; // чтобы 1 раз за поток
		$post_views = (int)get_post_meta($id,$meta_key, true);
		$should_count = false;
		switch( (int)$who_count ) {
			case 0: $should_count = true;
				break;
			case 1:
				if( (int)$user_ID == 0 )
					$should_count = true;
				break;
			case 2:
				if( (int)$user_ID > 0 )
					$should_count = true;
				break;
		}
		if( (int)$exclude_bots==1 && $should_count ){
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
			$bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
			if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
				$should_count = false;
		}

		if($should_count)
			if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
	}
	return true;
}
/** Функция для вывода записей по произвольному полю содержащему числовое значение.
-------------------------------------
Параметры передаваемые функции (в скобках дефолтное значение):
num (10) - количество постов.
key (views) - ключ произвольного поля, по значениям которого будет проходить выборка.
order (DESC) - порядок вывода записей. Чтобы вывести сначала менее просматириваемые устанавливаем order=1
format(0) - Формат выводимых ссылок. По дефолту такой: ({a}{title}{/a}). Можно использовать, например, такой: {date:j.M.Y} - {a}{title}{/a} ({views}, {comments}).
days(0) - число последних дней, записи которых нужно вывести по количеству просмотров. Если указать год (2011,2010), то будут отбираться популярные записи за этот год.
cache (0) - использовать кэш или нет. Варианты 1 - кэширование включено, 0 - выключено (по дефолту).
echo (1) - выводить на экран или нет. Варианты 1 - выводить (по дефолту), 0 - вернуть для обработки (return).
Пример вызова: kama_get_most_viewed("num=5 &key=views &cache=1 &format={a}{title}{/a} - {date:j.M.Y} ({views}) ({comments})");
*/
function kama_get_most_viewed($args=''){
	parse_str($args, $i);
	$num 	= isset($i['num']) ? $i['num']:10;
	$key 	= isset($i['key']) ? $i['key']:'views';
	$order	= isset($i['order']) ? 'ASC':'DESC';
	$cache	= isset($i['cache']) ? 1:0;
	$days	= isset($i['days']) ? (int)$i['days']:0;
	$echo 	= isset($i['echo']) ? 0:1;
	$format = isset($i['format']) ? stripslashes($i['format']):0;
	global $wpdb,$post;
	$cur_postID = $post->ID;

	if( $cache ){ $cache_key = (string) md5( __FUNCTION__ . serialize($args) );
		if ( $cache_out = wp_cache_get($cache_key) ){ //получаем и отдаем кеш если он есть
			if ($echo) return print($cache_out); else return $cache_out;
		}
	}

	if( $days ){
	    $AND_days = "AND post_date > CURDATE() - INTERVAL $days DAY";
	    if( strlen($days)==4 )
	        $AND_days = "AND YEAR(post_date)=" . $days;
	}

	$sql = "SELECT p.ID, p.post_title, p.post_date, p.guid, p.comment_count, (pm.meta_value+0) AS views
	FROM $wpdb->posts p
		LEFT JOIN $wpdb->postmeta pm ON (pm.post_id = p.ID)
	WHERE pm.meta_key = '$key' $AND_days
		AND p.post_type = 'post'
		AND p.post_status = 'publish'
	ORDER BY views $order LIMIT $num";
	$results = $wpdb->get_results($sql);
	if( !$results ) return false;

	$out= '';
	preg_match( '!{date:(.*?)}!', $format, $date_m );
	foreach( $results as $pst ){
	    $x == 'li1' ? $x = 'li2' : $x = 'li1';
	    if ( (int)$pst->ID == (int)$cur_postID ) $x .= " current-item";
	    $Title = $pst->post_title;
	    $a1 = "<a href='". get_permalink($pst->ID) ."' title='{$pst->views} просмотров: $Title'>";
		$a2 = "</a>";
		$comments = $pst->comment_count;
		$views = $pst->views;
	    if( $format ){
	        $date = apply_filters('the_time', mysql2date($date_m[1],$pst->post_date));
	        $Sformat = str_replace ($date_m[0], $date, $format);
	        $Sformat = str_replace(array('{a}','{title}','{/a}','{comments}','{views}'), array($a1,$Title,$a2,$comments,$views), $Sformat);
	    }
	    else $Sformat = $a1.$Title.$a2;
	    $out .= "<li class='col-xs-12 col-sm-6 col-md-3'>$Sformat</li>";
	}

	if( $cache ) wp_cache_add($cache_key, $out);

	if( $echo )
		return print $out;
	else
		return $out;
}

 
function get_custom_cat_template($single_template) {
     global $post;
 
       if ( in_category( 'questions' )) {
          $single_template = dirname( __FILE__ ) . '/page-question.php';
     }
     return $single_template;
}
 
add_filter( "single_template", "get_custom_cat_template" ) ;


//custom post type
function create_post_type() {
    // register_post_type('stories',
    //     array(
    //         'labels'         => array(
    //             'name'          => __('Stories'),
    //             'singular_name' => __('Stories')
    //         ),
    //         'public'      => true,
    //         'has_archive' => true,
    //         'taxonomies' => array('category'),
    //     )
    // );
    //pti_set_post_type_icon( 'partner', 'picture-o' );
    register_post_type('livestream',
        array(
            'labels'         => array(
                'name'          => __('Livestream'),
                'singular_name' => __('Livestream')
            ),
            'public'      => true,
            'has_archive' => true,
        )
    );
    //pti_set_post_type_icon( 'partner', 'picture-o' );
    register_post_type('news-and-events',
        array(
            'labels'         => array(
                'name'          => __('News and Events'),
                'singular_name' => __('News and Events')
            ),
            'public'      => true,
            'has_archive' => true,
        )
    );
    //pti_set_post_type_icon( 'partner', 'picture-o' );
    flush_rewrite_rules();
    // register_post_type('college-life',
    //     array(
    //         'labels'         => array(
    //             'name'          => __('College life'),
    //             'singular_name' => __('College life')
    //         ),
    //         'public'      => true,
    //         'has_archive' => true,
    //         'taxonomies' => array('category'),
    //     )
    // );
    //pti_set_post_type_icon( 'partner', 'picture-o' );
    // register_post_type('admission',
    //     array(
    //         'labels'         => array(
    //             'name'          => __('Admission'),
    //             'singular_name' => __('Admission')
    //         ),
    //         'public'      => true,
    //         'has_archive' => true,
    //         'taxonomies' => array('category'),
    //     )
    // );
    //pti_set_post_type_icon( 'partner', 'picture-o' );
    // register_post_type('career',
    //     array(
    //         'labels'         => array(
    //             'name'          => __('Career'),
    //             'singular_name' => __('Career')
    //         ),
    //         'public'      => true,
    //         'has_archive' => true,
    //         'taxonomies' => array('category'),
    //     )
    // );
    //pti_set_post_type_icon( 'partner', 'picture-o' );
    flush_rewrite_rules();
}
add_action('init', 'create_post_type');

//custom post type taxonomies
function create_my_taxonomies() {
    // register_taxonomy(
    //     'inspiration_category',
    //     'inspiration',
    //     array(
    //         'labels' => array(
    //             'name' => 'Inspiration category',
    //             'add_new_item' => 'Add new category',
    //             'new_item_name' => "New category"
    //         ),
    //         'show_ui' => true,
    //         'show_tagcloud' => false,
    //         'hierarchical' => true
    //     )
    // );
    // register_taxonomy(
    //     'college-prep_category',
    //     'college-prep',
    //     array(
    //         'labels' => array(
    //             'name' => 'College category',
    //             'add_new_item' => 'Add new category',
    //             'new_item_name' => "New category"
    //         ),
    //         'show_ui' => true,
    //         'show_tagcloud' => false,
    //         'hierarchical' => true
    //     )
    // );
    // register_taxonomy(
    //     'admission_category',
    //     'admission',
    //     array(
    //         'labels' => array(
    //             'name' => 'Admission category',
    //             'add_new_item' => 'Add new category',
    //             'new_item_name' => "New category"
    //         ),
    //         'show_ui' => true,
    //         'show_tagcloud' => false,
    //         'hierarchical' => true
    //     )
    // );
    // register_taxonomy(
    //     'career_category',
    //     'career',
    //     array(
    //         'labels' => array(
    //             'name' => 'Career category',
    //             'add_new_item' => 'Add new category',
    //             'new_item_name' => "New category"
    //         ),
    //         'show_ui' => true,
    //         'show_tagcloud' => false,
    //         'hierarchical' => true
    //     )
    // );

}
add_action( 'init', 'create_my_taxonomies', 0 );

function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 ); 

function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

  
function getCrunchifyPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
 
function setCrunchifyPostViews($postID) {
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
 
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);




?>