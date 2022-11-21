<?php
//////////////////////////////////////////////
//  ダッシュボード カスタマイズ
//////////////////////////////////////////////

function add_dashboard_widgets()
{
    wp_add_dashboard_widget('dashboard_widget_description', '管理画面INDEX', 'add_links_welcome_panel');
    global $wp_meta_boxes;
    $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
    $widget_backup = array('dashboard_widget_description' => $normal_dashboard['dashboard_widget_description']);
    unset($normal_dashboard['dashboard_widget_description']);
    $sorted_dashboard = array_merge($widget_backup, $normal_dashboard);
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'add_dashboard_widgets');

remove_action('welcome_panel', 'wp_welcome_panel');
function remove_dashboard_widgets()
{
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
		unset($wp_meta_boxes['dashboard']['normal']['core']['aioseo-overview']); // AIOSEO概要
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']); // サイトヘルス
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // アクティビティ
		remove_meta_box( 'aioseo-seo-setup', 'dashboard', 'normal' ); //AIOSEO設定
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


function add_links_welcome_panel()
{
    ?>
	<div class="welcome_panel_sections">
		<!-- ● -->
    <div class="welcome_panel_section">
      <h2>Top</h2>
      <h3>【url】<a target="_blank" rel="noreferrer" href='<?php echo esc_url(home_url('/')); ?>'>/top/</a></h3>
      <p><a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="<?php echo esc_url(home_url('/wp-admin/admin.php?page=top')); ?>">編集画面</a></p>
    </div>
		<!-- ● -->
    <div class="welcome_panel_section">
      <h2>Service</h2>
      <h3>【url】<a target="_blank" rel="noreferrer" href='<?php echo esc_url(home_url('/services')); ?>'>/services/</a></h3>
      <ul>
				<li>記事の並び順はドラッグ＆ドロップで並び替えられます。</li>
      </ul>
      <p><a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="<?php echo esc_url(home_url('/wp-admin/edit.php?post_type=services')); ?>">記事一覧</a></p>
    </div>
    <!-- ● -->
    <div class="welcome_panel_section">
      <h2>Story</h2>
      <h3>【url】<a target="_blank" rel="noreferrer" href='<?php echo esc_url(home_url('/stories')); ?>'>/stories/</a></h3>
      <ul>
				<li>記事の並び順はドラッグ＆ドロップで並び替えられます。</li>
				<li>記事一覧のスターアイコンをクリックまたは、投稿編集画面の「この投稿を先頭に固定表示」を選択で記事を先頭固定にできます。</li>
      </ul>
      <p><a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="<?php echo esc_url(home_url('/wp-admin/edit.php?post_type=stories')); ?>">記事一覧</a></p>
    </div>
		<!-- ● -->
    <div class="welcome_panel_section">
      <h2>Compus</h2>
			<ul>
				<li>記事の並び順はドラッグ＆ドロップで並び替えられます。</li>
      </ul>
      <p><a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="<?php echo esc_url(home_url('/wp-admin/edit.php?post_type=about')); ?>">記事一覧</a></p>
    </div>
		<!-- ● -->
    <div class="welcome_panel_section">
      <h2>Author</h2>
			<ul>
				<li>記事の並び順はドラッグ＆ドロップで並び替えられます。</li>
      </ul>
      <p><a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="<?php echo esc_url(home_url('/wp-admin/edit.php?post_type=authors')); ?>">編集画面</a></p>
    </div>
		<!-- ● -->
    <div class="welcome_panel_section">
      <h2>For Biz</h2>
			<h3>【url】<a target="_blank" rel="noreferrer" href='<?php echo esc_url(home_url('/forbiz')); ?>'>/forbiz/</a></h3>
      <p><a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="<?php echo esc_url(home_url('/wp-admin/post.php?post=186&action=edit')); ?>">編集画面</a></p>
    </div>
		<!-- ● -->
    <div class="welcome_panel_section">
		<?php
		?>
			<h2>各カテゴリ＆タグ編集</h2>
			<ul>
				<li>カテゴリとタグの並び順はドラッグ＆ドロップで並び替えられます。</li>
      </ul>
			<h3>【Sevice カテゴリを編集】</h3>
			<p>
				<a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="edit-tags.php?taxonomy=service_category&post_type=services">Sevice カテゴリ</a>
			</p>
			<h3>【Sevice タイプを編集】</h3>
			<p>
				<a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="edit-tags.php?taxonomy=service_theme&post_type=services">Sevice タイプ</a>
			</p>
			<h3>【Sevice タグを編集】</h3>
			<p>
				<a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="edit-tags.php?taxonomy=service_tag&post_type=services">Sevice タグ</a>
			</p>
			<h3>【Storyの記事カテゴリーを編集】</h3>
			<p>
				<a class="button button-primary post-foo" rel="noreferrer" target="_blank" href="edit-tags.php?taxonomy=story_category&post_type=stories">Story カテゴリー</a>
			</p>
		</div>
		<!-- ● -->
	</div>
    <?php
}

