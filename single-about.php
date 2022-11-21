<?php

// メインコピー画像
$main_copy = get_field("main_copy_img");
$main_copy = $main_copy ? $main_copy['sizes']['story_kv_image_size'] : $global_vars['nophoto']["common"];

// コンパス一覧
$compass_args = array(
	'post_type' => 'about',
	'posts_per_page' => -1,
	'post__not_in' => array($post->ID),
);
$compass_query = new WP_Query($compass_args);
?>

<?php get_template_part('includes/head'); ?>
<?php get_template_part('includes/header'); ?>
<div class="p-about-kv2 js-fade-in-scroll-ul">
	<div class="p-about-kv2__unit1">
		<div class="p-about-kv2__unit1__inner1">
			<?php if (get_field('main_copy')) : ?>
				<h1 class="p-about-kv2__unit1__title1 js-fade-in-scroll-li"><?php the_field('main_copy') ?></h1>
			<?php endif; ?>
			<?php if (get_field('update_date')) : ?>
				<p class="p-about-kv2__unit1__text1 js-fade-in-scroll-li">Update <?php the_field('update_date') ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="p-about-block7">
	<div class="p-about-block7__inner1">
		<div class="p-about-block7__editor1 js-fade-in-scroll-ul">
			<?php if (get_field('speaker')) :?>
				<div class="p-about-block7__item p-about-block7__speaker js-fade-in-scroll-li">
					<h2 class="p-about-block7__speaker-heading"><?php echo get_field('speaker')['heading']; ?></h2>
					<p class="p-about-block7__speaker-text"><?php echo get_field('speaker')['text']; ?></p>
				</div>
			<?php endif; ?>
			<?php if (have_rows('dialog')) : ?>
				<?php while (have_rows('dialog')) : the_row(); ?>
					<div class="p-about-block7__item js-fade-in-scroll-li">
						<h2><?php the_sub_field('name'); ?></h2>
						<p><?php the_sub_field('text'); ?></p>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php if (get_field('description')) : ?>
			<p class="p-about-block7__text1 js-fade-in-scroll"><?php the_field('description') ?></p>
		<?php endif; ?>
	</div>
</div>
<?php if ($compass_query->have_posts()) : ?>
	<section class="p-about-block3">
		<div class="p-about-block3__inner1">
			<div class="js-fade-in-scroll-ul">
				<h2 class="p-about-block3__title1 js-fade-in-scroll-li">コンパス</h2>
				<p class="p-about-block3__text1 js-fade-in-scroll-li">コンパスのリード文を入れる、自己づくり、チームづくり、まちづくりの<br>3つの軸で事業を展開しています。</p>
			</div>
			<ul class="p-about-block3__list1 js-fade-in-scroll-ul">
				<?php while ($compass_query->have_posts()) : $compass_query->the_post(); ?>
					<li class="js-fade-in-scroll-li">
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
				<?php endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
<?php endif; ?>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
