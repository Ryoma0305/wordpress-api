<?php
//////////////////////////////////////////////
// カスタム投稿の設定
//////////////////////////////////////////////

function setRegisterPostType()
{

  register_post_type(
      'stories',
      [
      'labels' => [
        'name' => __('STORY'),
        'singular_name' => __('stories'),
      ],
      'public' => true,
      'has_archive' => true,
			'show_ui' => true,
			'show_in_rest' => true,
      'supports' => array('title', 'editor'),
      ]
  );

	register_post_type(
      'services',
      [
      'labels' => [
        'name' => __('SERVICE'),
        'singular_name' => __('services'),
      ],
      'public' => true,
      'has_archive' => true,
			'show_ui' => true,
			'show_in_rest' => true,
      'supports' => array('title', 'editor'),
      ]
  );

	register_post_type(
			'about',
			[
			'labels' => [
				'name' => __('COMPASS'),
				'singular_name' => __('about'),
			],
			'public' => true,
			'has_archive' => false,
			'show_ui' => true,
			'show_in_rest' => true,
			'supports' => array('title'),
			]
	);

	register_post_type(
		'authors',
		[
		'labels' => [
			'name' => __('AUTHOR'),
			'singular_name' => __('authors'),
		],
		'public' => true,
		'has_archive' => true,
		'show_ui' => true,
		'show_in_rest' => true,
		'supports' => array('title'),
		]
	);
}

add_action('init', 'setRegisterPostType');

function setRegisterTaxonomy()
{
		register_taxonomy(
			'service_category',
			'services',
			array(
				'label' => 'Service カテゴリ',
				'query_var' => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'show_ui' => true,
			)
		);

		register_taxonomy(
			'service_theme',
			'services',
			array(
				'label' => 'Service タイプ',
				'query_var' => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'show_ui' => true,
			)
		);

		register_taxonomy(
			'service_tag',
			'services',
			array(
				'label' => 'Service タグ',
				'show_ui' => true,
				'query_var' => true,
				'hierarchical' => true,
				'public' => true,
				'show_in_rest' => true,
				'update_count_callback' => '_update_post_term_count',
			)
		);

		register_taxonomy(
			'story_category',
			'stories',
			array(
				'label' => 'Story カテゴリー',
				'query_var' => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'show_ui' => true,
			)
		);
}
add_action('init', 'setRegisterTaxonomy');

add_action('pre_get_posts', function ($query){
	if ( is_admin() && ! $query->is_main_query() ) {
			return;
	}
	if ( $query->is_category() || $query->is_tag() ) {
			$query->set('post_type', ['post','services']);
	}
});


// 独自のクエリパラメータとして追加
function add_query_vars( $vars ) {
  $vars[] = 'theme';
  $vars[] = 'category';
	$vars[] = 'service_tag';
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars' );
