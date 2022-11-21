<?php

// カテゴリー一覧
$terms1 = get_terms('service_category', 'orderby=id');
$terms2 = get_terms('service_theme', 'orderby=id');

$s = $_GET['s'];
$theme = array();
$category = array();

$min_size = intval($_GET['min_size']);
$max_size = intval($_GET['max_size']);

foreach(explode('&', $_SERVER['QUERY_STRING']) as $param){
	$p = explode('=', $param);
	if($p[0] === 'theme'){
		$theme[] =  $p[1];
	}

	if($p[0] === 'category'){
		$category[] =  $p[1];
	}
}


if (!empty($_GET)) {
	$taxquerysp = array();
	$taxquerysp['relation'] = 'AND';



	if (isset($_GET['theme'])){
	$taxquerysp[] = array(
		'taxonomy' => 'service_category',
		'field'    => 'slug',
		'terms'    => $theme,
		'operator' => 'IN'
	);
	}

	if(isset($_GET['category'])){
	$taxquerysp[] = array(
		'taxonomy' => 'service_theme',
		'field'    => 'slug',
		'terms'    => $category,
		'operator' => 'IN'
	);
	}

	//サイズ
	if (!empty($min_size) || !empty($max_size)) {
	$size_selected = array(
		'key' => 'size',
		'value' => array($min_size, $max_size),
		'type' => 'NUMERIC',
		'compare' => 'BETWEEN'
	);
	}

	//カスタムフィールドの絞り込み条件指定
    if (!empty($size_selected)) {
		$meta_query = array(
			'relation' => 'AND',
			$size_selected,
		);
		}

	$service_args = array(
		'post_type' => 'services',
		'tax_query' => $taxquerysp,
		'meta_query' => $meta_query,
		's' => $s,
		'posts_per_page' => -1,
	);
} else {
	$service_args = [
		'post_type' => "services",
		'posts_per_page' => -1,
	];
}


$service_query = new WP_Query($service_args);

?>
<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<article>
	<header class="c-page-header">
		<div class="c-page-header__wrapper -narrow">
			<h1 class="c-page-header__heading">
				<b class="c-page-header__directory" lang="en">Service</b>
				<span class="c-page-header__main-text">サービス一覧</span>
			</h1>
		</div>
	</header>

<p>
<!-- <?php var_dump($service_args['tax_query']); ?> -->
</p>
	<section class="l-contents__wrapper -narrow">
		<div class="p-service-header">
			<form method="get" id="form-pc" action="">
			<label for="s" class="assistive-text">検索</label>
			<input type="text" class="field" name="s" id="s" placeholder="検索" />
				<div class="p-service-header__filter-area">
					<div class="p-service-header__tab-list u-hidden-md-down">
						<label class="c-radio-tab">
							<input class="c-radio-tab__input js-radio-all" type="checkbox" name="" value="">
							<span class="c-radio-tab__label">All</span>
						</label>
						<?php foreach ($terms1 as $term) : ?>
							<label class="c-radio-tab">
								<input class="c-radio-tab__input" type="checkbox" name="theme" value="<?php echo $term->slug; ?>">
								<span class="c-radio-tab__label"><?php echo esc_html($term->name); ?></span>
							</label>
						<?php endforeach; ?>
					</div>

					<div class="p-service-header__tag-list u-hidden-md-down" id="js_category_pc">
						<?php foreach ($terms2 as $term) : ?>
							<label class="c-radio-tag">
								<input class="c-radio-tag__input" type="checkbox" name="category" value="<?php echo $term->slug; ?>">
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

					<h3>サイズから探す</h3>
					<select name="min_size">
						<option value="">指定なし</option>
						<option value="10">10cm</option>
						<option value="20">20cm</option>
						<option value="30">30cm</option>
						<option value="40">40cm</option>
						<option value="50">50cm</option>
						<option value="100">100cm</option>
					</select>
					<p>~</p>
					<select name="max_size">
						<option value="">指定なし</option>
						<option value="10">10cm</option>
						<option value="20">20cm</option>
						<option value="30">30cm</option>
						<option value="40">40cm</option>
						<option value="50">50cm</option>
						<option value="100">100cm</option>
					</select>
				</div>
				<button type="submit">検索する</button>
			</form>
			<div class="u-hidden-md-up">
				<div class="p-service-header__filter-area">
					<button class="p-service-header__filter-button js-open-modal" type="button">サービスを絞り込む
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
						サービスを絞り込む
						<button class="c-semi-modal__close js-close-modal" type="reset" aria-label="閉じる"><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
								<path d="M12.2005 3.80665C11.9405 3.54665 11.5205 3.54665 11.2605 3.80665L8.00047 7.05998L4.74047 3.79998C4.48047 3.53998 4.06047 3.53998 3.80047 3.79998C3.54047 4.05998 3.54047 4.47998 3.80047 4.73998L7.06047 7.99998L3.80047 11.26C3.54047 11.52 3.54047 11.94 3.80047 12.2C4.06047 12.46 4.48047 12.46 4.74047 12.2L8.00047 8.93998L11.2605 12.2C11.5205 12.46 11.9405 12.46 12.2005 12.2C12.4605 11.94 12.4605 11.52 12.2005 11.26L8.94047 7.99998L12.2005 4.73998C12.4538 4.48665 12.4538 4.05998 12.2005 3.80665Z" />
							</svg>
						</button>
					</div>
					<div class="c-semi-modal__body">
						<form method="get" id="form-sp">
							<div class="p-service-header__tab-list">
								<label class="c-radio-tag">
									<input class="c-radio-tag__input js-radio-all" type="radio" name="" value="">
									<span class="c-radio-tag__label">
										<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.2005 3.80665C11.9405 3.54665 11.5205 3.54665 11.2605 3.80665L8.00047 7.05998L4.74047 3.79998C4.48047 3.53998 4.06047 3.53998 3.80047 3.79998C3.54047 4.05998 3.54047 4.47998 3.80047 4.73998L7.06047 7.99998L3.80047 11.26C3.54047 11.52 3.54047 11.94 3.80047 12.2C4.06047 12.46 4.48047 12.46 4.74047 12.2L8.00047 8.93998L11.2605 12.2C11.5205 12.46 11.9405 12.46 12.2005 12.2C12.4605 11.94 12.4605 11.52 12.2005 11.26L8.94047 7.99998L12.2005 4.73998C12.4538 4.48665 12.4538 4.05998 12.2005 3.80665Z" />
										</svg>
										<span class="c-radio-tag__remove">削除</span>
										All
									</span>
								</label>
								<?php foreach ($terms1 as $term) : ?>
									<label class="c-radio-tag">
										<input class="c-radio-tag__input" type="radio" name="theme" value="<?php echo $term->slug; ?>">
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

							<div class="p-service-header__tag-list" id="js_category_sp">
								<?php foreach ($terms2 as $term) : ?>
									<label class="c-radio-tag">
										<input class="c-radio-tag__input" type="radio" name="category" value="<?php echo $term->slug; ?>">
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
						</form>
					</div>
				</dialog>
			</div>
		</div>
		<div class="p-service-body">
			<div class="p-service-body__contents">
				<?php if ( $service_query->have_posts() ) : while ( $service_query->have_posts() ) : $service_query->the_post();
						// サムネイル画像
						$thumb = get_field("main_img");
						$thumb = $thumb ? $thumb['url'] : $global_vars['nophoto']["common"];
				?>
						<section class="p-service__item js-fade-in-scroll">
							<div class="p-service__text-block">
								<h3 class="p-service__heading">
									<a class="p-service__link" href="<?php echo get_the_title() == '森のような組織をはぐくむセッション' ? home_url('/forbiz/#section1') : the_permalink(); ?>"><?php echo the_title(); ?></a>
								</h3>
								<?php if (get_field('lead_text')) : ?>
									<p class="p-service__text"><?php the_field('lead_text') ?></p>
								<?php endif; ?>

								<?php $category = wp_get_object_terms($post->ID, 'service_tag');
								if ($category) : ?>
									<ul class="p-service__tag-list">
										<?php foreach ($category as $c) : ?>
											<li class="p-service__tag-item">
												<?php echo $c->name; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
							<figure class="p-service__media">
								<img class="p-service__image" src="<?php echo esc_url($thumb); ?>" alt="">
							</figure>
						</section>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</section>
	<section class="l-contents__wrapper p-service-hagukumu u-hidden-md-down  js-fade-in-scroll">
		<div class="p-service-hagukumu__figure-group">
			<figure>
				<picture>
					<source srcset="<?php echo get_template_directory_uri(); ?>/assets/static/images/service/img_hagukumu@2x.png 2x">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/static/images/service/img_hagukumu.png" alt="3つの三角形が並び、それぞれが少しずつ重なり合っている図：左下Self Design、右下Work Design、中央上Town Design" width="352" height="333" loading="lazy">
				</picture>
			</figure>
			<p class="p-service-hagukumu__forest">
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
		<div class="p-service-hagukumu__text-group">
			<section class="p-service-hagukumu__design-group">
				<h2 class="p-service-hagukumu__heading -self-design">自己をはぐくむ Self Design</h2>
				<?php $cat1 = get_field('cat1_service_list', 'option');
				if ($cat1) : ?>
					<ul class="p-service-hagukumu__list">
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
			</section>
			<section class="p-service-hagukumu__design-group">
				<h2 class="p-service-hagukumu__heading -work-design">会社をはぐくむ Work Design</h2>
				<ul class="p-service-hagukumu__list">
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
			</section>
			<section class="p-service-hagukumu__design-group">
				<h2 class="p-service-hagukumu__heading -town-design">街をはぐくむ Town Design</h2>
				<?php $cat2 = get_field('cat2_service_list', 'option');
				if ($cat2) : ?>
					<ul class="p-service-hagukumu__list">
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
			</section>
		</div>
	</section>
</article>
<?php get_template_part('includes/footer'); ?>
<!-- ボタンに選択中タグ名表示 -->
<script>
	let active_input = document.querySelector("input:checked + span .js-label-name") ? document.querySelector("input:checked + span .js-label-name").textContent : 'All';
	const current_tag = document.querySelector(".js-current-tag")
	current_tag.textContent = active_input;
</script>
<?php get_footer(); ?>
