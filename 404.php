<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<article>
	<header class="c-page-header">
		<div class="c-page-header__wrapper -narrow">
			<h1 class="c-page-header__heading">
				<b class="c-page-header__directory">404</b>
				<span class="c-page-header__main-text">ページが見つかりません</span>
			</h1>
		</div>
	</header>
	<div class="l-contents__wrapper -narrow p-not-found">
		<p class="p-not-found__text">お探しのページは、削除・移動・変更されたか、<br class="u-hidden-md-down">アドレスが異なっているなどの理由で見つかりませんでした。<br>お手数ですが、ナビゲーションか、<br class="u-hidden-md-down">トップページより必要な情報をお探しください。</p>
		<p>
			<a class="c-button -primary -fix" href="<?php echo esc_url(home_url('/')); ?>">TOPに戻る</a>
		</p>
	</div>
</article>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
