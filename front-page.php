<?php

$taxonomy = 'story_category';

// Service タイプ
$theme = get_terms('service_theme');

// Story一覧
$story_args = [
	'post_type' => "stories",
	'posts_per_page' => 6,
	'ignore_sticky_posts' => 1,
];

$story_query = new WP_Query($story_args);
?>
<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<!-- メインビジュアル Begin -->
<div id="top_hero" class="p-top-hero">
	<div class="p-top-hero__slide-area">
		<div class="p-top-hero__slide">
			<div class="p-top-hero__text-group">
				<blockquote class="p-top-hero__message js-comments"></blockquote>
				<div class="p-top-hero__source">
					<div class="js-reference" style="opacity:0;"></div>
				</div>
			</div>
			<!-- 背景画像 -->
			<figure class="p-top-hero__image js-slide-image"></figure>
			<!--/ 背景画像 -->
		</div>
	</div>
	<div class="p-top-hero__pager js-nav"></div>
</div>
<!-- メインビジュアル End -->

<section class="p-top-block1 js-fade-in-scroll-ul" data-delay="0.5">
	<div class="p-top-block1__inner1">
		<h1 class="p-top-block1__title1 js-fade-in-scroll-li">We are<br> “Life Design <br>Company”</h1>
		<div class="js-fade-in-scroll-li">
			<p class="p-top-block1__text1">はぐくむは、自分らしい一日を生き、自分たちが望む社会を育むライフデザインカンパニーです。心持ちや考え方といった内側の心境と、会社や地域といった外側の環境の両面に働きかけながら、自らの物語を生きる人を増やすために対話を通じた共育事業に取り組んでいます。</p>
			<p class="p-top-block1__button1">
				<a href="<?php echo esc_url(home_url('/about')); ?>" class="c-button -primary -fix">はぐくむについて知る</a>
			</p>
		</div>
	</div>
</section>
<section class="p-top-block2">
	<div class="p-top-block2__inner1 js-fade-in-scroll-ul">
		<h2 class="p-top-block2__title1 js-fade-in-scroll-li">はぐくむが<br>取り組んでいること</h2>
		<p class="p-top-block2__text1 js-fade-in-scroll-li">はぐくむは、対話を大切にしながら、「自己づくり」「チームづくり」「まちづくり」の<br>3つの軸で事業を展開しながら、より良い社会づくりに取り組んでいます。</p>
		<div class="p-top-block2__unit1 js-fade-in-scroll-li">
			<div class="p-top-block2__unit1__main1">
				<p class="p-top-block2__unit1__main1__image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/top/block2_image1_1.png" alt="Town Design Self Design Work Design"></p>
				<p class="p-top-block2__unit1__main1__link1">
					<a class="c-button-with-icon -self-design" href="<?php echo esc_url(home_url('/about/#approach')); ?>">
						<span class="c-button-with-icon__circle">
							<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
							</svg>
						</span>
						はぐくむの３つの事業について
					</a>
				</p>
			</div>
			<div class="p-top-block2__unit1__nav1">
				<h3 class="p-top-block2__unit1__nav1__title1 -type1">自己をはぐくむ Self Design</h3>
				<?php $cat1 = get_field('cat1_service_list', 'option');
				if ($cat1) : ?>
					<ul class="p-top-block2__unit1__nav1__list1">
						<?php foreach ($cat1 as $c) : ?>
							<li>
								<a class="c-button-with-icon -self-design" href="<?php echo esc_url($c->guid); ?>">
									<span class="c-button-with-icon__circle">
										<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
										</svg>
									</span>
									<?php echo esc_html($c->post_title); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<h3 class="p-top-block2__unit1__nav1__title1 -type2">組織をはぐくむ Work Design</h3>
				<ul class="p-top-block2__unit1__nav1__list1">
					<li>
						<a class="c-button-with-icon -work-design" href="<?php echo esc_url(home_url('/forbiz')); ?>">
							<span class="c-button-with-icon__circle">
								<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
								</svg>
							</span>
							森のような組織をはぐくむセッション
						</a>
					</li>
				</ul>

				<h3 class="p-top-block2__unit1__nav1__title1 -type3">街をはぐくむ Town Design</h3>
				<?php $cat2 = get_field('cat2_service_list', 'option');
				if ($cat2) : ?>
					<ul class="p-top-block2__unit1__nav1__list1">
						<?php foreach ($cat2 as $c) : ?>
							<li>
								<a class="c-button-with-icon -town-design" href="<?php echo esc_url($c->guid); ?>">
									<span class="c-button-with-icon__circle">
										<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
										</svg>

									</span>
									<?php echo esc_html($c->post_title); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<section class="p-top-block3 js-fade-in-scroll-ul">
	<div class="p-top-block3__inner1">
		<h2 class="p-top-block3__title1 js-fade-in-scroll-li">はぐくむとの<br class="u-hidden-md-up">関わりを探すキーワード</h2>
		<p class="p-top-block3__text1 js-fade-in-scroll-li">ここに並んでいるのは、はぐくむが追求していること、<br class="u-hidden-md-down">得意としていること、お役に立てそうなことに関するキーワードです。<br class="u-hidden-md-down">ピンときた言葉を選んでいただくと、関わり方のイメージが見えてくるかもしれません。</p>
		<?php if ($theme) : ?>
			<div class="p-top-block3__list1 js-fade-in-scroll-li">
				<?php foreach ($theme as $t) : ?>
					<div>
						<a href="<?php echo esc_url(home_url('/')); ?>/services/?category=<?php echo $t->slug; ?>" class="p-top-block3__label1"><?php echo esc_html($t->name); ?></a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<p class="p-top-block3__button1 js-fade-in-scroll-li">
			<a href="<?php echo esc_url(home_url('/services')); ?>" class="c-button -primary -fix">
				サービス 一覧
			</a>
		</p>
	</div>
</section>
<section class="p-top-block4">
	<div class="p-top-block4__inner1">
		<div class="js-fade-in-scroll-ul">
			<h2 class="p-top-block4__title1 js-fade-in-scroll-li">はぐくむで生まれた物語</h2>
			<p class="p-top-block4__text1 js-fade-in-scroll-li">はぐくむの社内や取り組みをともにしている人たちの中で、<br class="u-hidden-md-down">日々起こっている小さな発見や大きな変化。<br class="u-hidden-md-down">こちらではそんな一人ひとりの物語を中心に、<br class="u-hidden-md-down">代表・小寺のコラムやビジネスの考察なども読み物としてお届けしています。</p>
		</div>
		<div class="p-top-block4__list1-wrapper js-fade-in-scroll-ul">
			<?php if ($story_query->have_posts()) : ?>
				<ul class="p-story-body__list">
					<?php while ($story_query->have_posts()) : $story_query->the_post();

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
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
			<p class="p-top-block4__button1 js-fade-in-scroll-li">
				<a href="<?php echo esc_url(home_url('/stories')); ?>" class="c-button -primary -fix">
					ストーリー 一覧
				</a>
			</p>
		</div>
	</div>
</section>

<section class="p-top-block5 js-fade-in-scroll">
	<div class="p-top-block5__inner1">
		<h2 class="p-top-block5__title1">はぐくむの所在地</h2>
		<div class="p-top-block5__wrap1">
			<div class="p-top-block5__main1">
				<p class="p-top-block5__main1__text1">株式会社はぐくむ</p>
				<p class="p-top-block5__main1__text1">〒155-0033<br>東京都世田谷区代田 4-27-8</p>
				<p class="p-top-block5__main1__text2">井の頭線東松原駅から徒歩5分<br>小田急線梅ヶ丘駅、<br>小田急線世田谷代田駅から徒歩9分<br>羽根木公園から徒歩0分</p>
				<p class="p-top-block5__main1__link1">
					<a class="c-button-with-icon -self-design" href="https://goo.gl/maps/dYw6UPRkyT3mec4H7" target="_blank">
						<span class="c-button-with-icon__circle">
							<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
							</svg>
						</span>
						Google mapで開く
					</a>
				</p>
			</div>
			<div class="p-top-block5__map1">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.697003716408!2d139.65610990000002!3d35.6598361!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018f3734e144831%3A0x5d822f0bc88a4beb!2z44CSMTU1LTAwMzMg5p2x5Lqs6YO95LiW55Sw6LC35Yy65Luj55Sw77yU5LiB55uu77yS77yX4oiS77yY!5e0!3m2!1sja!2sjp!4v1663489268593!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</div>
</section>
<?php get_template_part('includes/footer'); ?>
<!-- トップページメインビジュアル出力 -->
<script>
	<?php
	$item_array = array();

	if (have_rows('key_visual', 'option')) {
		while (have_rows('key_visual', 'option')) {

			the_row();
			$item = [];
			$item['comments'] = [];
			get_sub_field('text1') ? $item['comments'][] = ['text' => esc_html(get_sub_field('text1'))] : '';
			get_sub_field('text2') ? $item['comments'][] = ['text' => esc_html(get_sub_field('text2'))] : '';
			get_sub_field('text3') ? $item['comments'][] = ['text' => esc_html(get_sub_field('text3'))] : '';
			get_sub_field('text4') ? $item['comments'][] = ['text' => esc_html(get_sub_field('text4'))] : '';

			if (get_sub_field('reference')) {
				$reference = get_sub_field('reference');

				if (get_sub_field('reference')->post_type === 'about') {
					$post_type = 'コンパス';
				} elseif (get_sub_field('reference')->post_type === 'stories') {
					$post_type = 'ストーリー';
				}

				$item['reference'] = [
					'text' => 'はぐくむの' . $post_type . '「' . esc_html($reference->post_title) . '」より',
					'url' => esc_url($reference->guid),
				];

				$kv_image = get_sub_field("bg_img");
				$item['image'] = $kv_image = $kv_image ? $kv_image['sizes']['top_kv_image_size'] : '';
			}

			$item_array[] = $item;
		}

		$items = json_encode($item_array);
	}
	?>

	window.homeSlide = <?php echo $items; ?>;
</script>
<?php get_footer(); ?>
