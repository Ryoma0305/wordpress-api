<?php
if ( ( get_field('image_block') ) ) {
  $image = get_field('image_block');
	$image_url = $image['sizes']['acf_block_image_size'];
}
?>
<figure>
	<img src="<?php echo esc_url($image_url); ?>" alt="">
	<figcaption><?php echo esc_html($image['caption']) ?></figcaption>
</figure>
