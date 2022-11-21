<?php

// compass
$compass_args = [
	'post_type' => "about",
	'posts_per_page' => $global_vars['posts_per_page']['compass'],
];
$compass_query = new WP_Query($compass_args);

// author
$author_args = [
	'post_type' => "authors",
	'posts_per_page' => $global_vars['posts_per_page']['compass'],
];
$author_query = new WP_Query($author_args);
?>
<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>

<div class="p-about-kv1">
	<div class="p-about-kv1__image1">
		<span class="p-about-kv1__image1__pc1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/hero.jpg" alt="" title=""></span>
		<span class="p-about-kv1__image1__sp1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/hero_sp.jpg" alt="" title=""></span>
	</div>
</div>

<section class="p-about-block1 js-fade-in-scroll-ul" data-delay="0.5">
	<div class="p-about-block1__inner1">
		<h2 class="p-about-block1__title1 js-fade-in-scroll-li">HOPE</h2>
		<p class="p-about-block1__text1 js-fade-in-scroll-li">
			<span class="p-about-block1__text1_sp"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/block1_text1_2.svg" alt="願いとともに、自然をいきる"></span>
			<span class="p-about-block1__text1_pc"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/block1_text1_2_pc.svg" alt="願いとともに、自然をいきる"></span>
		</p>
		<p class="p-about-block1__text2 js-fade-in-scroll-li">世の中の常識や慣習を当然だと受け入れるのではなく、<br>心から湧き上がる願いとともに対話を重ね、<br>自分の中の自然を生きられる社会をつくります。</p>
	</div>
</section>
<section class="p-about-block1 js-fade-in-scroll-ul">
	<div class="p-about-block1__inner1">
		<h2 class="p-about-block1__title1 -type1 js-fade-in-scroll-li">We are <br>“Life Design<br>Company”</h2>
		<p class="p-about-block1__text4 js-fade-in-scroll-li">
			はじめまして。わたしたちはぐくむは、自分らしい一日を生き、自分たちが望む社会を育むライフデザインカンパニーです。「コミュニケーションの質が、人生の質を左右する」を信条に、自分たちも実践者として生きながら、自らの物語を生きる人を増やすために対話を通じた共育事業に取り組んでいます。心持ちや考え方といった内側の心境と、会社や地域といった外側の環境。その両面を、根本から再定義・再構築することで、一日の質を変え、組織やまちの空気を変え、社会の常識と慣習を変えていきます。</p>
		<p class="p-about-block1__text3 js-fade-in-scroll-li"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/block1_text1_1.svg" alt="LIFE = SELF ✕ ( WORK + TOWN )"></p>
		<p class="p-about-block1__text4 js-fade-in-scroll-li">自分らしい一日を積み重ね、充実した人生を送るためには、健やかな自己という土台に豊かで楽しい仕事と暮らしが重なることが大切だと、はぐくむは考えています。</p>
	</div>
</section>
<section class="p-about-block2" id="approach">
	<div class="p-about-block2__inner1">
		<div class="js-fade-in-scroll-ul">
			<h2 class="p-about-block2__title1 js-fade-in-scroll-li">アプローチ</h2>
			<p class="p-about-block2__text1 js-fade-in-scroll-li">はぐくむは、対話を大切にしながら、<br>「自己づくり」「チームづくり」「まちづくり」の3つの軸で事業を展開し、<br>よりよい社会づくりに取り組んでいます。</p>
		</div>
		<ul class="p-about-block2__list1 js-fade-in-scroll-ul">
			<li class="p-about-block2__unit1 -type1 js-fade-in-scroll-li">
				<p class="p-about-block2__unit1__image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/block2_image1_1.png" alt="Self Design"></p>
				<div class="p-about-block2__unit1__inner1">
					<h3 class="p-about-block2__unit1__title1">物語を生きる自己づくり</h3>
					<p class="p-about-block2__unit1__text1">
						自分の心に耳を澄まし、湧き上がってくる願いと向き合い、可能性にフタをせずに挑戦する。スクールを中心にイベントやコンテンツを通じた深い自己対話により、他の誰でもない自分だけの人生を歩むための、信念・考え方・習慣といった土台をつくります。</p>
					<p class="p-about-block2__unit1__link1">
						<a class="c-button-with-icon -self-design" href="<?php echo esc_url(home_url('/services/?theme=self-design')); ?>">
							<span class="c-button-with-icon__circle">
								<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
								</svg>
							</span>
							サービスの一覧
						</a>
					</p>
				</div>
			</li>
			<li class="p-about-block2__unit1 -type2 js-fade-in-scroll-li">
				<p class="p-about-block2__unit1__image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/block2_image1_2.png" alt="Work Design"></p>
				<div class="p-about-block2__unit1__inner1">
					<h3 class="p-about-block2__unit1__title1">願いを叶えるチームづくり</h3>
					<p class="p-about-block2__unit1__text1">
						人生の中で多くの時間を過ごす働く職場を、一人ひとりの人生を輝かせる舞台へ。対話の文化を組織内に根付かせ、管理統制から自主自律組織へといざなうコンサルティングを通じて、一人ひとりの中にある願いを共有しながら、才能を最大限発揮できる環境をはぐくみます。</p>
					<p class="p-about-block2__unit1__link1">
						<a class="c-button-with-icon -work-design" href="<?php echo esc_url(home_url('/services/?theme=work-design')); ?>">
							<span class="c-button-with-icon__circle">
								<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
								</svg>

							</span>
							サービスの一覧
						</a>
					</p>
				</div>
			</li>
			<li class="p-about-block2__unit1 -type3 js-fade-in-scroll-li">
				<p class="p-about-block2__unit1__image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/block2_image1_3.png" alt="Town Design"></p>
				<div class="p-about-block2__unit1__inner1">
					<h3 class="p-about-block2__unit1__title1">心が通うまちづくり</h3>
					<p class="p-about-block2__unit1__text1">
						「ともに生きる」を生活まるごと実践する。日常的に対話を行い、願いや知恵を共有できる仲間とともに生きるまちづくりに取り組んでいます。はぐくむの拠点である世田谷区東松原を中心に、コミュニティレストラン「はぐくむ湖畔」やシェアハウスを運営し、対話を深めるイベントやコミュニティ活動を行っています。</p>
					<p class="p-about-block2__unit1__link1">
						<a class="c-button-with-icon -town-design" href="<?php echo esc_url(home_url('/services/?theme=town-design')); ?>">
							<span class="c-button-with-icon__circle">
								<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
								</svg>

							</span>
							サービスの一覧
						</a>
					</p>
				</div>
			</li>
		</ul>
	</div>
</section>
<section class="p-about-block3">
	<div class="p-about-block3__inner1">
		<div class="js-fade-in-scroll-ul">
			<h2 class="p-about-block3__title1 js-fade-in-scroll-li">コンパス</h2>
			<p class="p-about-block3__text1 js-fade-in-scroll-li">はぐくむが大切にしている言葉は、日々の行動と願う未来をつなぐ羅針盤です。<br>日々の仕事や読書、毎日の朝礼から言葉を見つけ、育みながら更新し続けています。</p>
		</div>
		<ul class="p-about-block3__list1 js-fade-in-scroll-ul">
			<?php if ($compass_query->have_posts()) : while ($compass_query->have_posts()) : $compass_query->the_post(); ?>
					<li class=" js-fade-in-scroll-li">
						<a href="<?php the_permalink(); ?>" class="p-about-block3__unit1">
							<?php if (get_field('main_copy')) : ?>
								<div class="p-about-block3__unit1__title1-wrapper">
									<p class="p-about-block3__unit1__title1"><?php the_field('main_copy') ?></p>
								</div>
							<?php endif; ?>
							<?php if (get_field('update_date')) : ?>
								<p class="p-about-block3__unit1__text1"><?php the_field('update_date') ?> Update</p>
							<?php endif; ?>
						</a>
					</li>
			<?php endwhile;
			endif; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<section class="p-about-block4 js-fade-in-scroll-ul">
	<div class="p-about-block4__inner1">
		<h2 class="p-about-block4__title1 js-fade-in-scroll-li">はぐくむの<br>ロゴマークについて</h2>
		<div class="p-about-block4__unit1 js-fade-in-scroll-li">
			<picture>
				<source srcset="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/about_logo_pc.jpg" media="(min-width: 769px)">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/about/about_logo_sp.jpg" alt="内なる願いをはぐくむかたち はぐくむのロゴマークは、中心から外側へと「は」「ぐ」「く」「む」の輪郭が膨らんでできた形であり、樹木の年輪がモチーフとなっています。外の世界の影響も受けながらゆっくりと円熟していく層は、内なる願いを時間をかけてはぐくんでいくことを大切にする、株式会社はぐくむのフィロソフィーの形です。">
			</picture>
		</div>
	</div>
</section>
<section class="p-about-block5">
	<div class="p-about-block5__inner1">
		<h2 class="p-about-block5__title1 js-fade-in-scroll">はぐくむの人</h2>
		<ul class="p-about-block5__list1 js-fade-in-scroll-ul">
			<?php if ($author_query->have_posts()) : while ($author_query->have_posts()) : $author_query->the_post(); ?>
					<li class="p-about-block5__unit1 js-fade-in-scroll-li">
						<?php
						// サムネイル画像
						$thumb = get_field("author_img");
						$thumb = $thumb ? $thumb['sizes']['author_thumb_size'] : '';
						?>
						<?php if ($thumb) : ?>
							<p class="p-about-block5__unit1__image1"><img src="<?php echo esc_url($thumb); ?>" alt="" title="">
							</p>
						<?php endif; ?>
						<?php if (get_field('name_jp') || get_field('name_en')) : ?>
							<p class="p-about-block5__unit1__text1"><?php the_field('name_jp') ?>
								<span><?php the_field('name_en') ?></span>
							</p>
						<?php endif; ?>
						<?php if (get_field('profile_text')) : ?>
							<p class="p-about-block5__unit1__text2"><?php the_field('profile_text') ?></p>
						<?php endif; ?>

						<?php
						$post1 = get_field('related_post1');
						$post2 = get_field('related_post2');
						?>
						<?php if ($post1 || $post2) : ?>
						<h3 class="p-about-block5__unit1__title1">Story</h3>
							<ul class="p-about-block5__unit1__list1">
								<?php if ($post1) : ?>
									<li>
										<a href="<?php echo esc_url($post1->guid); ?>"><?php get_limited_text($post1->post_title, 34); ?>
											<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor"></path>
											</svg>
										</a>
									</li>
								<?php endif; ?>
								<?php if ($post2) : ?>
									<li>
										<a href="<?php echo esc_url($post2->guid); ?>"><?php get_limited_text($post2->post_title, 34); ?>
											<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor"></path>
											</svg>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>

					</li>
			<?php endwhile;
			endif; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<section class="p-about-block6 js-fade-in-scroll">
	<div class="p-about-block6__inner1">
		<h2 class="p-about-block6__title1">会社概要</h2>
		<ul class="p-about-block6__list1">
			<li>
				<p class="p-about-block6__label1">会社名</p>
				<p class="p-about-block6__text1">株式会社はぐくむ</p>
			</li>
			<li>
				<p class="p-about-block6__label1">所在地</p>
				<p class="p-about-block6__text1">〒155-0033　東京都世田谷区代田 4-27-8</p>
			</li>
			<li>
				<p class="p-about-block6__label1">連絡先</p>
				<p class="p-about-block6__text1">070-6575-3679</p>
			</li>
			<li>
				<p class="p-about-block6__label1">代表</p>
				<p class="p-about-block6__text1">代表取締役　小寺 毅</p>
			</li>
			<li>
				<p class="p-about-block6__label1">設立</p>
				<p class="p-about-block6__text1">2006年10月19日</p>
			</li>
			<li>
				<p class="p-about-block6__label1">資本金</p>
				<p class="p-about-block6__text1">550万円</p>
			</li>
			<li>
				<p class="p-about-block6__label1">事業内容</p>
				<p class="p-about-block6__text1">いい会社づくりのお手伝い可能性をはぐくみ、実現したい未来をサポートする共育事業</p>
			</li>
		</ul>
	</div>
</section>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
