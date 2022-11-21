<?php

$taxonomy = 'story_category';

$term_slug = 'work-design';

// Forbiz記事
$forbiz_args = array(
	'post_type' => 'stories',
	'posts_per_page' => $global_vars['posts_per_page']['forbiz'],
	'post__not_in' => array($post->ID),
	'ignore_sticky_posts' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => $taxonomy,
			'field' => 'slug',
			'terms' => $term_slug ? $term_slug : '',
		)
	)
);
$forbiz_query = new WP_Query($forbiz_args);
?>
<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<div class="p-forbiz-kv1">
	<div class="p-forbiz-kv1__inner1 js-fade-in-scroll-ul">
		<h1 class="p-forbiz-kv1__title1 js-fade-in-scroll-li">WORK <br>DESIGN</h1>
		<p class="p-forbiz-kv1__text1 js-fade-in-scroll-li">会社は何のために存在しているのか？<br>自分達は何を目指し、何のために活動しているのか？<br>会社は利益のために存在しているわけでもないし、社員は会社の数字を上げるために存在しているわけでもない。<br>社会の中における自社の存在目的と、その実現したい未来に向かって、共に関わり合うメンバーが自らの才能や個性をイキイキと表現しながら、人間らしく在れる”生命的”な会社をはぐくんでいくお手伝い。<br>それがはぐくむがお役立ちしたいこと。
		</p>
	</div>
</div>
<section class="p-forbiz-block1 p-forbiz-block1__scroll-margin">
	<div class="p-forbiz-block1__inner1">
		<h2 class="p-forbiz-block1__title1 js-fade-in-scroll">森のような<br>組織づくりの物語</h2>
		<p class="p-forbiz-block1__text1 js-fade-in-scroll">はぐくむではこれまで業種や規模を問わずさまざまな企業様に対して、<br>組織づくりのお手伝いをさせていただきました。<br>その中で生まれた物語の一部をご紹介いたします。</p>
		<?php if ($forbiz_query->have_posts()) : ?>
			<ul class="p-forbiz-block1__list p-story-body__list js-fade-in-scroll-ul">
				<?php while ($forbiz_query->have_posts()) : $forbiz_query->the_post();

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
					<figure class="p-story__media p-service-detail-story__media<?php echo get_page_block('acf/podcast') ? ' -podcast' : ''; ?>">
						<img class="p-story__image" src="<?php echo esc_url($img); ?>" alt="">
					</figure>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
		<p class="p-forbiz-block1__button1 js-fade-in-scroll">
			<a href="<?php echo esc_url(home_url('/stories/?category=work-design')); ?>" class="c-button -primary -fix -for-biz">
				ストーリー 一覧
			</a>
		</p>
		<p class="p-forbiz-block1__banner1 js-fade-in-scroll">
			<a href="https://anchor.fm/vhcc3m7vopg" target="_blank">
				<span class="p-forbiz-block1__banner1__sp1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/forbiz/block1_banner1_1.png" alt="\ 聞く、はぐくむ / 代表 小寺毅によるPodcastsも配信中"></span>
				<span class="p-forbiz-block1__banner1__pc1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/forbiz/block1_banner1_1_pc.png" alt="\ 聞く、はぐくむ / 代表 小寺毅によるPodcastsも配信中"></span>
			</a>
		</p>
	</div>
</section>
<section class="p-forbiz-block2 p-forbiz-block2__scroll-margin" id="section1">
	<div class="p-forbiz-block2__inner1">
		<div class="js-fade-in-scroll-ul">
			<h2 class="p-forbiz-block2__title1 js-fade-in-scroll-li">森のような組織を<br>はぐくむためにできること</h2>
			<p class="p-forbiz-block2__text1 js-fade-in-scroll-li">一人ひとりの才能や個性を発揮するために、企業・組織に伴走する6つのプログラム。<br>対話を通じて想いを言葉にし、チームの関係性を整え、<br>そのチームに相応しい文化をはぐくみます。</p>
		</div>
		<?php if (have_rows('program')) : ?>
			<ul class="p-forbiz-block2__list1 js-fade-in-scroll-ul">
				<?php while (have_rows('program')) : the_row(); ?>
					<li class="js-fade-in-scroll-li">
						<div class="p-forbiz-block2__unit1">
							<h3 class="p-forbiz-block2__unit1__title1"><?php the_sub_field('program_title'); ?></h3>
							<p class="p-forbiz-block2__unit1__text1"><?php the_sub_field('program_text'); ?></p>
							<?php $related_post = get_sub_field('related_post') ?>
							<?php if ($related_post) : ?>
								<p class="p-forbiz-block2__unit1__link1">
									<a class="c-button-with-icon -work-design" href="<?php echo esc_url($related_post->guid); ?>">
										<span class="c-button-with-icon__circle">
											<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7.46742 5.03258C7.17492 5.32508 7.17492 5.79758 7.46742 6.09008L10.3774 9.00008L7.46742 11.9101C7.17492 12.2026 7.17492 12.6751 7.46742 12.9676C7.75992 13.2601 8.23242 13.2601 8.52492 12.9676L11.9674 9.52508C12.2599 9.23258 12.2599 8.76008 11.9674 8.46758L8.52492 5.02508C8.23992 4.74008 7.75992 4.74008 7.46742 5.03258Z" fill="currentColor" />
											</svg>
										</span>関連するストーリーを読む
									</a>
								</p>
							<?php endif; ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<div class="js-fade-in-scroll-ul">
			<p class="p-forbiz-block2__banner1 js-fade-in-scroll-li">
				<a href="<?php echo esc_url(home_url('/stories/559/')); ?>">
					<span class="p-forbiz-block2__banner1__sp1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/forbiz/block2_banner1_1.png" alt="\ プログラムで実際に使用するシートを特別配布中 / ワークシートサンプルダウンロード"></span>
					<span class="p-forbiz-block2__banner1__pc1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/forbiz/block2_banner1_1_pc.png" alt="\ 森のような組織づくりに関心のある人へ / 会社で、チームで、使えるワークシートを配布中"></span>
				</a>
			</p>
			<p class="p-forbiz-block2__banner1 js-fade-in-scroll-li">
				<a href="<?php echo esc_url(home_url('/entry-forbiz')); ?>">
					<span class="p-forbiz-block2__banner1__sp1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/forbiz/block2_banner1_2.png" alt="実施プログラムや費用などまずはお気軽にご相談ください 顧問契約について相談する"></span>
					<span class="p-forbiz-block2__banner1__pc1"><img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/forbiz/block2_banner1_2_pc.png" alt="\ 実施プログラムや費用などまずはお気軽にご相談ください / 顧問契約について相談する"></span>
				</a>
			</p>
		</div>
	</div>
</section>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
