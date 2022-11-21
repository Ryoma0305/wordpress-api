<?php

//////////////////////////////////////////////
//  プロジェクトのグローバル変数
//////////////////////////////////////////////

global $global_vars;

$global_vars = [
  'site_name'      => 'HAGUKUMU（はぐくむ）',
  'ogtype'         => 'article',
	'ogp'            => get_template_directory_uri() . '/assets/static/images/common/ogp.jpg',
  'home_url'       => '',
	"breakpoint"     => 900,
  'posts_per_page' => [
    'service'      => -1,
		'story'    => -1,
		'forbiz'    => -1,
		'compass'    => -1,
		'author'    => -1,
	]
];

$global_vars['title'] = 'HAGUKUMU（はぐくむ）';

$global_vars["description"] = '株式会社はぐくむは、自分らしい一日を生き、自分たちが望む社会を育むライフデザインカンパニーです。スクールやコーチングなど、対話を通じた共育事業に取り組んでいます。';

$global_vars['nophoto'] = [
	'common'      => "/wp-content/themes/hagukumu.co.jp/assets/static/images/nophoto/nophoto.jpg",
];


