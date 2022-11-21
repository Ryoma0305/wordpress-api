<?php
if ( ( get_field('list_block') ) ) {
  $list = get_field('list_block');
}
?>
<ul>
	<?php foreach ( $list as $l) : ?>
		<li>
			<?php echo brTxt($l['list_item']); ?>
		</li>
	<?php endforeach; ?>
</ul>
