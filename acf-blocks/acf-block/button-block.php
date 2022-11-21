<?php
if ( ( get_field('button-block-text') ) ) {
  $btn_text = get_field('button-block-text');
	$btn_url = get_field('button-block-url');
	$external_link = get_field('external_link');
}
?>
<p class="p-post-body__cta-button">
	<a class="c-button -primary -contained" href="<?php echo esc_url($btn_url); ?>"<?php echo $external_link ? ' target="_blank"' : '' ?>><?php echo esc_html($btn_text); ?></a>
</p>
