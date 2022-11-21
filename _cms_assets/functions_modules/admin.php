<?php
//////////////////////////////////////////////
//  管理画面設定
/////////////////////////////////////////////

/**
 * 管理画面用のjsとcssを読み込み
 */

add_action('admin_enqueue_scripts', 'load_admin_js_css');

function load_admin_js_css()
{
  wp_enqueue_style('admin_style', get_template_directory_uri() . '/_cms_assets/styles/admin.css');
	wp_enqueue_style('dashboard_style', get_template_directory_uri() . '/_cms_assets/styles/dashboard.css');
}

/* ACF Options Page の設定 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' => 'TOP', // ページタイトル
    'menu_title' => 'TOP', // メニュータイトル
    'menu_slug' => 'top', // メニュースラッグ
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}


/** エディタにオリジナルのスタイルを適用 */
function wpdocs_theme_add_editor_styles() {
	global $pagenow;
	if($pagenow === 'post.php' || $pagenow === 'post-new.php' ) {
		add_theme_support( 'editor-styles' );
		add_editor_style( array( 'assets/main.css', 'acf-blocks/acf-block-style/acf-block.css' ) );
	}

}
add_action( 'after_setup_theme', 'wpdocs_theme_add_editor_styles' );


// 管理画面からメインメニューを非表示にする
function remove_menus() {
  remove_menu_page( 'edit.php' ); // 投稿
  remove_menu_page( 'edit-comments.php' ); // コメント
}
add_action( 'admin_menu', 'remove_menus', 999 );

/*【管理画面】権限別にサイドバーメニューの表示をカスタマイズ */
function remove_menus_by_user_role () {
  if (!current_user_can('administrator')) {
    global $menu;
    $restricted = array(
      // __('固定ページ'),
      __('ツール'),
      );
      end ($menu);
      while (prev($menu)){
      $value = explode(' ',$menu[key($menu)][0]);
      if(in_array($value[0]!=NULL?$value[0]:"",$restricted)){unset($menu[key($menu)]);}
    }
  }
}
add_action('admin_menu', 'remove_menus_by_user_role');

// 画像サイズの追加
function add_image_size_setup() {
	add_image_size('top_kv_image_size', 570, 570, true);
	add_image_size('story_thumb_size', 556, 340, true);
	add_image_size('story_kv_image_size', 1544, 940, true);
	add_image_size('service_thumb_size', 404, 300, true);
	add_image_size('service_kv_image_size',1032, 852, true);
	add_image_size('author_thumb_size', 884, 600, true);
	add_image_size('gallery_thumb_size', 410, 410, true);
	add_image_size('gallery_image_size', 1868, 1104, true);
	add_image_size('acf_block_image_size', 1544, 940, true);
	add_image_size('acf_block_image_vertical_size', 730, 900, true);
}
add_action('after_setup_theme', 'add_image_size_setup');


// 固定ページ編集画面でエディターを非表示
add_filter('use_block_editor_for_post',function($use_block_editor,$post){
	if($post->post_type==='page'){
		remove_post_type_support('page','editor');
		return false;
	}
	return $use_block_editor;
},10,2);


// 管理画面メニューに固定ページを追加
// function add_page_to_admin_menu() {
//   add_menu_page( 'FORBIZ', 'FORBIZ', 'manage_options', 'post.php?post=186&action=edit', '', 'dashicons-book-alt', 3);
// }
// add_action( 'admin_menu', 'add_page_to_admin_menu' );


/**
 * acfカスタムブロック追加
 */
if ( function_exists( 'acf_custom_block_add' ) ) {
	add_action( 'acf/init', 'acf_custom_block_add' );
}
function acf_custom_block_add() {

if ( function_exists( 'acf_register_block_type' ) ) {


	acf_register_block_type(
		array(
		 'name'            => 'heading',
		 'title'           => __( '大見出し' ),
		 'description'     => __( '大見出しです。' ),
		 'render_template' => 'acf-blocks/acf-block/heading-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '見出し', 'タイトル' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'heading-medium',
		 'title'           => __( '中見出し' ),
		 'description'     => __( '中見出しです。' ),
		 'render_template' => 'acf-blocks/acf-block/heading-medium-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '中見出し' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'heading-small',
		 'title'           => __( '見出し' ),
		 'description'     => __( '見出しです。' ),
		 'render_template' => 'acf-blocks/acf-block/heading-small-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '見出し' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'image',
		 'title'           => __( '画像（横長）' ),
		 'description'     => __( '画像（横長）です。' ),
		 'render_template' => 'acf-blocks/acf-block/image-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '画像' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'image-vertical',
		 'title'           => __( '画像（縦長）' ),
		 'description'     => __( '画像（縦長）です。' ),
		 'render_template' => 'acf-blocks/acf-block/image-vertical-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '画像' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'bg-area1',
		 'title'           => __( '背景囲み（色付き）' ),
		 'description'     => __( '背景囲み（色付き）です。' ),
		 'render_template' => 'acf-blocks/acf-block/bg-area1-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '背景色' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'bg-area2',
		 'title'           => __( '背景囲み（枠線）' ),
		 'description'     => __( '背景囲み（枠線）です。' ),
		 'render_template' => 'acf-blocks/acf-block/bg-area2-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( '背景色' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'podcast',
		 'title'           => __( 'Podcast' ),
		 'description'     => __( 'Podcastです。' ),
		 'render_template' => 'acf-blocks/acf-block/podcast-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( 'podcast', '埋め込み' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'list',
		 'title'           => __( 'リスト' ),
		 'description'     => __( 'リストです。' ),
		 'render_template' => 'acf-blocks/acf-block/list-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( 'リスト' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'list-with-number',
		 'title'           => __( '番号付きリスト' ),
		 'description'     => __( '番号付きリストです。' ),
		 'render_template' => 'acf-blocks/acf-block/list-with-number-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( 'リスト' ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);

	acf_register_block_type(
		array(
		 'name'            => 'button',
		 'title'           => __( 'ボタン' ),
		 'description'     => __( 'ボタンです。' ),
		 'render_template' => 'acf-blocks/acf-block/button-block.php',
		 'category'        => 'common',
		 'icon'            => 'admin-comments',
		 'keywords'        => array( 'ボタン', ),
		 'post_types'      => array( 'stories' ),
		 'mode'            => 'auto',
		)
	);
 }
}
