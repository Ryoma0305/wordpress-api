<?php
if ( ( get_field('list-with-number-block') ) ) {
  $list = get_field('list-with-number-block');
}
?>
<ol>
	<?php foreach ( $list as $l) : ?>
		<li>
			<?php echo brTxt($l['list_item']); ?>
		</li>
	<?php endforeach; ?>
</ol>
