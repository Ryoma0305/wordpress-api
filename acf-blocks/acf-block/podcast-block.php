<?php
if ( ( get_field('podcast_block') ) ) {
  $podcast = get_field('podcast_block');
}
?>
<figure class="p-post-body__podcast">
	<figcaption class="p-post-body__podcast-caption">この記事をpodcastで聴く</figcaption>
	<?php echo $podcast; ?>
</figure>
