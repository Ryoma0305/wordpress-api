<?php
if ( ( get_field('heading_small_block') ) ) {
  $heading = get_field('heading_small_block');
}

?>
<h4><?php echo brTxt($heading); ?></h4>
