<?php
if ( ( get_field('heading-medium-block') ) ) {
  $heading_medium = get_field('heading-medium-block');
}

?>
<h3><?php echo brTxt($heading_medium); ?></h3>
