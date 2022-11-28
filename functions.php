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

// 管理画面にCloudflare Pagesのデプロイボタンを設置

add_action( 'admin_menu', 'register_cf_deploy_menu_page' );
function register_cf_deploy_menu_page(){
    add_menu_page( 'デプロイ実行', 'デプロイ実行',
    'manage_options', 'cf_deploy', 'cf_deploy_page', '', 1000 );
}

function cf_deploy_page(){
    echo "<h2>Cloudflare Pagesへデプロイ</h2>";
    $curl=curl_init("https://api.cloudflare.com/client/v4/pages/webhooks/deploy_hooks/e0cd0e84-bdde-4be3-830b-2693ee76d607");
    curl_setopt($curl,CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($POST_DATA));
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl,CURLOPT_COOKIEJAR,      'cookie');
    curl_setopt($curl,CURLOPT_COOKIEFILE,     'tmp');
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE);

    $output= curl_exec($curl);
    echo "デプロイフックを送信しました。";
}

