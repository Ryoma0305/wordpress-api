<?php

$taxonomy = 'story_category';

// カテゴリー一覧
$terms = get_terms($taxonomy, 'orderby=id');

// ストーリー記事
if (!empty($_GET)) {
	if (get_query_var('category')) {
		$story_args = array(
			'post_type' => "stories",
			'posts_per_page' => $global_vars['posts_per_page']['story'],
			'ignore_sticky_posts' => 1,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => get_query_var('category'),
					'operator' => 'AND'
				)
			)
		);
	}
} else {
	$story_args = [
		'post_type' => "stories",
		'posts_per_page' => $global_vars['posts_per_page']['story'],
	];
}

$story_query = new WP_Query($story_args);
?>
<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<section>
	<header class="c-page-header">
		<div class="c-page-header__wrapper">
			<h1 class="c-page-header__heading">
				<b class="c-page-header__directory" lang="en">Story</b>
				<span class="c-page-header__main-text">はぐくむで生まれた物語</span>
			</h1>
		</div>
	</header>
	<div class="l-contents__wrapper">
		<div class="p-story-header">
			<form method="get" id="form-pc">
				<div class="p-story-header__desktop u-hidden-md-down">
					<h2 class="p-story-header__heading">カテゴリー選択</h2>
					<?php if ($terms) : ?>
						<div class="p-story-header__tag-list">
							<?php foreach ($terms as $term) : ?>
								<label class="c-radio-tag">
									<input class="c-radio-tag__input" type="radio" name="category" value="<?php echo esc_html($term->slug); ?>">
									<span class="c-radio-tag__label">
										<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.2005 3.80665C11.9405 3.54665 11.5205 3.54665 11.2605 3.80665L8.00047 7.05998L4.74047 3.79998C4.48047 3.53998 4.06047 3.53998 3.80047 3.79998C3.54047 4.05998 3.54047 4.47998 3.80047 4.73998L7.06047 7.99998L3.80047 11.26C3.54047 11.52 3.54047 11.94 3.80047 12.2C4.06047 12.46 4.48047 12.46 4.74047 12.2L8.00047 8.93998L11.2605 12.2C11.5205 12.46 11.9405 12.46 12.2005 12.2C12.4605 11.94 12.4605 11.52 12.2005 11.26L8.94047 7.99998L12.2005 4.73998C12.4538 4.48665 12.4538 4.05998 12.2005 3.80665Z" />
										</svg>
										<span class="c-radio-tag__remove">削除</span>
										<?php echo esc_html($term->name); ?>
									</span>
								</label>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</form>
			<form method="get" id="form-sp">
				<div class="u-hidden-md-up">
					<div class="p-story-header__filter-area">
						<button class="p-story-header__filter-button js-open-modal" type="button">カテゴリー選択
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.25 13.5H9.75C10.1625 13.5 10.5 13.1625 10.5 12.75C10.5 12.3375 10.1625 12 9.75 12H8.25C7.8375 12 7.5 12.3375 7.5 12.75C7.5 13.1625 7.8375 13.5 8.25 13.5ZM2.25 5.25C2.25 5.6625 2.5875 6 3 6H15C15.4125 6 15.75 5.6625 15.75 5.25C15.75 4.8375 15.4125 4.5 15 4.5H3C2.5875 4.5 2.25 4.8375 2.25 5.25ZM5.25 9.75H12.75C13.1625 9.75 13.5 9.4125 13.5 9C13.5 8.5875 13.1625 8.25 12.75 8.25H5.25C4.8375 8.25 4.5 8.5875 4.5 9C4.5 9.4125 4.8375 9.75 5.25 9.75Z" />
							</svg>
						</button>
						<button class="c-radio-tag -active">
							<span class="c-radio-tag__label">
								<span class="c-radio-tag__remove">削除</span>
								<span class="js-current-tag">All</span>
							</span>
						</button>
					</div>
					<dialog class="c-semi-modal">
						<div class="c-semi-modal__header">
							カテゴリー選択
							<button class="c-semi-modal__close js-close-modal" type="reset" aria-label="閉じる">
								<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.2005 3.80665C11.9405 3.54665 11.5205 3.54665 11.2605 3.80665L8.00047 7.05998L4.74047 3.79998C4.48047 3.53998 4.06047 3.53998 3.80047 3.79998C3.54047 4.05998 3.54047 4.47998 3.80047 4.73998L7.06047 7.99998L3.80047 11.26C3.54047 11.52 3.54047 11.94 3.80047 12.2C4.06047 12.46 4.48047 12.46 4.74047 12.2L8.00047 8.93998L11.2605 12.2C11.5205 12.46 11.9405 12.46 12.2005 12.2C12.4605 11.94 12.4605 11.52 12.2005 11.26L8.94047 7.99998L12.2005 4.73998C12.4538 4.48665 12.4538 4.05998 12.2005 3.80665Z" />
								</svg>
							</button>
						</div>
						<?php if ($terms) : ?>
							<div class="c-semi-modal__body">
								<div class="p-story-header__tag-list">
									<?php foreach ($terms as $term) : ?>
										<label class="c-radio-tag">
											<input class="c-radio-tag__input" type="radio" name="category" value="<?php echo esc_html($term->slug); ?>">
											<span class="c-radio-tag__label">
												<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
													<path d="M12.2005 3.80665C11.9405 3.54665 11.5205 3.54665 11.2605 3.80665L8.00047 7.05998L4.74047 3.79998C4.48047 3.53998 4.06047 3.53998 3.80047 3.79998C3.54047 4.05998 3.54047 4.47998 3.80047 4.73998L7.06047 7.99998L3.80047 11.26C3.54047 11.52 3.54047 11.94 3.80047 12.2C4.06047 12.46 4.48047 12.46 4.74047 12.2L8.00047 8.93998L11.2605 12.2C11.5205 12.46 11.9405 12.46 12.2005 12.2C12.4605 11.94 12.4605 11.52 12.2005 11.26L8.94047 7.99998L12.2005 4.73998C12.4538 4.48665 12.4538 4.05998 12.2005 3.80665Z" />
												</svg>
												<span class="c-radio-tag__remove">削除</span>
												<span class="js-label-name"><?php echo esc_html($term->name); ?></span>
											</span>
										</label>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</dialog>
				</div>
			</form>
		</div>
		<div class="p-story-body">
			<ul class="p-story-body__list js-fade-in-scroll-ul">
				<?php if ($story_query->have_posts()) : while ($story_query->have_posts()) : $story_query->the_post();

					// サムネイル画像
					$thumb =  get_field('thumbnail_img') ?  get_field('thumbnail_img') : get_field('main_img');
					$img = $thumb ? $thumb['sizes']['story_thumb_size'] : $global_vars['nophoto']["common"];
				?>
					<li class="p-story js-fade-in-scroll-li">
						<a class="p-story__text" href="<?php the_permalink(); ?>"><?php get_limited_text(get_the_title(), 35); ?></a>
						<ul class="p-story__tag-list">
							<?php $category = wp_get_object_terms($post->ID, $taxonomy); ?>
							<?php if ($category) : foreach ($category as $c) : ?>
									<li>
										<a class="c-tag" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo esc_html($c->slug); ?>"><?php echo esc_html($c->name); ?></a>
									</li>
							<?php endforeach;
							endif; ?>
						</ul>
						<figure class="p-story__media">
							<img class="p-story__image" src="<?php echo esc_url($img); ?>" alt="">
						</figure>
					</li>
				<?php endwhile;
				endif; ?>
			</ul>
			<div class="p-story-body__footer">
				<button class="c-button -primary -fix -icon p-story-body__button" type="button">もっとみる
					<svg width="25" height="24" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.5 13H13.5V18C13.5 18.55 13.05 19 12.5 19C11.95 19 11.5 18.55 11.5 18V13H6.5C5.95 13 5.5 12.55 5.5 12C5.5 11.45 5.95 11 6.5 11H11.5V6C11.5 5.45 11.95 5 12.5 5C13.05 5 13.5 5.45 13.5 6V11H18.5C19.05 11 19.5 11.45 19.5 12C19.5 12.55 19.05 13 18.5 13Z" />
					</svg>
				</button>
			</div>
		</div>
	</div>
</section>
<?php get_template_part('includes/footer'); ?>
<!-- もっと見るボタンクリックで記事追加表示 -->
<script>
	let moreNum = 0;
	if (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0) {
		moreNum = 6;
		// スマホ
	} else if (navigator.userAgent.indexOf('iPad') > 0 || navigator.userAgent.indexOf('Android') > 0) {
		moreNum = 12;
		// タブレット
	} else {
		moreNum = 12;
		// PC
	}


	$('.p-story:nth-child(n + ' + (moreNum + 1) + ')').addClass('is-hidden');

	$('.p-story-body__button').on('click', function() {
		$('.p-story.is-hidden').slice(0, moreNum).removeClass('is-hidden');
		if ($('.p-story.is-hidden').length == 0) {
			$('.p-story-body__button').fadeOut();
		}
	});

	$(function() {
		var list = $(".p-story-body__list .p-story").length;
		if (list < moreNum) {
			$('.p-story-body__button').addClass('is-hidden');
		}
	});
</script>
<!--/ もっと見るボタンクリックで記事追加表示 -->

<!-- ボタンに選択中タグ名表示 -->
<script>
	let active_input = document.querySelector("input:checked + span .js-label-name") ? document.querySelector("input:checked + span .js-label-name").textContent : 'All';
	const current_tag = document.querySelector(".js-current-tag")
	current_tag.textContent = active_input;
</script>
<!--/ ボタンに選択中タグ名表示 -->
<?php get_footer(); ?>
