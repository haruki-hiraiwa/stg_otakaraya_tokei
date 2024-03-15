<?php

/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}


require_once(ABSPATH . 'wp-admin/includes/file.php');

/*------------------------------------------------------------
テーマフォルダへのパスを定数でどこからでも使えるようにしておく：主に各テンプレートファイルで使用
------------------------------------------------------------*/
define("THEME_URL", get_template_directory_uri() . "/");

// function init_sessions(){
//     if(session_status() == PHP_SESSION_NONE){

//         session_start();
//     }

// }
// add_action('init', 'init_sessions');


/*------------------------------------------------------------
サイト内のパスを相対パスに書き換え
------------------------------------------------------------*/
class relative_URI
{
    function relative_URI()
    {
        add_action('get_header', array(&$this, 'get_header'), 1);
        add_action('wp_footer', array(&$this, 'wp_footer'), 99999);
    }
    function replace_relative_URI($content)
    {
        $home_url = trailingslashit(get_home_url('/brand-tokei/'));
        return str_replace($home_url, '/brand-tokei/', $content);
    }
    function get_header()
    {
        ob_start(array(&$this, 'replace_relative_URI'));
    }
    function wp_footer()
    {
        ob_end_flush();
    }
}
new relative_URI();


/*------------------------------------------------------------
WordPressデフォルトで読み込まれるCSSを読み込ませない
------------------------------------------------------------*/
function twpp_deregister_styles()
{
    wp_deregister_style('wp-block-library');
    wp_deregister_style('wp-block-library-theme');
    wp_deregister_style('classic-theme-styles');
    wp_deregister_style('global-styles');
    wp_deregister_style('twentyseventeen-style');
    wp_deregister_style('twentyseventeen-ie8');
    wp_deregister_style('ytsl-textdomain');
    wp_deregister_style('wp-pagenavi');
    wp_deregister_style('wp-lightbox-2.min.css');
    wp_deregister_style('twentyseventeen-block-style');
    wp_deregister_script('ytsl-textdomain');
    wp_deregister_script('jquery');
    wp_deregister_script('wp-jquery-lightbox');
    wp_deregister_script('html5');
    wp_deregister_script('twentyseventeen-skip-link-focus-fix');
    wp_deregister_script('twentyseventeen-global');
    wp_deregister_script('jquery-scrollto');
}
add_action('wp_enqueue_scripts', 'twpp_deregister_styles', 100);

function aktk_remove_bar_menus($wp_admin_bar)
{
    $wp_admin_bar->remove_menu('wp-logo'); //WordPressアイコン
    $wp_admin_bar->remove_menu('about'); //WordPressアイコン -> WordPress について
    $wp_admin_bar->remove_menu('wporg'); //WordPressアイコン -> WordPress.org
    $wp_admin_bar->remove_menu('documentation'); //WordPressアイコン -> ドキュメンテーション
    $wp_admin_bar->remove_menu('support-forums'); //WordPressアイコン -> サポートフォーラム
    $wp_admin_bar->remove_menu('feedback'); //WordPressアイコン -> フィードバック

    $wp_admin_bar->remove_menu('site-name'); //サイト情報
    $wp_admin_bar->remove_menu('dashboard'); //サイト情報 -> ダッシュボード
    $wp_admin_bar->remove_menu('themes'); //サイト情報 -> テーマ
    $wp_admin_bar->remove_menu('widgets'); //サイト情報 -> ウィジェット
    $wp_admin_bar->remove_menu('menus'); //サイト情報 -> メニュー
    $wp_admin_bar->remove_menu('header'); //サイト情報 -> ヘッダー

    $wp_admin_bar->remove_menu('customize'); //カスタマイズ
    $wp_admin_bar->remove_menu('comments'); //コメント

    $wp_admin_bar->remove_menu('new-content'); //新規
    $wp_admin_bar->remove_menu('new-post'); //新規 -> 投稿
    $wp_admin_bar->remove_menu('new-media'); //新規 -> メディア
    $wp_admin_bar->remove_menu('new-page'); //新規 -> 固定ページ
    $wp_admin_bar->remove_menu('new-user'); //新規 -> ユーザー

    // $wp_admin_bar->remove_menu( 'edit' ); //〜の編集

    //    $wp_admin_bar->remove_menu( 'my-account' ); //こんにちは、[ユーザー名]　さん
    //    $wp_admin_bar->remove_menu( 'user-info' ); //ユーザー -> ユーザー名・アイコン
    //    $wp_admin_bar->remove_menu( 'edit-profile' ); //ユーザー -> プロフィールを編集
    //    $wp_admin_bar->remove_menu( 'logout' ); //ユーザー -> ログアウト

    // $wp_admin_bar->remove_menu( 'search' ); //検索
}
add_action('admin_bar_menu', 'aktk_remove_bar_menus', 99);

// ========================================================

function print_enqueue_script()
{
    global $wp_scripts;
    $count = 1;
    // echo '**************enqueued script<br>';
    foreach ($wp_scripts->queue as $queue) {
        echo ($count++) . ':' . text_from_dependency($wp_scripts->registered[$queue]) . '<br>';
    }
}
function print_enqueue_style()
{
    global $wp_styles;
    $count = 1;
    // echo '**************enqueued style<br>';
    foreach ($wp_styles->queue as $queue) {
        echo ($count++) . ':' . text_from_dependency($wp_styles->registered[$queue]) . '<br>';
    }
}

function text_from_dependency($obj)
{
    $result = '';
    foreach (['handle', 'src', 'deps', 'ver', 'args'] as $p) {

        $result .= ($result !== ''  ? ',' : '')
            . $p . ':'
            . (is_array($obj->$p) ? '[' . implode(",", $obj->$p) . ']' : $obj->$p);
    }
    if (isset($obj->extra['group'])) {
        $result .= ',group:' . $obj->extra['group'];
    }
    foreach (['before', 'after'] as $pos) {
        if (isset($obj->extra[$pos])) {
            $result .= '<div style="background:#f1f1f1;padding-left: 5px;">position:' . $pos . '<br>';
            $result .=  htmlspecialchars(implode($obj->extra[$pos]));
            $result .= '</div>';
        }
    }

    return $result;
}



/*------------------------------------------------------------
カスタム投稿のパーマリンク設定（買取実績：result）
------------------------------------------------------------*/
function custom_rewrite_rules()
{
    $area_terms = get_terms(array(
        'taxonomy' => 'area',
        'hide_empty' => false,
        'fields' => 'slugs'
    ));

    if (!is_wp_error($area_terms) && !empty($area_terms)) {
        foreach ($area_terms as $term_slug) {
            add_rewrite_rule('^shop/' . $term_slug . '/?$', 'index.php?area=' . $term_slug, 'top');
        }
    }
}
add_action('init', 'custom_rewrite_rules');

function custom_query_vars($vars)
{
    $vars[] = 'area'; // area タクソノミーのターム名を取得するためのクエリ変数
    return $vars;
}
add_filter('query_vars', 'custom_query_vars');


//リライトルールの追加
//★それぞれresultはカスタム投稿タイプ名、result_catはカスタムタクソノミー名を挿入

//↓カスタム投稿タイプの一覧ページ
add_rewrite_rule('result/page/([0-9]+)/?$', 'index.php?post_type=result&paged=$matches[1]', 'top');
//add_rewrite_rule('shop/page/([0-9]+)/?$', 'index.php?post_type=shop&paged=$matches[1]', 'top');

//↓親ターム一覧ページ
add_rewrite_rule('result/([^/]+)/?$', 'index.php?result_cat=$matches[1]', 'top');
add_rewrite_rule('result/([^/]+)/page/([0-9]+)/?$', 'index.php?result_cat=$matches[1]&paged=$matches[2]', 'top');
//add_rewrite_rule('shop/([^/]+)/?$', 'index.php?area=$matches[1]', 'top');
//add_rewrite_rule('shop/([^/]+)/page/([0-9]+)/?$', 'index.php?area=$matches[1]&paged=$matches[2]', 'top');

//↓親タームに属する記事ページ
add_rewrite_rule('result/([^/]+)/([0-9]+)/?$', 'index.php?post_type=result&p=$matches[2]', 'top');
//add_rewrite_rule('shop/([^/]+)/([0-9]+)/?$', 'index.php?post_type=shop&p=$matches[2]', 'top');
//add_rewrite_rule('shop/([^/]+)/?$', 'index.php?post_type=shop&name=$matches[1]', 'top');


//↓子ターム一覧ページ
add_rewrite_rule('result/([^/]+)/([^/]+)/?$', 'index.php?result_cat=$matches[2]', 'top');
add_rewrite_rule('result/([^/]+)/([^/]+)/page/([0-9]+)/?$', 'index.php?result_cat=$matches[1]&paged=$matches[2]', 'top');
//add_rewrite_rule('shop/([^/]+)/([^/]+)/page/([0-9]+)/?$', 'index.php?area=$matches[1]&paged=$matches[2]', 'top');
add_rewrite_rule('shop/([^/]+)/([^/]+)/?$', 'index.php?area=$matches[2]', 'top');


/*-----------------------------------------------------
タクソノミー未選択公開時にデフォルトで特定のタームを選択させる
-----------------------------------------------------*/
function add_defaulttaxonomy($post_ID)
{
    global $wpdb;
    //カスタム分類のタームを取得
    $curTerm = wp_get_object_terms($post_ID, 'result_cat'); //★カスタムタクソノミー名
    //ターム指定数が未設定の時に特定のタームを指定
    if (0 == count($curTerm)) {
        $defaultTerm = array(1); //★選択させたいタームID
        wp_set_object_terms($post_ID, $defaultTerm, 'result_cat'); //★カスタムタクソノミー名
    }
}
//カスタム投稿
add_action('publish_result', 'add_defaulttaxonomy'); //★publish_カスタム投稿タイプ名




/*------------------------------------------------------------
カスタム投稿（買取実績：result）にカテゴリでの絞り込み機能追加
------------------------------------------------------------*/
function add_post_taxonomy_restrict_filter()
{
    global $post_type;
    if ('result' == $post_type) {
?>
        <select name="result_cat">
            <option value="">カテゴリー一覧</option>
            <?php
            $terms = get_terms('result_cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
    <?php
    }
}
add_action('restrict_manage_posts', 'add_post_taxonomy_restrict_filter');
/**************************************************************
序列を昇順で数値優先表示のためのコード
 **************************************************************/
add_filter(
    'posts_orderby',
    function ($orderby_display, $query_display) {
        if ($query_display->get('custom_orderby')) {
            $orderby_display = 'wp_postmeta.meta_value+0 > 0 DESC, ' . $orderby_display;
        }
        return $orderby_display;
    },
    10,
    2
);
add_action(
    'pre_get_posts',
    function ($query_display) {
        if (is_admin() || !$query_display->is_main_query()) {
            return;
        }
    }
);

/*****************************************************************************
Window幅及びWordPress関数からデバイスタイプを返す関数
 *******************************************************************************/
function add_my_ajaxurl()
{
    ?>
    <script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}
add_action('wp_head', 'add_my_ajaxurl', 1);


function set_window_size()
{

    $path_name = THEME_URL . 'temp/window_size.txt';

    if (WP_Filesystem()) {
        echo "ok";
        global $wp_filesystem;
        $new_file_text = 'aaaaaaaa';
        $wp_filesystem->put_contents($path_name, $new_file_text);
    }


    // $_SESSION['windowsize'] = $_POST['windowsize'];
    // echo "ws = ".$_SESSION['windowsize'];
    // echo 'si = '.session_id();

    // die();

}
add_action('wp_ajax_set_window_size', 'set_window_size');
add_action('wp_ajax_nopriv_set_window_size', 'set_window_size');



/*------------------------------------------------------------
選択したカテゴリ（タブ）の買取実績を10件表示
------------------------------------------------------------*/
function purchase_achieve_brand_model_list($show_num, $cat_slug, $type = false)
{
    global $post;

    $path_name = THEME_URL . 'temp/window_size.txt';


    if (WP_Filesystem()) {

        echo "tttt";
        global $wp_filesystem;
        $sample_file = $wp_filesystem->get_contents($path_name);
    }

    echo $sample_file;

    $args = array(
        'posts_per_page' => $show_num,  //全件表示は−1
        'post_type'      => 'result',  // カスタム投稿タイプ名
        'meta_key' => 'display_order_field_key',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'custom_orderby' => true,
        'suppress_filters' => false,
        'tax_query'      => array(
            array(
                'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                'terms'    => $cat_slug  // 上で指定したタクソノミーに属するタームを指定
            )
        ),
    );

    $myposts = get_posts($args);
    $p_cnt = count($myposts);
    foreach ($myposts as $post) {
        setup_postdata($post);

        $model_img = get_field('img_path');
        $size = 'thumbnail';

    ?>
        <div class="content__item content_item_wrap align_items_stretch_parent">
            <a href="<?php the_permalink(); ?>" class="img__link">
                <div class="content_image_wrap">
                    <p class="content__image img">
                        <?php

                        $attr = get_the_title() . "の買取実績";
                        $default_attr = array(
                            'alt'   => $attr,
                        );
                        $icon = false;
                        echo wp_get_attachment_image($model_img, $size, $icon, $default_attr);
                        ?>
                    </p>
                    <p class="content--name">
                        <?php

                        if (is_category()) {
                            $cat_id = get_queried_object()->cat_ID;
                            $post_id = 'category_' . $cat_id;
                            $cat_name = get_field('tokei_category_name', $post_id);
                            if (empty($cat_name))
                                $cat_name = get_field('brand_ruby', $post_id);
                            $original_string = get_the_title();
                            $model_title = preg_replace('/^' . preg_quote($cat_name, '/') . '/', '', $original_string, 1);
                            echo $model_title;
                        } else {
                            echo get_the_title();
                        }

                        ?>
                    </p>

                </div>
            </a>
            <div class="content__text" style="margin-bottom: 1rem;">
                <p class="content--title" style="margin-top: 0rem;">買取実績</p>
                <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
            </div>
        </div>
        <style>
            .content__item.content_item_wrap {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            div:has(.align_items_stretch_parent) {
                align-items: stretch !important;
            }
        </style>


        <?php
    }

    if ($p_cnt < 4) {
        for ($i = 0; $i < 4 - $p_cnt; $i++) {
        ?>
            <li class="content__item">
                <p class="content__image img"></p>
                <div class="content__text">
                    <p class="content--name"></p>
                    <p class="content--title"></p>
                    <p class="content--price"></p>
                </div>
            </li>
        <?php
        }
    }

    wp_reset_postdata();
}


function purchase_achieve_brand_model_list_bar($show_num, $cat_slug, $cat_cnt)
{
    global $post;

    $args = array(
        'posts_per_page' => $show_num,  //全件表示は−1
        'post_type'      => 'result',  // カスタム投稿タイプ名
        'meta_key' => 'display_order_field_key',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'custom_orderby' => true,
        'suppress_filters' => false,
        'tax_query'      => array(
            array(
                'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                'terms'    => $cat_slug  // 上で指定したタクソノミーに属するタームを指定
            )
        ),
    );

    $myposts = get_posts($args);
    $p_cnt = count($myposts);

    if ($p_cnt > 4) {
        ?>
        <div class="flex--slide__pagenation">
            <div class="pagenation--arrows flex-slider<?php echo  $cat_cnt; ?>--arrow"></div>
            <div class="pagenation--dots flex-slider<?php echo  $cat_cnt; ?>--dot"></div>
        </div>
    <?php
    }

    wp_reset_postdata();
}


/*------------------------------------------------------------
買取実績のターム並び替え
------------------------------------------------------------*/
function taxonomy_orderby_description($orderby, $args)
{

    if ($args['orderby'] == 'description') {
        $orderby = 'tt.description';
    }
    return $orderby;
}
add_filter('get_terms_orderby', 'taxonomy_orderby_description', 10, 2);


/*------------------------------------------------------------
FAQ回答欄のPタグ自動挿入停止
------------------------------------------------------------*/
function the_field_without_wpautop($field_name)
{

    remove_filter('acf_the_content', 'wpautop');

    $acf_content = get_field($field_name);

    add_filter('acf_the_content', 'wpautop');

    return $acf_content;
}

/*------------------------------------------------------------
管理画面に外観メニューを表示
------------------------------------------------------------*/
add_action('after_setup_theme', 'register_menu');
function register_menu()
{
    register_nav_menu('primary', __('Primary Menu', 'theme-slug'));
}

/*------------------------------------------------------------
メニュー配置追加
------------------------------------------------------------*/
function register_my_menus()
{
    register_nav_menus(
        array(
            'sidemenu' => __('サイドメニュー'),
            'spmenu' => __('スマホメニュー'),
        )
    );
}
add_action('init', 'register_my_menus');


/*------------------------------------------------------------
サイドメニューカスタマイズ
------------------------------------------------------------*/
class custom_walker_side_nav_menu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '<div class="sideAcod__contentsNav" style="display: none;"><ul class="sideAcod__contentsNav--link">';
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '</ul></div>';
    }

    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        // Restores the more descriptive, specific name for use within this method.
        $menu_item = $data_object;

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }

        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes   = empty($menu_item->classes) ? array() : (array) $menu_item->classes;
        $classes[] = 'menu-item-' . $menu_item->ID;
        // echo "depth = ".$depth."<BR>";
        // echo "<pre>";
        // var_dump($classes);
        // echo "</pre><BR>";

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param WP_Post  $menu_item Menu item data object.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $args = apply_filters('nav_menu_item_args', $args, $menu_item, $depth);

        /**
         * Filters the CSS classes applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */

        if ($depth == 0) {
            if (in_array('menu-item-has-children', $classes)) {
                $custom_class = 'sideAcod__nav js-acod__nav';
            } else {
                $custom_class = 'btn__gy01--wrap';
            }
        } else {
            $custom_class = 'item';
        }

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' ' . $custom_class . '"' : '';

        /**
         * Filters the ID attribute applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string   $menu_item_id The ID attribute applied to the menu item's `<li>` element.
         * @param WP_Post  $menu_item    The current menu item.
         * @param stdClass $args         An object of wp_nav_menu() arguments.
         * @param int      $depth        Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        if ($depth == 0) {
            if (in_array('menu-item-has-children', $classes)) {
                $end_li = '</li>';
            } else {
                $end_li = '';
            }

            // if( $menu_item->ID == 19228 ){
            //  $end_li = '';
            // }else{
            //  $end_li = '</li>';
            // }
        }
        $output .= $end_li . $indent . '<li' . $id . $class_names . '>';

        $atts           = array();
        $atts['title']  = !empty($menu_item->attr_title) ? $menu_item->attr_title : '';
        $atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
        if ('_blank' === $menu_item->target && empty($menu_item->xfn)) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $menu_item->xfn;
        }
        $atts['href']         = !empty($menu_item->url) ? $menu_item->url : '';
        $atts['aria-current'] = $menu_item->current ? 'page' : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title        Title attribute.
         *     @type string $target       Target attribute.
         *     @type string $rel          The rel attribute.
         *     @type string $href         The href attribute.
         *     @type string $aria-current The aria-current attribute.
         * }
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $menu_item->title, $menu_item->ID);

        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string   $title     The menu item's title.
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);


        $item_output  = $args->before;

        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<div class="sideAcod__switchNav"><p>';
        } else {
            $item_output .= '<a' . $attributes . '>';
        }

        $item_output .= $args->link_before . $title . $args->link_after;

        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '</p></div>';
        } else {
            $item_output .= '</a>';
        }


        // if( $depth == 0 && $menu_item->ID != 19228){
        //  $item_output .= '<div class="sideAcod__switchNav"><p>';
        // }else{
        //  $item_output .= '<a' . $attributes . '>';
        // }

        //  $item_output .= $args->link_before . $title . $args->link_after;

        // if( $depth == 0 && $menu_item->ID != 19228){
        //  $item_output .= '</p></div>';
        // }else{
        //  $item_output .= '</a>';
        // }

        $item_output .= $args->after;

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string   $item_output The menu item's starting HTML output.
         * @param WP_Post  $menu_item   Menu item data object.
         * @param int      $depth       Depth of menu item. Used for padding.
         * @param stdClass $args        An object of wp_nav_menu() arguments.
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = null)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = "\t";
            $n = "\n";
        }
        if ($depth != 0) {
            $output .= "</li>{$n}";
        }
    }
}



/*------------------------------------------------------------
スマホメニューカスタマイズ
------------------------------------------------------------*/
class custom_walker_sp_nav_menu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '<div class="acod__contentsNav" style="display: none;"><ul class="acod__contentsNav--link">';
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '</ul></div>';
    }

    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        // Restores the more descriptive, specific name for use within this method.
        $menu_item = $data_object;

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }

        // echo "depth = ".$depth."<BR>";
        // echo "<pre>";
        // var_dump($menu_item);
        // echo "</pre><BR>";
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes   = empty($menu_item->classes) ? array() : (array) $menu_item->classes;
        $classes[] = 'menu-item-' . $menu_item->ID;

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param WP_Post  $menu_item Menu item data object.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $args = apply_filters('nav_menu_item_args', $args, $menu_item, $depth);

        /**
         * Filters the CSS classes applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */

        if ($depth == 0) {
            if (in_array('menu-item-has-children', $classes)) {
                $custom_class = 'acod__nav js-acod__nav';
            } else {
                $custom_class = 'btn__gy01--wrap';
            }
        } else {
            $custom_class = 'item';
        }

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' ' . $custom_class . '"' : '';

        /**
         * Filters the ID attribute applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string   $menu_item_id The ID attribute applied to the menu item's `<li>` element.
         * @param WP_Post  $menu_item    The current menu item.
         * @param stdClass $args         An object of wp_nav_menu() arguments.
         * @param int      $depth        Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        if ($depth == 0) {
            if (in_array('menu-item-has-children', $classes)) {
                $end_li = '</li>';
            } else {
                $end_li = '';
            }
        }
        $output .= $end_li . $indent . '<li' . $id . $class_names . '>';

        $atts           = array();
        $atts['title']  = !empty($menu_item->attr_title) ? $menu_item->attr_title : '';
        $atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
        if ('_blank' === $menu_item->target && empty($menu_item->xfn)) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $menu_item->xfn;
        }
        $atts['href']         = !empty($menu_item->url) ? $menu_item->url : '';
        $atts['aria-current'] = $menu_item->current ? 'page' : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title        Title attribute.
         *     @type string $target       Target attribute.
         *     @type string $rel          The rel attribute.
         *     @type string $href         The href attribute.
         *     @type string $aria-current The aria-current attribute.
         * }
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $menu_item->title, $menu_item->ID);

        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string   $title     The menu item's title.
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);


        $item_output  = $args->before;

        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<div class="acod__switchNav"><p>';
        } else {
            $item_output .= '<a' . $attributes . '>';
        }

        $item_output .= $args->link_before . $title . $args->link_after;

        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '</p></div>';
        } else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string   $item_output The menu item's starting HTML output.
         * @param WP_Post  $menu_item   Menu item data object.
         * @param int      $depth       Depth of menu item. Used for padding.
         * @param stdClass $args        An object of wp_nav_menu() arguments.
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = null)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = "\t";
            $n = "\n";
        }
        if ($depth != 0) {
            $output .= "</li>{$n}";
        }
    }
}


/*------------------------------------------------------------
投稿、カスタム投稿のエディター非表示
------------------------------------------------------------*/
add_action('init', function () {
    remove_post_type_support('post', 'editor');
    remove_post_type_support('result', 'editor');
    remove_post_type_support('shop', 'editor');
    remove_post_type_support('faq', 'editor');
}, 99);


/*------------------------------------------------------------
特定の固定ページのエディター非表示
------------------------------------------------------------*/
function disable_visual_editor_in_page()
{
    global $typenow;
    $post_id = $_GET['post'];
    if ($typenow == 'page') {
        if (in_array($post_id, array(
            '19025',  // CTA（パーツ編集用）
            '19001',  // おたからやが選ばれる理由（パーツ編集用）
            '19068',  // サイドメニュー（パーツ編集用）
            '19309',  // その他の買取商品ページ編集用
            '18897',  // トップページ編集用
            '19005',  // ページトップスライダー（パーツ編集用）
            '19083',  // よくある質問（パーツ編集用）
            '19398',  // 徳ある質問ページ編集用
            '19090',  // よく検索されるブランド一覧（パーツ編集用）
            '19002',  // 今が売り時の理由（パーツ編集用）
            '19221',  // 使ってないACF消せないのでいったんこちらに移動
            '19528',  // 店舗情報TOPページ編集用
            '19059',  // 店舗案内（パーツ編集用）
            '19003',  // 状態が悪いものでも買取（パーツ編集用）
            '18955',  // 買取に必要なもの（パーツ編集用）
            '18992',  // 買取実績（パーツ編集用）（カテゴリ４つ選択）
            '19527',  // 買取実績TOPページ編集用
            '19004',  // 高く買い取ってもらう方法（パーツ編集用）
            '19594',  // おたからやが高価買取できる理由（パーツ編集用）
            '19608',  // お客様の声（パーツ編集用）
            '19665',  // 買取可能な商品ページ編集用
        ), true)) {
            $hide_postdiv_css = '<style type="text/css">#postdiv, #postdivrich { display: none; }</style>';
            echo $hide_postdiv_css;
        }
    }
}
add_action('load-post.php', 'disable_visual_editor_in_page');
add_action('load-post-new.php', 'disable_visual_editor_in_page');

/*------------------------------------------------------------
カテゴリー追加ページの「説明欄」非表示
------------------------------------------------------------*/
function admin_style_cat_description()
{
    echo '
<style>
.term-description-wrap{
display:none;
}
</style>' . PHP_EOL;
}
add_action('admin_print_styles', 'admin_style_cat_description');


/*------------------------------------------------------------
カスタム投稿タイプ「voice」のアーカイブページの記事表示件数を変更する
------------------------------------------------------------*/
define('POSTS_PER_PAGE_NEWS', 10);
function change_posts_per_page($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->is_post_type_archive('voice')) {
        $query->set('posts_per_page', POSTS_PER_PAGE_NEWS);
    }
}
add_action('pre_get_posts', 'change_posts_per_page');


/*------------------------------------------------------------
ページネーション
------------------------------------------------------------*/
function pagination($pages = '', $range = 1)
{ //$rangeの値でカレントページの前後に出力されるページ範囲を設定
    $showitems = ($range * 2) + 1;
    // $showitems = $range+5;
    global $paged;
    if (empty($paged)) $paged = 1;
    //ここで全体のページ数を取得
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    //ページ総数が1じゃなければ
    if (1 != $pages) {
        echo "\t\t<div class=\"voicelist__pagenation\">\n";
        //1番最初のページに戻るボタン
        // if($paged > 2 && $paged > $range+1 && $showitems < $pages){
        if ($paged > 1) {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--prev arrow_double\"><a href=\"" . get_pagenum_link(1) . "\"></a></div>\n";
        } else {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--prev arrow_double\"><span></span></div>";
        }
        //1つ前のページへボタン
        // if($paged > 1 && $showitems < $pages){
        if ($paged > 1) {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--prev\"><a href=\"" . get_pagenum_link($paged - 1) . "\"></a></div>\n";
        } else {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--prev\"><span></span></div>";
        }
        //最後のページの時に２つ手前のページ出力
        if (3 < $pages && $paged == $pages) {
            $page2 = $pages - 2;
            echo "\t\t\t<div class=\"voicelist__pagenation--item\"><a href=\"" . get_pagenum_link($page2) . "\">" . $page2 . "</a></div>\n";
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo "\t\t\t<div class=\"voicelist__pagenation--item\">";
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span></div>\n" : "<a href=\"" . get_pagenum_link($i) . "\">" . $i . "</a></div>\n";
            }
        }
        //最初のページの時に３ページ目出力
        if (3 < $pages && $paged == 1) {
            echo "\t\t\t<div class=\"voicelist__pagenation--item\"><a href=\"" . get_pagenum_link(3) . "\">3</a></div>\n";
        }
        //1つ次のページへボタン
        // if ($paged < $pages && $showitems < $pages){
        if ($paged != $pages) {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--next\"><a href=\"" . get_pagenum_link($paged + 1) . "\"></a></div>\n";
        } else {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--next\"><span></span></div>";
        }
        //最後のページへ進むボタン
        // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
        if ($paged != $pages) {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--next arrow_double\"><a href=\"" . get_pagenum_link($pages) . "\"></a></div>\n";
        } else {
            echo "\t\t\t<div class=\"voicelist__pagenation--item voicelist__pagenation--next arrow_double\"><span></span></div>";
        }
        echo "\t\t</div>\n";
    }
}


/*------------------------------------------------------------
アーカイブページのタイトル
------------------------------------------------------------*/
function change_title($title)
{
    if (is_post_type_archive('result')) {
        $title = 'ブランド時計の買取実績・価格 | 時計買取専門店のおたからや';
    } elseif (is_post_type_archive('shop')) {
        $title = '店舗検索 | 買取専門店のおたからや';
    } elseif (is_post_type_archive('faq')) {
        $title = 'よくあるご質問 | 買取専門店のおたからや';
    } elseif (is_post_type_archive('voice')) {
        $title = 'おたからや 口コミ・お客様の声 | 買取専門店のおたからや';
    }
    return $title;
}
add_filter('wpseo_title', 'change_title');


/*------------------------------------------------------------
アーカイブページのディスクリプション
------------------------------------------------------------*/
function change_description($str)
{
    if (is_post_type_archive('result')) {
        $description = 'ブランド時計の買取実績・価格のページです。買取専門店のおたからや。最短5分で査定、出張費・送料無料です。金・プラチナ・貴金属・ダイヤモンド・ブランド品・時計・バッグ・切手・古銭・着物・鉄道模型など、他社圧倒の高額買取でいろいろ買います。';
    } elseif (is_post_type_archive('shop')) {
        $description = '買取専門店の「おたからや」 店舗検索ページです。ブランド品の買取、ブランドバッグ買取の買取強化中！代表的なルイヴィトンをはじめ、シャネル、エルメス、クロエ、グッチ、プラダの高級ブランドバッグ等を大歓迎しております。ブランド品に詳しい専門コンシェルジュが査定を行い高額提示しておりますので安心してご相談ください。';
    } elseif (is_post_type_archive('faq')) {
        $description = 'よくある質問のページです。買取専門店のおたからや。最短5分で査定、出張費・送料無料です。金・プラチナ・貴金属・ダイヤモンド・ブランド品・時計・バッグ・切手・古銭・着物・鉄道模型など、他社圧倒の高額買取でいろいろ買います。';
    } elseif (is_post_type_archive('voice')) {
        $description = '口コミ・お客様の声のページです。買取専門店のおたからや。最短5分で査定、出張費・送料無料です。金・プラチナ・貴金属・ダイヤモンド・ブランド品・時計・バッグ・切手・古銭・着物・鉄道模型など、他社圧倒の高額買取でいろいろ買います。';
    }
    return $description;
}
add_filter('wpseo_metadesc', 'change_description', 10, 1);


/*------------------------------------------------------------
管理バー表示
------------------------------------------------------------*/
// add_filter('show_admin_bar', 'set_adminbar');

// function set_adminbar($adminbar)
// {
//  $adminbar = true; /* true:表示 false:非表示 */
//  return $adminbar;
// }

/**********************
OGP設定
 *********************/
function my_meta_ogp()
{

    if (is_post_type_archive('result')) {
        $html = "\n";
        $html .= '<meta property="og:title" content="ブランド時計の買取実績・価格 | 時計買取専門店のおたからや">' . "\n";
        $html .= '<meta property="og:description" content="ブランド時計の買取実績・価格のページです。買取専門店のおたからや。最短5分で査定、出張費・送料無料です。金・プラチナ・貴金属・ダイヤモンド・ブランド品・時計・バッグ・切手・古銭・着物・鉄道模型など、他社圧倒の高額買取でいろいろ買います。">' . "\n";
    } elseif (is_post_type_archive('shop')) {
        $html = "\n";
        $html .= '<meta property="og:title" content="店舗検索 | 買取専門店のおたからや">' . "\n";
        $html .= '<meta property="og:description" content="買取専門店の「おたからや」 店舗検索ページです。ブランド品の買取、ブランドバッグ買取の買取強化中！代表的なルイヴィトンをはじめ、シャネル、エルメス、クロエ、グッチ、プラダの高級ブランドバッグ等を大歓迎しております。ブランド品に詳しい専門コンシェルジュが査定を行い高額提示しておりますので安心してご相談ください。">' . "\n";
    } elseif (is_post_type_archive('faq')) {
        $html = "\n";
        $html .= '<meta property="og:title" content="よくあるご質問 | 買取専門店のおたからや">' . "\n";
        $html .= '<meta property="og:description" content="よくある質問のページです。買取専門店のおたからや。最短5分で査定、出張費・送料無料です。金・プラチナ・貴金属・ダイヤモンド・ブランド品・時計・バッグ・切手・古銭・着物・鉄道模型など、他社圧倒の高額買取でいろいろ買います。">' . "\n";
    } elseif (is_post_type_archive('voice')) {
        $html = "\n";
        $html .= '<meta property="og:title" content="おたからや 口コミ・お客様の声 | 買取専門店のおたからや">' . "\n";
        $html .= '<meta property="og:description" content="口コミ・お客様の声のページです。買取専門店のおたからや。最短5分で査定、出張費・送料無料です。金・プラチナ・貴金属・ダイヤモンド・ブランド品・時計・バッグ・切手・古銭・着物・鉄道模型など、他社圧倒の高額買取でいろいろ買います。">' . "\n";
    }

    echo $html;
}
// headタグ内にOGPを出力する
add_action('wp_head', 'my_meta_ogp');

/*------------------------------------------------------------
Yoast Schemaの削除
------------------------------------------------------------*/
add_filter('wpseo_json_ld_output', '__return_false');

/*------------------------------------------------------------
oldのDBへ接続
------------------------------------------------------------*/
function old_db_connect($post_type)
{
    // echo "old<BR>";

    $ag_wpdb = new wpdb(DB_USER_HOLISTIC, DB_PASSWORD_HOLISTIC, DB_NAME_HOLISTIC, DB_HOST_HOLISTIC);
    $ag_wpdb->show_errors();

    //  if( $post_type == 'voice' ){
    // echo "voice<BR>";
    //      $post_list = voice_get_posts( $ag_wpdb );
    //  }elseif( $post_type == 'column' ){
    // echo "column<BR>";
    //      $post_list = column_get_posts( $ag_wpdb );
    //  }

    //     return $post_list;
    // }

    // function voice_get_posts( $ag_wpdb ) {
    // echo "function voice<BR>";

    // $table       = 'wp_corporate_posts';
    $post_status = 'publish';
    $post_type   = 'voice';
    // $query       = 'SELECT * FROM wp_corporate_posts WHERE post_status = "publish" AND post_type = "voice"';
    // $results     = $ag_wpdb->get_results( $wpdb->prepare( $query ) );


    $table_prefix = 'wp_corporate_'; //値を取りたいWordPressのテーブル接頭辞
    $ag_wpdb->set_prefix($table_prefix);

    //wp_option内のオプション名"sample"の値を取得したい場合
    $data = 'sample';
    $query = $ag_wpdb->prepare("SELECT * FROM {$ag_wpdb->posts} WHERE post_status = %s AND post_type = %s", $post_status, $post_type);
    // echo $query."<BR>";
    $results = $ag_wpdb->get_var($query);


    $post_list = array();
    foreach ($results as $post) {

        if (mb_strlen($post->post_content, 'UTF-8') > 200) {
            // echo "200 over<BR>";
            $content = str_replace('\n', '', mb_substr(strip_tags($post->post_content), 0, 200, 'UTF-8'));
            $content = $content . '･･･';
        } else {
            // echo "under <BR>";
            $content = str_replace('\n', '', strip_tags($post->post_content));
        }

        //
        $post_list[] = [
            'post_id'      => $post->ID,
            'title'        => $post->post_title,
            'date'         => date_i18n('Y.m.d', strtotime($post->post_date)),
            'content'      => $content,
        ];
    }


    return $post_list;
}



/*------------------------------------------------------------
ショップ情報（ajax対応）　ここから　　使わなくなった・・・
------------------------------------------------------------*/


// function my_enqueue() {
//   // 特定のページのみで読み込む(ここでは、スラッグ「sample-page」という固定ページにアクセスすると読み込まれる)
//   // if ( is_page( 'sample-page' ) ) {
//     // Ajaxの処理を書いたjsの読み込み
//     wp_enqueue_script( 'shop-ajax-script', get_template_directory_uri().'/assets/js/shop_search.js', array(), null, true );
//     // 「ad_url.ajax_url」のようにしてURLを指定できるようになる
//     wp_localize_script( 'shop-ajax-script', 'ad_url',array( 'ajax_url' => admin_url( 'admin-ajax.php') ) );
//   // }
// }
// add_action( 'wp_enqueue_scripts', 'my_enqueue' );


// /* Ajaxから取得したnonceを認証し、認証通過したらテンプレートを出力する */
// function view_search_results()
// {
//   // $nonce = $_REQUEST['nonce'];
//   // if (wp_verify_nonce($nonce, 'view_search_results')) {
//   //   get_template_part( '/template-parts/shop/shop_list');
//   // }

//     $post_type = "shop";
//     // $pref_terms = get_terms( 'area', ['parent' => 0, 'orderby' => 'id']);
//     $get_pref = $_GET['shop_pref'] ?? null;
//     $get_city = $_GET['shop_city'] ?? null;


//     if( !empty($get_city) ){
//       $search_term_slug = $get_city;
//     }else{
//       $search_term_slug = $get_pref;
//     }

//      $pref_term = get_term_by("slug", $get_pref, 'area');
//      $city_term = get_term_by("slug", $get_city, 'area');


//  $the_query = new WP_Query(array(
//    'post_status' => 'publish',
//    'post_type' => $post_type,
//    'tax_query' => array(
//      'relation' => 'AND',
//      array(
//        'taxonomy' => 'area',
//        'field' => 'slug',
//        'terms' => $search_term_slug,
//      )
//    ),
//    'posts_per_page' => -1,
//    'orderby' => 'id',
//    'order' => 'DESC',
//  ));

//  if ($the_query->have_posts()) {

//      $shop_html  = '<div class="titleMain titleMain--wrapper">';
//      $shop_html .= '  <h2 class="titleMain--main">';
//      $shop_html .= '    <span>' . $pref_term->name . '</span>';
//      $shop_html .= '  </h2>';
//      $shop_html .= '</div>';
//      $shop_html .= '<dl class="shopAcod__city js-acod01">';
//      $shop_html .= '  <dt class="acod__switch">' . $city_term->name . '</dt>';
//      $shop_html .= '  <dd class="acod__contents">';
//      $shop_html .= '    <ul>';

//    while ($the_query->have_posts()) :
//      $the_query->the_post();
//      $addrGrp = get_field('n_address');
//      if(have_rows('n_way_text_rf')):
//          while(have_rows('n_way_text_rf')): the_row();
//              $wat_txt = get_field( 'n_way_text_rf__contents' );
//          endwhile;
//      endif;

//      $shop_html .= '      <li>';
//      $shop_html .= '        <table>';
//      $shop_html .= '          <caption class="text--bold text--colorRed02">' . get_the_title() . '</caption>';
//      $shop_html .= '          <tr>';
//      $shop_html .= '            <th>住所/駅/徒歩</th>';
//      $shop_html .= '            <td><p>〒' . $addrGrp[ 'n_zip_a_text' ] . '　' . $addrGrp[ 'n_address_text' ] . '</p>';
//      $shop_html .= '              <p>' . $wat_txt . '</p></td>';
//      $shop_html .= '          </tr>';
//      $shop_html .= '          <tr>';
//      $shop_html .= '            <th>電話番号</th>';
//      $shop_html .= '            <td>' . get_field( 'n_tel1_text' ) . '</td>';
//      $shop_html .= '          </tr>';
//      $shop_html .= '          <tr>';
//      $shop_html .= '            <th>定休日</th>';
//      $shop_html .= '            <td>' . get_field( 'n_close_text' ) . '</td>';
//      $shop_html .= '          </tr>';
//      $shop_html .= '          <tr>';
//      $shop_html .= '            <th>営業時間</th>';
//      $shop_html .= '            <td>' . get_field( 'n_open_text' ) . '</td>';
//      $shop_html .= '          </tr>';
//      $shop_html .= '        </table>';
//      $shop_html .= '        <div class="shopAcod--btn">';
//      $shop_html .= '          <div class="btn__wrap btn__red">';
//      $shop_html .= '            <a href=' . get_permalink() . '>詳細を見る</a>';
//      $shop_html .= '          </div>';
//      $shop_html .= '        </div>';
//      $shop_html .= '      </li>';

//    endwhile;

//      $shop_html .= '    </ul>';
//      $shop_html .= '  </dd>';
//      $shop_html .= '</dl>';

//    echo $shop_html;
//  } else {
//    echo 'ありません！！。';
//  }

//  // header("Content-type: application/json; charset=UTF-8");
//  // echo json_encode($shop_html);

//      wp_die();
// }

// add_action('wp_ajax_my_action', 'view_search_results'); //第一引数は wp_ajax_{ファンクション名} にする
// add_action('wp_ajax_nopriv_my_action', 'view_search_results'); //第一引数は wp_ajax_nopriv_{ファンクション名} にする

/*------------------------------------------------------------
ショップ情報（ajax対応）　ここまで
------------------------------------------------------------*/






/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
     * If you're building a theme based on Twenty Seventeen, use a find and replace
     * to change 'twentyseventeen' to the name of your theme in all the template files.
     */
    load_theme_textdomain('twentyseventeen');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enables custom line height for blocks
     */
    add_theme_support('custom-line-height');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_image_size('twentyseventeen-featured-image', 2000, 1200, true);

    add_image_size('twentyseventeen-thumbnail-avatar', 100, 100, true);

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'top'    => __('Top Menu', 'twentyseventeen'),
            'social' => __('Social Links Menu', 'twentyseventeen'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        )
    );

    /*
     * Enable support for Post Formats.
     *
     * See: https://wordpress.org/support/article/post-formats/
     */
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        )
    );

    // Add theme support for Custom Logo.
    add_theme_support(
        'custom-logo',
        array(
            'width'      => 250,
            'height'     => 250,
            'flex-width' => true,
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
      */
    add_editor_style(array('assets/css/editor-style.css', twentyseventeen_fonts_url()));

    // Load regular editor styles into the new block-based editor.
    add_theme_support('editor-styles');

    // Load default block styles.
    add_theme_support('wp-block-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'widgets'     => array(
            // Place three core-defined widgets in the sidebar area.
            'sidebar-1' => array(
                'text_business_info',
                'search',
                'text_about',
            ),

            // Add the core-defined business info widget to the footer 1 area.
            'sidebar-2' => array(
                'text_business_info',
            ),

            // Put two core-defined widgets in the footer 2 area.
            'sidebar-3' => array(
                'text_about',
                'search',
            ),
        ),

        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts'       => array(
            'home',
            'about'            => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'contact'          => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'blog'             => array(
                'thumbnail' => '{{image-coffee}}',
            ),
            'homepage-section' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
        ),

        // Create the custom image attachments used as post thumbnails for pages.
        'attachments' => array(
            'image-espresso' => array(
                'post_title' => _x('Espresso', 'Theme starter content', 'twentyseventeen'),
                'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
            ),
            'image-sandwich' => array(
                'post_title' => _x('Sandwich', 'Theme starter content', 'twentyseventeen'),
                'file'       => 'assets/images/sandwich.jpg',
            ),
            'image-coffee'   => array(
                'post_title' => _x('Coffee', 'Theme starter content', 'twentyseventeen'),
                'file'       => 'assets/images/coffee.jpg',
            ),
        ),

        // Default to a static front page and assign the front and posts pages.
        'options'     => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),

        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods'  => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{contact}}',
        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus'   => array(
            // Assign a menu to the "top" location.
            'top'    => array(
                'name'  => __('Top Menu', 'twentyseventeen'),
                'items' => array(
                    'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),

            // Assign a menu to the "social" location.
            'social' => array(
                'name'  => __('Social Links Menu', 'twentyseventeen'),
                'items' => array(
                    'link_yelp',
                    'link_facebook',
                    'link_twitter',
                    'link_instagram',
                    'link_email',
                ),
            ),
        ),
    );

    /**
     * Filters Twenty Seventeen array of starter content.
     *
     * @since Twenty Seventeen 1.1
     *
     * @param array $starter_content Array of starter content.
     */
    $starter_content = apply_filters('twentyseventeen_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}
add_action('after_setup_theme', 'twentyseventeen_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width()
{

    $content_width = $GLOBALS['content_width'];

    // Get layout.
    $page_layout = get_theme_mod('page_layout');

    // Check if layout is one column.
    if ('one-column' === $page_layout) {
        if (twentyseventeen_is_frontpage()) {
            $content_width = 644;
        } elseif (is_page()) {
            $content_width = 740;
        }
    }

    // Check if is single post and there is no sidebar.
    if (is_single() && !is_active_sidebar('sidebar-1')) {
        $content_width = 740;
    }

    /**
     * Filters Twenty Seventeen content width of the theme.
     *
     * @since Twenty Seventeen 1.0
     *
     * @param int $content_width Content width in pixels.
     */
    $GLOBALS['content_width'] = apply_filters('twentyseventeen_content_width', $content_width);
}
add_action('template_redirect', 'twentyseventeen_content_width', 0);

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url()
{
    $fonts_url = '';

    /*
     * translators: If there are characters in your language that are not supported
     * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
     */
    $libre_franklin = _x('on', 'Libre Franklin font: on or off', 'twentyseventeen');

    if ('off' !== $libre_franklin) {
        $font_families = array();

        $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family'  => urlencode(implode('|', $font_families)),
            'subset'  => urlencode('latin,latin-ext'),
            'display' => urlencode('fallback'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyseventeen_resource_hints($urls, $relation_type)
{
    if (wp_style_is('twentyseventeen-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Blog Sidebar', 'twentyseventeen'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer 1', 'twentyseventeen'),
            'id'            => 'sidebar-2',
            'description'   => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer 2', 'twentyseventeen'),
            'id'            => 'sidebar-3',
            'description'   => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'twentyseventeen_widgets_init');

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more($link)
{
    if (is_admin()) {
        return $link;
    }

    $link = sprintf(
        '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Post title. Only visible to screen readers. */
        sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title(get_the_ID()))
    );
    return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'twentyseventeen_excerpt_more');

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'twentyseventeen_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'twentyseventeen_pingback_header');

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap()
{
    if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
        return;
    }

    require_once get_parent_theme_file_path('/inc/color-patterns.php');
    $hue = absint(get_theme_mod('colorscheme_hue', 250));

    $customize_preview_data_hue = '';
    if (is_customize_preview()) {
        $customize_preview_data_hue = 'data-hue="' . $hue . '"';
    }
    ?>
    <style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
        <?php echo twentyseventeen_custom_colors_css(); ?>
    </style>
<?php
}
add_action('wp_head', 'twentyseventeen_colors_css_wrap');

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts()
{
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);

    // Theme stylesheet.
    wp_enqueue_style('twentyseventeen-style', get_stylesheet_uri(), array(), '20221101');

    // Theme block stylesheet.
    wp_enqueue_style('twentyseventeen-block-style', get_theme_file_uri('/assets/css/blocks.css'), array('twentyseventeen-style'), '20220912');

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('twentyseventeen-style'), '20191025');
    }

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-ie9', get_theme_file_uri('/assets/css/ie9.css'), array('twentyseventeen-style'), '20161202');
        wp_style_add_data('twentyseventeen-ie9', 'conditional', 'IE 9');
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('twentyseventeen-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('twentyseventeen-style'), '20161202');
    wp_style_add_data('twentyseventeen-ie8', 'conditional', 'lt IE 9');

    // Load the html5 shiv.
    wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '20161020');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    wp_enqueue_script('twentyseventeen-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '20161114', true);

    $twentyseventeen_l10n = array(
        'quote' => twentyseventeen_get_svg(array('icon' => 'quote-right')),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('twentyseventeen-navigation', get_theme_file_uri('/assets/js/navigation.js'), array('jquery'), '20210122', true);
        $twentyseventeen_l10n['expand']   = __('Expand child menu', 'twentyseventeen');
        $twentyseventeen_l10n['collapse'] = __('Collapse child menu', 'twentyseventeen');
        $twentyseventeen_l10n['icon']     = twentyseventeen_get_svg(
            array(
                'icon'     => 'angle-down',
                'fallback' => true,
            )
        );
    }

    wp_enqueue_script('twentyseventeen-global', get_theme_file_uri('/assets/js/global.js'), array('jquery'), '20211130', true);

    wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.3', true);

    wp_localize_script('twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'twentyseventeen_scripts');

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles()
{
    // Block styles.
    wp_enqueue_style('twentyseventeen-block-editor-style', get_theme_file_uri('/assets/css/editor-blocks.css'), array(), '20220912');
    // Add custom fonts.
    wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);
}
add_action('enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles');

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr($sizes, $size)
{
    $width = $size[0];

    if (740 <= $width) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }

    if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
        if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }

    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2);

/**
 * Filters the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag($html, $header, $attr)
{
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}
add_filter('get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string[]     $attr       Array of attribute values for the image markup, keyed by attribute name.
 *                                 See wp_get_attachment_image().
 * @param WP_Post      $attachment Image attachment post.
 * @param string|int[] $size       Requested image size. Can be any registered image size name, or
 *                                 an array of width and height values in pixels (in that order).
 * @return string[] The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
    if (is_archive() || is_search() || is_home()) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 * @return string The template to be used: blank if is_home() is true (defaults to index.php),
 *                otherwise $template.
 */
function twentyseventeen_front_page_template($template)
{
    return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'twentyseventeen_front_page_template');

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args($args)
{
    $args['largest']  = 1;
    $args['smallest'] = 1;
    $args['unit']     = 'em';
    $args['format']   = 'list';

    return $args;
}
add_filter('widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args');

/**
 * Gets unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id($prefix = '')
{
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string) ++$id_counter;
}

if (!function_exists('wp_get_list_item_separator')) :
    /**
     * Retrieves the list item separator based on the locale.
     *
     * Added for backward compatibility to support pre-6.0.0 WordPress versions.
     *
     * @since 6.0.0
     */
    function wp_get_list_item_separator()
    {
        /* translators: Used between list items, there is a space after the comma. */
        return __(', ', 'twentyseventeen');
    }
endif;

/**************************************************************
カテゴリ追加・変更ページにカスタムフィールド追加
 **************************************************************/
// function category_form_fields_function($tag){

//  $cat_id = $tag->term_id;
//  $meta = get_term_meta($cat_id);

//  echo '<tr class="form-field"><th><label for="extra_text">グループ</label></th><td><input type="text" name="category_group" id="category_group" size="25" value="'.esc_html($meta['category_group'][0]).'" /></td></tr>';

// };

// add_action('category_add_form_fields','category_form_fields_function');
// add_action('category_edit_form_fields','category_form_fields_function');

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';

/**************************************************************
よくある質問のJSON-LD
 **************************************************************/

function get_faq_json_ld()
{
    $kind_name = '';
    if (is_category()) {
        $kind_name = str_replace('買取', '', get_queried_object()->name);
    } elseif (is_singular('shop')) {
        $kind_name = 'ブランド時計';
    } elseif (is_home() || is_front_page()) {
        $kind_name = 'ブランド時計';
    } else {
        $kind_name = str_replace('買取', '', get_the_title());
    }

    if (empty($kind_name)) {
        $kind_name = 'ブランド時計';
    }
    if (is_home() || is_front_page()) :
        $target_term = 'page-top';
    elseif (is_category()) :
        $target_term = 'page-brand';
    elseif (is_singular('post')) :
        $target_term = 'page-model';
    elseif (is_singular('shop')) :
        $target_term = 'page-shop';
    endif;
    $args = array(
        'post_type' => 'faq',
        'posts_per_page' => 10,
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'view_cat',
                'terms' => array($target_term),
                'field' => 'slug'
            ),
        ),
    );

    $faq_query = new WP_Query($args);
    $mainEntity = array();

    if ($faq_query->have_posts()) {
        while ($faq_query->have_posts()) {
            $faq_query->the_post();

            $title = str_replace('[kind-name]', $kind_name, get_the_title());
            $faq_answer = str_replace('[kind-name]', $kind_name, the_field_without_wpautop('faq_answer', get_the_ID()));

            $mainEntity[] = array(
                '@type' => 'Question',
                'name' => $title,
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => $faq_answer
                )
            );
        }
    }

    wp_reset_postdata();

    $json_ld = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $mainEntity
    );
    return '<script type="application/ld+json">' . json_encode($json_ld, JSON_UNESCAPED_UNICODE) . '</script>';
}


//favicon指定
add_filter('get_site_icon_url', 'my_site_icon_url');

function my_site_icon_url($url)
{
    return get_theme_file_uri('/assets/img/common/fav_512x512.png');
}

function custom_rewrite_rule($rules)
{
    $new_rules = array(
        '^shop/hokkaido/ohmagari/iv-oomagari/?$' => 'index.php?pagename= shop/iv-oomagari/',
        '^shop/aomori/hachinoheshi/iy-hachinohenumadate/?$' => 'index.php?pagename= shop/iy-hachinohenumadate/',
        '^shop/aomori/hirosakishi/iy-hirosaki/?$' => 'index.php?pagename= shop/iy-hirosaki/',
        '^shop/aomori/aomorishi/aomori-honten/?$' => 'index.php?pagename= shop/aomori-honten/',
        '^shop/iwate/hanamaki/iy-hanamaki/?$' => 'index.php?pagename= shop/iy-hanamaki/',
        '^shop/miyagi/sendai/ario-sendaiizumi/?$' => 'index.php?pagename= shop/ario-sendaiizumi/',
        '^shop/miyagi/shibata-miyagi/aeon-funaoka/?$' => 'index.php?pagename= shop/aeon-funaoka/',
        '^shop/tochigi/utsunomiyashi/tonarie-utsunomiya/?$' => 'index.php?pagename= shop/tonarie-utsunomiya/',
        '^shop/gumma/maebashishi/maebashiminamicho/?$' => 'index.php?pagename= shop/maebashiminamicho/',
        '^shop/gumma/isesakishi/donki-isesakihigashi/?$' => 'index.php?pagename= shop/donki-isesakihigashi/',
        '^shop/saitama/kumagayasi/kumagaya-nittohmall/?$' => 'index.php?pagename= shop/kumagaya-nittohmall/',
        '^shop/saitama/kumagayasi/kumagaya/?$' => 'index.php?pagename= shop/kumagaya/',
        '^shop/saitama/tokorozawasi/tokorozawa-honten/?$' => 'index.php?pagename= shop/tokorozawa-honten/',
        '^shop/saitama/tokorozawasi/tokorozawa/?$' => 'index.php?pagename= shop/tokorozawa/',
        '^shop/saitama/kawaguchisi/cupora-kawaguchi/?$' => 'index.php?pagename= shop/cupora-kawaguchi/',
        '^shop/saitama/kawaguchisi/miel-kawaguchi/?$' => 'index.php?pagename= shop/miel-kawaguchi/',
        '^shop/saitama/koshigayashi/koshigaya/?$' => 'index.php?pagename= shop/koshigaya/',
        '^shop/saitama/soukashi/soka-akos/?$' => 'index.php?pagename= shop/soka-akos/',
        '^shop/saitama/kukishi/iy-kuki/?$' => 'index.php?pagename= shop/iy-kuki/',
        '^shop/saitama/saitamashi/urawa-nishi/?$' => 'index.php?pagename= shop/urawa-nishi/',
        '^shop/saitama/saitamashi/patria-higashiomiya/?$' => 'index.php?pagename= shop/patria-higashiomiya/',
        '^shop/saitama/saitamashi/omiya-honten/?$' => 'index.php?pagename= shop/omiya-honten/',
        '^shop/saitama/saitamashi/seiyu-yono/?$' => 'index.php?pagename= shop/seiyu-yono/',
        '^shop/saitama/kawagoeshi/kawagoecm/?$' => 'index.php?pagename= shop/kawagoecm/',
        '^shop/saitama/irumagunn/aeon-moroyama/?$' => 'index.php?pagename= shop/aeon-moroyama/',
        '^shop/saitama/ageoshi/ageo-sp/?$' => 'index.php?pagename= shop/ageo-sp/',
        '^shop/chiba/ichikawashi/motoyawata-minamiguchi/?$' => 'index.php?pagename= shop/motoyawata-minamiguchi/',
        '^shop/chiba/narashinoshi/iy-tsudanuma/?$' => 'index.php?pagename= shop/iy-tsudanuma/',
        '^shop/chiba/matsudoshi/picotee-kitakogane/?$' => 'index.php?pagename= shop/picotee-kitakogane/',
        '^shop/chiba/matsudoshi/matsudo-nishiguchi/?$' => 'index.php?pagename= shop/matsudo-nishiguchi/',
        '^shop/chiba/funabashishi/nishifunabashi/?$' => 'index.php?pagename= shop/nishifunabashi/',
        '^shop/chiba/ichiharashi/goi/?$' => 'index.php?pagename= shop/goi/',
        '^shop/chiba/kashiwashi/kashiwa-modi/?$' => 'index.php?pagename= shop/kashiwa-modi/',
        '^shop/chiba/nagareyamashi/cotoe-nagareyama/?$' => 'index.php?pagename= shop/chiba/cotoe-nagareyama/',
        '^shop/chiba/chibashi/chiba-higashiguchi/?$' => 'index.php?pagename= shop/chiba-higashiguchi/',
        '^shop/chiba/chibashi/iy-makuhari/?$' => 'index.php?pagename= shop/iy-makuhari/',
        '^shop/tokyo/adachiku/kitasenju-nishiguchi/?$' => 'index.php?pagename= shop/kitasenju-nishiguchi/',
        '^shop/tokyo/adachiku/iy-ayase/?$' => 'index.php?pagename= shop/iy-ayase/',
        '^shop/tokyo/adachiku/kitasenju-higashiguchi/?$' => 'index.php?pagename= shop/kitasenju-higashiguchi/',
        '^shop/tokyo/musashinosi/kichijoji-honten/?$' => 'index.php?pagename= shop/kichijoji-honten/',
        '^shop/tokyo/musashinosi/iy-musashisakai/?$' => 'index.php?pagename= shop/iy-musashisakai/',
        '^shop/tokyo/musashinosi/kichijoji/?$' => 'index.php?pagename= shop/kichijoji/',
        '^shop/tokyo/tyuuouku/ginza-honten/?$' => 'index.php?pagename= shop/ginza-honten/',
        '^shop/tokyo/tyuuouku/ginza/?$' => 'index.php?pagename= shop/ginza/',
        '^shop/tokyo/sinjyukuku/shinjuku-higashiguchi/?$' => 'index.php?pagename= shop/shinjuku-higashiguchi/',
        '^shop/tokyo/sinjyukuku/shinjuku-honten/?$' => 'index.php?pagename= shop/shinjuku-honten/',
        '^shop/tokyo/sinjyukuku/shinjuku-nishiguchi/?$' => 'index.php?pagename= shop/shinjuku-nishiguchi/',
        '^shop/tokyo/toshimaku/ikebukuro-sunshine/?$' => 'index.php?pagename= shop/ikebukuro-sunshine/',
        '^shop/tokyo/toshimaku/sugamo-honten/?$' => 'index.php?pagename= shop/sugamo-honten/',
        '^shop/tokyo/toshimaku/ikebukuro-kitaguchi/?$' => 'index.php?pagename= shop/ikebukuro-kitaguchi/',
        '^shop/tokyo/machidashi/machida-tsurukawa/?$' => 'index.php?pagename= shop/machida-tsurukawa/',
        '^shop/tokyo/machidashi/mm-machidatamasakai/?$' => 'index.php?pagename= shop/mm-machidatamasakai/',
        '^shop/tokyo/shinagawaku/meguro-nishi/?$' => 'index.php?pagename= shop/meguro-nishi/',
        '^shop/tokyo/shinagawaku/pc-musashikoyama/?$' => 'index.php?pagename= shop/pc-musashikoyama/',
        '^shop/tokyo/nakanoku/nakano-honten/?$' => 'index.php?pagename= shop/nakano-honten/',
        '^shop/tokyo/nakanoku/nakano-marui/?$' => 'index.php?pagename= shop/nakano-marui/',
        '^shop/tokyo/shibuyaku/shibuya-honten/?$' => 'index.php?pagename= shop/shibuya-honten/',
        '^shop/tokyo/suginamiku/nishiogikubo/?$' => 'index.php?pagename= shop/nishiogikubo/',
        '^shop/tokyo/suginamiku/hamadayama/?$' => 'index.php?pagename= shop/hamadayama/',
        '^shop/tokyo/ootaku/kamata-nishiguchi/?$' => 'index.php?pagename= shop/kamata-nishiguchi/',
        '^shop/tokyo/ootaku/oomori/?$' => 'index.php?pagename= shop/oomori/',
        '^shop/tokyo/ootaku/maruetsu-shinkojiya/?$' => 'index.php?pagename= shop/maruetsu-shinkojiya/',
        '^shop/tokyo/tachikawashi/tachikawa-kitaguchi/?$' => 'index.php?pagename= shop/tachikawa-kitaguchi/',
        '^shop/tokyo/setagayaku/seijogakuenmae/?$' => 'index.php?pagename= shop/seijogakuenmae/',
        '^shop/tokyo/setagayaku/sangenjaya/?$' => 'index.php?pagename= shop/sangenjaya/',
        '^shop/tokyo/katsushikaku/kanamachi/?$' => 'index.php?pagename= shop/kanamachi/',
        '^shop/tokyo/taitouku/asakusa-honten/?$' => 'index.php?pagename= shop/asakusa-honten/',
        '^shop/tokyo/taitouku/ueno-honten/?$' => 'index.php?pagename= shop/ueno-honten/',
        '^shop/tokyo/higashimurayamashi/iy-higashimurayama/?$' => 'index.php?pagename= shop/iy-higashimurayama/',
        '^shop/tokyo/koganeishi/iy-musashikoganei/?$' => 'index.php?pagename= shop/iy-musashikoganei/',
        '^shop/tokyo/hinoshi/seiyu-toyoda/?$' => 'index.php?pagename= shop/seiyu-toyoda/',
        '^shop/tokyo/meguroku/jiyugaoka/?$' => 'index.php?pagename= shop/jiyugaoka/',
        '^shop/tokyo/hachioujishi/hachioji-kitaguchi/?$' => 'index.php?pagename= shop/hachioji-kitaguchi/',
        '^shop/tokyo/tamashi/iy-tamacenter/?$' => 'index.php?pagename= shop/iy-tamacenter/',
        '^shop/tokyo/nishitokyoshi/hanakoganei/?$' => 'index.php?pagename= shop/hanakoganei/',
        '^shop/tokyo/nishitokyoshi/seiyu-hibarigaoka/?$' => 'index.php?pagename= shop/seiyu-hibarigaoka/',
        '^shop/tokyo/mitakashi/mitaka-minami/?$' => 'index.php?pagename= shop/mitaka-minami/',
        '^shop/kanagawa/yokosukashi/yokosukachuo/?$' => 'index.php?pagename= shop/yokosukachuo/',
        '^shop/kanagawa/yokosukashi/kinugasasakaecho/?$' => 'index.php?pagename= shop/kinugasasakaecho/',
        '^shop/kanagawa/sagamiharashi/sagamihara/?$' => 'index.php?pagename= shop/sagamihara/',
        '^shop/kanagawa/sagamiharashi/iy-kobuchi/?$' => 'index.php?pagename= shop/iy-kobuchi/',
        '^shop/kanagawa/fujisawashi/fujisawa/?$' => 'index.php?pagename= shop/fujisawa/',
        '^shop/kanagawa/hiratsukashi/hiratsuka-kitaguchi/?$' => 'index.php?pagename= shop/hiratsuka-kitaguchi/',
        '^shop/kanagawa/yamatoshi/yamato/?$' => 'index.php?pagename= shop/yamato/',
        '^shop/kanagawa/kawasakishi/at-mukougaokayuen/?$' => 'index.php?pagename= shop/at-mukougaokayuen/',
        '^shop/kanagawa/yokohamashi-nishiku/yokohama-nishiguchi/?$' => 'index.php?pagename= shop/yokohama-nishiguchi/',
        '^shop/kanagawa/yokohamashi-nishiku/yokohama-ekimae/?$' => 'index.php?pagename= shop/yokohama-ekimae/',
        '^shop/kanagawa/yokohamashi-nishiku/yokohama-honten/?$' => 'index.php?pagename= shop/yokohama-honten/',
        '^shop/kanagawa/yokohamashi-konanku/kamiooka/?$' => 'index.php?pagename= shop/kamiooka/',
        '^shop/kanagawa/yokohamashi-kanagawaku/donki-ooguchi/?$' => 'index.php?pagename= shop/donki-ooguchi/',
        '^shop/kanagawa/yokohamashi-midoriku/nakayama-minamiguchi/?$' => 'index.php?pagename= shop/nakayama-minamiguchi/',
        '^shop/kanagawa/yokohamashi-izumiku/tateba/?$' => 'index.php?pagename= shop/tateba/',
        '^shop/kanagawa/yokohamashi-asahiku/donki-hutamatagawa/?$' => 'index.php?pagename= shop/donki-hutamatagawa/',
        '^shop/kanagawa/yokohamashi-asahiku/tsurugamine/?$' => 'index.php?pagename= shop/tsurugamine/',
        '^shop/kanagawa/yokohamashi-seyaku/maruetsu-seya/?$' => 'index.php?pagename= shop/maruetsu-seya/',
        '^shop/kanagawa/yokohamashi-seyaku/aeon-mitsukyo/?$' => 'index.php?pagename= shop/aeon-mitsukyo/',
        '^shop/kanagawa/yokohamashi-nakaku/iseichi/?$' => 'index.php?pagename= shop/iseichi/',
        '^shop/kanagawa/atsugi/honatsugi-honten/?$' => 'index.php?pagename= shop/honatsugi-honten/',
        '^shop/niigata/niigata-shi/iy-marudainiigata/?$' => 'index.php?pagename= shop/iy-marudainiigata/',
        '^shop/ishikawa/kanazawasi/apita-kanazawabay/?$' => 'index.php?pagename= shop/apita-kanazawabay/',
        '^shop/ishikawa/kanazawasi/donki-kanazawa/?$' => 'index.php?pagename= shop/donki-kanazawa/',
        '^shop/nagano/matsumotoshi/aeon-matsumotomurai/?$' => 'index.php?pagename= shop/aeon-matsumotomurai/',
        '^shop/nagano/matsumotoshi/iy-minamimatsumoto/?$' => 'index.php?pagename= shop/iy-minamimatsumoto/',
        '^shop/nagano/matsumotoshi/seiyu-sasabe/?$' => 'index.php?pagename= shop/seiyu-sasabe/',
        '^shop/shizuoka/sizuokasi/shizuoka-oohashinishi/?$' => 'index.php?pagename= shop/shizuoka-oohashinishi/',
        '^shop/shizuoka/sizuokasi/shizuoka-honten/?$' => 'index.php?pagename= shop/shizuoka-honten/',
        '^shop/shizuoka/iwatashi/aeon-iwata/?$' => 'index.php?pagename= shop/aeon-iwata/',
        '^shop/shizuoka/kosaishi/aeon-kosaiarai/?$' => 'index.php?pagename= shop/aeon-kosaiarai/',
        '^shop/shizuoka/hujishi/seiyu-fujiimaizumi/?$' => 'index.php?pagename= shop/seiyu-fujiimaizumi/',
        '^shop/aichi/okazakishi/aeon-okazakimiai/?$' => 'index.php?pagename= shop/aeon-okazakimiai/',
        '^shop/aichi/kariyashi/donki-kariya/?$' => 'index.php?pagename= shop/donki-kariya/',
        '^shop/aichi/nagoyashi/osubanshoji/?$' => 'index.php?pagename= shop/osubanshoji/',
        '^shop/aichi/nagoyashi/fujigaoka/?$' => 'index.php?pagename= shop/fujigaoka/',
        '^shop/aichi/nagoyashi/nanyo/?$' => 'index.php?pagename= shop/nanyo/',
        '^shop/mie/yokkaitishi/kanesue-hinaga/?$' => 'index.php?pagename= shop/kanesue-hinaga/',
        '^shop/kyoto/kyoutoshi/fushimi-momoyama/?$' => 'index.php?pagename= shop/fushimi-momoyama/',
        '^shop/kyoto/kyoutoshi/shijokawaramachi/?$' => 'index.php?pagename= shop/shijokawaramachi/',
        '^shop/kyoto/kyoutoshi/saiinekimae/?$' => 'index.php?pagename= shop/saiinekimae/',
        '^shop/kyoto/kyoutoshi/shijokarasuma/?$' => 'index.php?pagename= shop/shijokarasuma/',
        '^shop/osaka/oosakasi/awaji/?$' => 'index.php?pagename= shop/awaji/',
        '^shop/osaka/sakaishi/iy-tsukuno/?$' => 'index.php?pagename= shop/iy-tsukuno/',
        '^shop/osaka/oosakashi-kitaku/tenjinbashi5/?$' => 'index.php?pagename= shop/tenjinbashi5/',
        '^shop/osaka/oosakashi-chuouku/shinsaibashi/?$' => 'index.php?pagename= shop/shinsaibashi/',
        '^shop/osaka/oosakashi-chuouku/morinomiya/?$' => 'index.php?pagename= shop/morinomiya/',
        '^shop/osaka/oosakashi-chuouku/namba-honten/?$' => 'index.php?pagename= shop/namba-honten/',
        '^shop/hyogo/koubeshi/kobe-okamoto/?$' => 'index.php?pagename= shop/kobe-okamoto/',
        '^shop/hyogo/koubeshi/kobemoto5/?$' => 'index.php?pagename= shop/kobemoto5/',
        '^shop/hyogo/koubeshi/tarumi-nishi/?$' => 'index.php?pagename= shop/tarumi-nishi/',
        '^shop/hyogo/koubeshi/sannomiya-center/?$' => 'index.php?pagename= shop/sannomiya-center/',
        '^shop/hyogo/himejishi/himeji-honten/?$' => 'index.php?pagename= shop/himeji-honten/',
        '^shop/hyogo/akashishi/iy-akashi/?$' => 'index.php?pagename= shop/iy-akashi/',
        '^shop/hyogo/sandashi/km-sanda/?$' => 'index.php?pagename= shop/km-sanda/',
        '^shop/nara/kashibashi/aeon-kashiba/?$' => 'index.php?pagename= shop/aeon-kashiba/',
        '^shop/shimane/matsueshi/aeon-matsue/?$' => 'index.php?pagename= shop/aeon-matsue/',
        '^shop/okayama/soujyashi/lfsojaminami/?$' => 'index.php?pagename= shop/lfsojaminami/',
        '^shop/yamaguchi/kudamatsushi/hoshi-plaza/?$' => 'index.php?pagename= shop/hoshi-plaza/',
        '^shop/kagawa/takamatsushi/fg-sogawa/?$' => 'index.php?pagename= shop/fg-sogawa/',
        '^shop/kagawa/takamatsushi/pcrainbow/?$' => 'index.php?pagename= shop/pcrainbow/',
        '^shop/kagawa/marugameshi/marunakapc-marugame/?$' => 'index.php?pagename= shop/marunakapc-marugame/',
        '^shop/ehime/niihamashi/marunaka-niihama/?$' => 'index.php?pagename= shop/marunaka-niihama/',
        '^shop/fukuoka/fukuokashi/aeon-marinatown/?$' => 'index.php?pagename= shop/aeon-marinatown/',
        '^shop/fukuoka/fukuokashi/seiyu-nanokawa/?$' => 'index.php?pagename= shop/seiyu-nanokawa/',
        '^shop/fukuoka/fukuokashi/fukuokatenjin/?$' => 'index.php?pagename= shop/fukuokatenjin/',
        '^shop/fukuoka/fukuokashi/hakata-bt/?$' => 'index.php?pagename= shop/hakata-bt/',
        '^shop/fukuoka/kitakyuusyuushi/kokura-haramachi/?$' => 'index.php?pagename= shop/kokura-haramachi/',
        '^shop/fukuoka/kitakyuusyuushi/kokura-uomachi/?$' => 'index.php?pagename= shop/kokura-uomachi/',
        '^shop/nagasaki/nagasakishi/maxv-nagasaki/?$' => 'index.php?pagename= shop/maxv-nagasaki/',
        '^shop/nagasaki/saseboshi/sasebo-yonkacho/?$' => 'index.php?pagename= shop/sasebo-yonkacho/',
        '^shop/kumamoto/kumamotoshi/aeon-kumamotochuo/?$' => 'index.php?pagename= shop/aeon-kumamotochuo/',
        '^shop/kumamoto/kumamotoshi/kumamoto-honten/?$' => 'index.php?pagename= shop/kumamoto-honten/',
        '^shop/kumamoto/koushishi/donki-koshi/?$' => 'index.php?pagename= shop/donki-koshi/',
        '^shop/kumamoto/yashiroshi/aeon-yatsushiro/?$' => 'index.php?pagename= shop/aeon-yatsushiro/',
        '^shop/kagoshima/kagoshimashi/aeon-kagoshimachuo/?$' => 'index.php?pagename= shop/aeon-kagoshimachuo/',
        '^shop/hyogo/kakogawashi/kakogawa-yy/?$' => 'index.php?pagename= shop/kakogawa-yy/',
        '^shop/tokyo/fussashi/seiyu-fussa/?$' => 'index.php?pagename= shop/seiyu-fussa/',
        '^shop/tokyo/kotoku/kameido-kita/?$' => 'index.php?pagename= shop/kameido-kita/'
    );

    return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'custom_rewrite_rule');

function custom_rewrite_tag()
{
    add_rewrite_tag('%pagename%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag');

/*------------------------------------------------------------
//JSONからACFに動的に反映
------------------------------------------------------------*/
function acf_load_switch_repeat_list_field_choices($field)
{

    $json_data = file_get_contents(ABSPATH . '../posts-json/campaign_banner_data.json');
    $data = json_decode($json_data, true);

    // 選択肢をクリア。
    $field['choices'] = array();

    // JSONデータから選択肢をロード。
    foreach ($data as $item) {
        $field['choices'][$item['slug']] = $item['title'];
    }

    return $field;
}

add_filter('acf/load_field/name=switch_repeat_list', 'acf_load_switch_repeat_list_field_choices');

add_action('admin_head', function () {
    echo '<style>#edittag {max-width: 100%;	}</style>' . "\n";
});
/*------------------------------------------------------------
//brand-tokei/shop/area/から/shop/へリダイレクト
------------------------------------------------------------*/
add_action('template_redirect', 'custom_redirect_shop_area_terms');
function custom_redirect_shop_area_terms()
{
    if (preg_match('/^\/brand-tokei\/shop\/area\/([^\/]+)\/?$/', $_SERVER['REQUEST_URI'], $matches)) {
        wp_redirect(home_url('/shop/' . $matches[1] . '/'), 301);
        exit;
    }
}