<?php

// プロジェクトのグローバル変数
locate_template('_cms_assets/functions_modules/global_vars.php', true);

// カスタム投稿 & タクソノミーを設定
locate_template('_cms_assets/functions_modules/post_types.php', true);

// 管理画面のカスタマイズ
locate_template('_cms_assets/functions_modules/admin.php', true);

// ダッシュボードのカスタマイズ
locate_template('_cms_assets/functions_modules/dashboard.php', true);

// API
locate_template('_cms_assets/functions_modules/api.php', true);

// 便利関数の登録
locate_template('_cms_assets/functions_modules/utils.php', true);

// それぞれのカスタム投稿の記事データを取得する関数群
locate_template('_cms_assets/functions_modules/post_functions.php', true);

// -----------------------------------------------------------------
// 記事保存時OG画像自動生成
// -----------------------------------------------------------------

add_action('save_post', 'savepost_ogimage');

function savepost_ogimage($post_ID) {
    $post_title = urlencode(get_the_title($post_ID));
    // $slug = get_post($post_ID)->post_name;
    // $url = get_template_directory_uri() . '/og/img.php' . '?text=' . $post_title;
    $url = get_template_directory_uri() . '/og/img.php' . '?post_id=' . $post_ID;
    file_get_contents($url);
}

