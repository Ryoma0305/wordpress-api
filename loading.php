<?php
  $default_show_posts = 3;
  $default_loading_posts = 3;
  $target_post_type = 'stories';
  require_once(dirname(__FILE__).'/../../../wp-load.php');
  $offset_value = isset($_POST['currently_loaded_count']) ? $_POST['currently_loaded_count'] : $default_show_posts;
  $loading_count = isset($_POST['additional_loading_count']) ? $_POST['additional_loading_count'] : $default_loading_posts;
  $all_posts_query = new WP_Query(
    array(
      'post_type' => $target_post_type,
      'posts_per_page' => -1,
      'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'story_category',
                'field' => 'slug',
                'terms' => get_query_var('category'),
                'operator' => 'AND'
            )
        )
    )
  );
  $infinite_loading_query = new WP_Query(
    array(
      'post_type' => $target_post_type,
      'posts_per_page' => (int)$loading_count,
      'ignore_sticky_posts' => 1,
      'offset' => (int)$offset_value,
        'tax_query' => array(
            array(
                'taxonomy' => 'story_category',
                'field' => 'slug',
                'terms' => get_query_var('category'),
                'operator' => 'AND'
            )
        )
    )
  );
  $posts_count = $all_posts_query->found_posts;
  if($infinite_loading_query->have_posts()):
?>
<?php
  while($infinite_loading_query->have_posts()):
  $infinite_loading_query->the_post();
?>
<?php
  $posts = $infinite_loading_query->posts;
  $remaining_count = $posts_count - $offset_value - 1;
  $contents = array();
  foreach ($posts as $post) {
    $thumb =  get_field('thumbnail_img') ?  get_field('thumbnail_img') : get_field('main_img');
    $img = $thumb ? $thumb['sizes']['story_thumb_size'] : $global_vars['nophoto']["common"];
    $html = '<li class="p-story"><a class="p-story__text" href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>' .'<figure class="p-story__media"><img class="p-story__image" src="'.esc_url($img).'"></figure></li>';
    array_push($contents, $html);
  }
?>
<?php endwhile; ?>
<?php
  $loading_complete = false;
  if($remaining_count < $loading_count) {
    $loading_complete = true;
  }
  echo json_encode(
    array(
      'complete'=>$loading_complete,
      'content'=>$contents
    )
  );
  endif;
?>
<?php wp_reset_postdata(); ?>
