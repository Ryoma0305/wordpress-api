<?php
if ( ( get_field('heading_block') ) ) {
  $heading = get_field('heading_block');
}

?>

<h2><?php echo brTxt($heading); ?></h2>
