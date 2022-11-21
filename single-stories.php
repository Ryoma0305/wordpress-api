<?php
// ページ固有の情報を入力 ////////////////////////
$og_image = get_field('thumbnail_img') ? get_field('thumbnail_img') : get_field('main_img');
$global_vars['ogp'] = $og_image ? $og_image['sizes']['story_kv_image_size'] : $global_vars['ogp'];
// ページ固有の情報を入力 end ////////////////////////

$taxonomy = 'story_category';

//カテゴリー
$terms = get_the_terms($post->id, $taxonomy);
$term_slug = $terms ? $terms[0]->slug : '';
$term_name = $terms ? $terms[0]->name : '';

// KV画像
$kv_image = get_field("main_img");
$kv_image = $kv_image ? $kv_image['sizes']['story_kv_image_size'] : $global_vars['nophoto']["common"];


// 関連記事
$story_args = array(
	'post_type' => 'stories',
	'posts_per_page' => 3,
	'post__not_in' => array($post->ID),
	'ignore_sticky_posts' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => $taxonomy,
			'field' => 'slug',
			'terms' => $terms ? $terms[0]->slug : '',
		)
	)
);

$story_query = new WP_Query($story_args);
?>

<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<article class="p-post">
	<div class="l-contents__wrapper -narrow">
		<header class="p-post-header">
			<h1 class="p-post-header__heading">
				<b class="p-post-header__directory">Story</b>
				<span class="p-post-header__main-text"><?php the_title(); ?></span>
			</h1>
			<?php $category = wp_get_object_terms($post->ID, $taxonomy); if ($category): ?>
			<ul class="p-post-header__tag-list">
				<?php foreach ($category as $c) : ?>
				<li class="p-post-header__tag-item">
					<a class="c-tag" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo esc_html($c->slug); ?>"><?php echo esc_html($c->name); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</header>
		<div class="p-post-body">
			<?php if ($kv_image): ?>
			<figure class="p-post-body__main-image">
				<img src="<?php echo esc_url($kv_image); ?>" alt="">
			</figure>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php if ($terms): ?>
			<p class="p-post-body__normal-button">
				<a class="c-button -primary" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo $term_slug; ?>"><?php echo esc_html($term_name); ?>の一覧を見る</a>
			</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="l-contents__wrapper c-paging">
		<!-- 前後記事へのリンク -->
		<?php
		the_post_navigation(array(
			'prev_text' => '<span class="prev-text">前の記事</span><span class="prev-title">%title</span> ',
			'next_text' => '<span class="next-text">次の記事</span><span class="next-title">%title</span> ',
			'screen_reader_text' => '前後の記事へのリンク',
		));
		?>
		<!--/ 前後記事へのリンク -->
		<a class="c-paging__back" href="/stories/">
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<rect width="6" height="6"/>
				<rect y="9" width="6" height="6"/>
				<rect y="18" width="6" height="6"/>
				<rect x="9" width="6" height="6"/>
				<rect x="9" y="9" width="6" height="6"/>
				<rect x="9" y="18" width="6" height="6"/>
				<rect x="18" width="6" height="6"/>
				<rect x="18" y="9" width="6" height="6"/>
				<rect x="18" y="18" width="6" height="6"/>
			</svg>
			<span class="c-paging__back-text">一覧に戻る</span>
		</a>
	</div>
	<?php if ($story_query->have_posts()): ?>
	<aside class="l-contents__wrapper p-related-post">
		<h2 class="p-related-post__heading">関連ストーリー</h2>
		<ul class="p-related-post__list">
			<?php while ($story_query->have_posts()) : $story_query->the_post();

			// サムネイル画像
			$thumb =  get_field('thumbnail_img') ?  get_field('thumbnail_img') : get_field('main_img');
			$img = $thumb ? $thumb['sizes']['story_thumb_size'] : $global_vars['nophoto']["common"];
			?>
			<li class="p-story">
				<a class="p-story__text" href="<?php the_permalink(); ?>"><?php get_limited_text(get_the_title(), 35); ?></a>
				<?php $category = wp_get_object_terms($post->ID, $taxonomy); if ($category):?>
				<ul class="p-story__tag-list">
					<?php foreach ($category as $c) : ?>
					<li>
						<a class="c-tag" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo esc_html($c->slug); ?>"><?php echo esc_html($c->name); ?></a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<figure class="p-story__media">
					<img class="p-story__image" src="<?php echo esc_url($img); ?>" alt="">
				</figure>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	</aside>
	<?php endif; ?>
</article>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>

