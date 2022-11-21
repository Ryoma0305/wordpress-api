<?php
// ページ固有の情報を入力 ////////////////////////
$global_vars['ogp'] = getImageFromPostId("og_img",$post->ID) ?: $global_vars['ogp'];
// ページ固有の情報を入力 end ////////////////////////

$taxonomy = 'story_category';

// カテゴリー
$cat = get_the_terms($post->ID, 'service_tag');
$cat_id = $cat ? $cat[0]->term_id : '';

// KV画像
$kv_image = get_field("main_img");
$kv_image = $kv_image ? $kv_image['sizes']['service_kv_image_size'] : $global_vars['nophoto']["common"];

// ギャラリー
$gallery = get_field("gallery");

// 関連ストーリー記事１
$related_post1 = get_field("related-story-post1") ?: '';
$related_post1_title = $related_post1 ? $related_post1->post_title : '';
$related_post1_url = $related_post1 ? $related_post1->guid : '';
$related_post1_cat = $related_post1 ? get_the_terms($related_post1->ID, 'story_category') : '';
$related_post1_thumb = get_post_meta($related_post1->ID, 'thumbnail_img', true) ? get_post_meta($related_post1->ID, 'thumbnail_img', true) : get_post_meta($related_post1->ID, 'main_img', true);
$related_post1_thumb_url = $related_post1_thumb ? wp_get_attachment_image_url($related_post1_thumb, 'story_thumb_size') : $global_vars['nophoto']["common"];



// 関連ストーリー記事２
$related_post2 = get_field("related-story-post2") ?: '';
$related_post2_title = $related_post2 ? $related_post2->post_title : '';
$related_post2_url = $related_post2 ? $related_post2->guid : '';
$related_post2_cat = $related_post2 ? get_the_terms($related_post2->ID, 'story_category') : '';
$related_post2_thumb = get_post_meta($related_post2->ID, 'thumbnail_img', true) ? get_post_meta($related_post2->ID, 'thumbnail_img', true) : get_post_meta($related_post2->ID, 'main_img', true);
$related_post2_thumb_url = $related_post2_thumb ? wp_get_attachment_image_url($related_post2_thumb, 'story_thumb_size') : $global_vars['nophoto']["common"];


// 関連ストーリー記事３
$related_post3 = get_field("related-story-post3") ?: '';
$related_post3_title = $related_post3 ? $related_post3->post_title : '';
$related_post3_url = $related_post3 ? $related_post3->guid : '';
$related_post3_cat = $related_post3 ? get_the_terms($related_post3->ID, 'story_category') : '';
$related_post3_thumb = get_post_meta($related_post3->ID, 'thumbnail_img', true) ? get_post_meta($related_post3->ID, 'thumbnail_img', true) : get_post_meta($related_post3->ID, 'main_img', true);
$related_post3_thumb_url = $related_post3_thumb ? wp_get_attachment_image_url($related_post3_thumb, 'story_thumb_size') : $global_vars['nophoto']["common"];


// その他のおすすめサービス
$recommended_args = [
	'posts_per_page' => 3,
	'post_type' => "services",
	'post__not_in' => array($post->ID),
];

if ($cat_id !== "") {
	$recommended_args['tax_query'] = [
		[
			'taxonomy' => 'service_tag',
			'field' => 'term_id',
			'terms' => $cat_id,
			'orderby' => 'rand',
		]
	];
}

$recommended_query = new WP_Query($recommended_args);

?>

<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<article class="l-service-detail" >
	<header class="c-page-header p-service-detail-header" style="background-image: url(<?php echo $kv_image?>);">
    <div class="l-contents__wrapper">
      <h1 class="c-page-header__heading p-service-detail-header__heading">
        <b class="c-page-header__directory" lang="en">Service</b>
        <span class="c-page-header__text-group">
					<?php if (get_field('lead_text')) : ?>
          <span class="c-page-header__sub-text"><?php the_field('lead_text') ?></span>
					<?php endif; ?>
          <span class="c-page-header__main-text"><?php get_field('service_title') ? the_field('service_title') : the_title(); ?></span>
        </span>
      </h1>
    </div>
  </header>

	<section class="l-service-detail__section">
    <header class="l-contents__wrapper c-section-header -md-no-border">
      <h2 class="c-section-header__heading">サービス詳細</h2>
    </header>
    <div class="l-contents__wrapper p-service-detail-description">
			<div class="p-service-detail-description__text-group">
				<?php the_content(); ?>
			</div>
			<?php if ($cat): ?>
      <ul class="p-service-detail-section__tag-list">
				<?php foreach ($cat as $c) : ?>
        <li class="p-service-detail-section__tag-item">
					<?php echo $c->name; ?>
        </li>
				<?php endforeach; ?>
      </ul>
			<?php endif; ?>
    </div>
  </section>
	<?php if (get_field('events')) : ?>
	<section class="l-service-detail__section">
    <header class="l-contents__wrapper c-section-header">
      <h2 class="c-section-header__heading">開催スケジュール</h2>
    </header>
		<?php foreach (get_field('events') as $event): ?>
    <div class="l-contents__wrapper">
      <div class="p-service-detail-schedule">
        <p class="p-service-detail-schedule__highlight"><?php echo esc_html($event['event_title']) ?></p>
        <dl class="p-service-detail-schedule__list">
					<?php foreach ($event["event_list"] as $list_item): ?>
          <dt class="p-service-detail-schedule__key"><?php echo brTxt($list_item["title"]) ?></dt>
          <dd class="p-service-detail-schedule__value"><?php echo $list_item["text"] ?></dd>
					<?php endforeach; ?>
        </dl>
      </div>
    </div>
		<?php endforeach; ?>
  </section>
	<?php endif; ?>

	<?php if ($related_post1 || $related_post2 || $related_post3): ?>
	<section class="l-service-detail__section">
    <header class="l-contents__wrapper c-section-header">
      <h2 class="c-section-header__heading"><?php the_title(); ?>で<br class="u-hidden-md-up">生まれた物語</h2>
    </header>
    <div class="l-contents__wrapper p-service-detail-story">
      <ul class="p-story-body__list">
					<?php if ($related_post1): ?>
					<li class="p-story">
						<a class="p-story__text" href="<?php echo esc_url($related_post1_url); ?>"><?php get_limited_text($related_post1_title, 35); ?></a>
						<?php if ($related_post1_cat): ?>
						<ul class="p-story__tag-list">
							<?php $category = wp_get_object_terms($post->ID, $taxonomy); ?>
							<?php foreach ($related_post1_cat as $c): ?>
							<li>
								<a class="c-tag" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo esc_html($c->slug); ?>"><?php echo esc_html($c->name); ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<figure class="p-story__media p-service-detail-story__media<?php echo get_podcast_block($related_post1) ? ' -podcast' : ''; ?>">
							<img class="p-story__image" src="<?php echo esc_url($related_post1_thumb_url); ?>" alt="">
						</figure>
					</li>
					<?php endif; ?>
					<?php if ($related_post2): ?>
					<li class="p-story">
						<a class="p-story__text" href="<?php echo esc_url($related_post2_url); ?>"><?php get_limited_text($related_post2_title, 35); ?></a>
						<?php if ($related_post2_cat): ?>
						<ul class="p-story__tag-list">
							<?php $category = wp_get_object_terms($post->ID, $taxonomy); ?>
							<?php foreach ($related_post2_cat as $c): ?>
							<li>
								<a class="c-tag" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo esc_html($c->slug); ?>"><?php echo esc_html($c->name); ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<figure class="p-story__media p-service-detail-story__media<?php echo get_podcast_block($related_post2) ? ' -podcast' : ''; ?>">
							<img class="p-story__image" src="<?php echo esc_url($related_post2_thumb_url); ?>" alt="">
						</figure>
					</li>
					<?php endif; ?>
					<?php if ($related_post3): ?>
					<li class="p-story">
						<a class="p-story__text" href="<?php echo esc_url($related_post3_url); ?>"><?php get_limited_text($related_post3_title, 35); ?></a>
						<?php if ($related_post3_cat): ?>
						<ul class="p-story__tag-list">
							<?php $category = wp_get_object_terms($post->ID, $taxonomy); ?>
							<?php foreach ($related_post3_cat as $c): ?>
							<li>
								<a class="c-tag" href="<?php echo esc_url(home_url('/')); ?>/stories/?category=<?php echo esc_html($c->slug); ?>"><?php echo esc_html($c->name); ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<figure class="p-story__media p-service-detail-story__media<?php echo get_podcast_block($related_post3) ? ' -podcast' : ''; ?>">
							<img class="p-story__image" src="<?php echo esc_url($related_post3_thumb_url); ?>" alt="">
						</figure>
					</li>
					<?php endif; ?>
      </ul>
    </div>
  </section>
	<?php endif; ?>

	<?php if ($gallery): ?>
	<section class="l-service-detail__section">
    <header class="l-contents__wrapper c-section-header">
      <h2 class="c-section-header__heading">写真ギャラリー</h2>
    </header>
    <div class="l-contents__wrapper p-gallery">
      <div class="p-gallery__list">
				<?php $counter = 1; foreach ($gallery as $g):
					$thumb = $g['img'];
					$thumb_img = $thumb ? $thumb['sizes']['gallery_thumb_size'] : $global_vars['nophoto']["common"];
					$gallery_img = $thumb ? $thumb['sizes']['gallery_image_size'] : $global_vars['nophoto']["common"];
					$caption = $g['caption'];
				?>
				<div class="p-gallery__item">
					<a class="js-modal" href="#gallery_<?php echo $counter; ?>">
						<img src="<?php echo esc_url($thumb_img); ?>" alt="">
					</a>
				</div>
				<figure class="mfp-hide" id="gallery_<?php echo $counter; ?>">
          <img src="<?php echo esc_url($gallery_img); ?>" alt="">
          <figcaption class="p-gallery__caption"><?php echo esc_html($caption); ?></figcaption>
        </figure>
				<?php $counter++; endforeach; ?>
      </div>
    </div>
  </section>
	<?php endif; ?>
	<?php if ($recommended_query->have_posts()): ?>
	<section class="l-service-detail__section">
    <header class="l-contents__wrapper c-section-header">
      <h2 class="c-section-header__heading">その他のおすすめサービス</h2>
    </header>
    <div class="l-contents__wrapper p-service-detail-recommend">
			<?php while ($recommended_query->have_posts()) : $recommended_query->the_post();

			// サムネイル画像
			$thumb = get_field("main_img");
			$thumb = $thumb ? $thumb['url'] : $global_vars['nophoto']["common"];
			?>
        <section class="p-service-detail-recommend__item">
					<div class="p-service-detail-recommend__text-block">
						<h3 class="p-service-detail-recommend__heading">
							<a class="p-service-detail-recommend__link" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
						</h3>
						<?php if (get_field('lead_text')) : ?>
						<p class="p-service-detail-recommend__text"><?php the_field('lead_text') ?></p>
						<?php endif; ?>
						<?php $cat = wp_get_object_terms($post->ID, 'service_tag'); if ($cat): ?>
						<ul class="p-service-detail-recommend__tag-list">
							<?php foreach ($cat as $c) : ?>
							<li class="p-service-detail-recommend__tag-item">
								<?php echo $c->name; ?>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
          <figure class="p-service-detail-recommend__media">
            <img class="p-service-detail-recommend__image" src="<?php echo esc_url($thumb); ?>" alt="">
          </figure>
        </section>
			<?php endwhile; ?>
    </div>
		<?php wp_reset_postdata(); ?>
  </section>
	<?php endif; ?>
	<div class="l-sticky-footer p-sticky-footer">
    <a href="<?php echo esc_url(home_url('/entry')); ?>" class="c-button -primary -contained -fix">申し込む</a>
  </div>
</article>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
