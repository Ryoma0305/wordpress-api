<?php
// -----------------------------------------------------------------
// API END POINT
// -----------------------------------------------------------------


// -----------------------------------------------------------------
// Top
// -----------------------------------------------------------------
function add_rest_endpoint_all_slides_from_top()
{
  register_rest_route(
    'wp/api',
    '/top',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_slides_from_top'
    )
  );

  register_rest_field( 'paged',
    'acf',
     array(
      'get_callback'    => 'register_fields',
      'update_callback' => null,
      'schema'          => null,
    )
  );

}


function get_all_slides_from_top()
{
    $result = get_field('key_visual', 'option');
    // $data = array(
    //     'key_visual' => get_field('key_visual', 'option'),
    //     'cat1_service_list' => get_field('cat1_service_list', 'option'),
    //     'cat2_service_list' => get_field('cat2_service_list', 'option'),
    // );

    // array_push($result, $data);
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_slides_from_top');


// -----------------------------------------------------------------
// Stories
// -----------------------------------------------------------------
function add_rest_endpoint_all_posts_from_stories()
{
  register_rest_route(
    'wp/api',
    '/stories',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_posts_from_stories'
    )
  );
}

function get_all_posts_from_stories()
{
    $result = array();

    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'stories',
      'post_status' => 'publish'
    );
    $all_posts = get_posts($args);
    foreach ($all_posts as $post) {
      $data = array(
        'ID' => $post->ID,
        'URL' => $post->guid,
        'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
        'slug' => $post->post_name,
        'date' => $post->post_date,
        'modified' => $post->post_modified,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'content' => $post->post_content,
        'category' => get_the_terms($post->ID, 'story_category')[0]->name,
        'category_slug' => get_the_terms($post->ID, 'story_category')[0]->slug,
        'main_img' => get_field('main_img', $post->ID),
        'thumbnail_img' => get_field('thumbnail_img', $post->ID),
      );

      array_push($result, $data);
    };
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_posts_from_stories');


// -----------------------------------------------------------------
// Stories detail
// -----------------------------------------------------------------

function add_rest_endpoint_single_posts_from_stories() {
  register_rest_route(
    'wp/api',
    '/stories-detail',
    array(
      'methods' => 'GET',
      'callback' => 'get_single_posts_from_stories',
      'permission_callback' => function() { return true; }
    )
  );
}
function get_single_posts_from_stories($parameter) {
  $limit = $parameter->get_param('limit');
  $offset = $parameter->get_param('offset');
  if(is_null($limit)){
    $limit = 5;
  }

  if(is_null($offset)){
    $offset = 0;
  }

  $args_all = array(
    'posts_per_page' => -1,
    'post_type' => 'stories',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
  );
  $all_posts = get_posts($args_all);
  $posts = array_slice($all_posts, $offset, $limit);

  $next = null;
  $prev = null;
  if($offset > 0){
    $prev = $offset - $limit;
    if($prev < 0){
      $prev = 0;
    }
  }

  if($offset < (count($all_posts) - $limit)){
    $next = $offset + $limit;
    if($next > (count($all_posts) - $limit)){
      $next = (count($all_posts) - $limit);
    }
  }
  // o o o o o o o o o o
  //           ↑(count - limit)
  //   ↑(offset)
  //           ↑(next)

  $json = array();
  $result = array();

  foreach($posts as $post) {
    $data = array(
      'ID' => $post->ID,
      'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
      'slug' => $post->post_name,
      'date' => $post->post_date,
      'modified' => $post->post_modified,
      'title' => $post->post_title,
      'excerpt' => $post->post_excerpt,
      'content' => $post->post_content,
      'category' => get_the_terms($post->ID, 'story_category')[0]->name,
    );
    array_push($result, $data);
  };
  $json['count'] = count($all_posts);

  if(is_null($prev)){
    $json['prev'] = 'null';
  }else{
    $json['prev'] = 'http://practicearimuraryomacom.local/wp-json/wp/api/stories-detail?offset=' . $prev . '&limit=' . $limit;
  }

  if(is_null($next)){
    $json['next'] = 'null';
  }else{
    $json['next'] = 'http://practicearimuraryomacom.local/wp-json/wp/api/stories-detail?offset=' . $next . '&limit=' . $limit;
  }

  $json['results'] = $result;
  return $json;
}
add_action('rest_api_init', 'add_rest_endpoint_single_posts_from_stories');


// -----------------------------------------------------------------
// Stories category
// -----------------------------------------------------------------
function add_rest_endpoint_all_categories_from_stories()
{
  register_rest_route(
    'wp/api',
    '/story_category',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_categories_from_stories'
    )
  );
}

function get_all_categories_from_stories()
{
    $result = get_terms('story_category');
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_categories_from_stories');


// -----------------------------------------------------------------
// Services
// -----------------------------------------------------------------
function add_rest_endpoint_all_posts_from_services()
{
  register_rest_route(
    'wp/api',
    '/services',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_posts_from_services'
    )
  );

  register_rest_field( 'services',
    'og_img',
     array(
      'get_callback'    => 'register_fields',
      'update_callback' => null,
      'schema'          => null,
    )
  );

}

function register_fields( $post, $name ) {
    return get_post_meta( $post[ 'id' ], $name, true );
}


function get_all_posts_from_services()
{
    $result = array();
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'services',
      'post_status' => 'publish'
    );
    $all_posts = get_posts($args);
    foreach ($all_posts as $post) {
      $data = array(
        // 'post' => $post,
        'ID' => $post->ID,
        'URL' => $post->guid,
        'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
        'slug' => $post->post_name,
        'date' => $post->post_date,
        'modified' => $post->post_modified,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'content' => $post->post_content,
        'service_category' => get_the_terms($post->ID, 'service_category'),
        'service_theme' => get_the_terms($post->ID, 'service_theme'),
        'service_tag' => get_the_terms($post->ID, 'service_tag'),
        'service_title' => get_field('service_title', $post->ID),
        'lead_text' => get_field('lead_text', $post->ID),
        'main_img' => get_field('main_img', $post->ID),
        'og_img' => get_field('og_img', $post->ID),
        'events' => get_field('events', $post->ID),
        'gallery' => get_field('gallery', $post->ID),
        'related-story-post1' => get_field('related_story_post1', $post->ID),
        'related-story-post2' => get_field('related_story_post2', $post->ID),
        'related-story-post3' => get_field('related_story_post3', $post->ID),
        'gallery' => get_field('gallery', $post->ID),
      );
      array_push($result, $data);
    };
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_posts_from_services');


// -----------------------------------------------------------------
// Services detail
// -----------------------------------------------------------------
function add_rest_endpoint_single_posts_from_services() {
  register_rest_route(
    'wp/api',
    '/services/(?P<id>\S+)',
    array(
      'methods' => 'GET',
      'callback' => 'get_single_posts_from_services',
      'permission_callback' => function() { return true; }
    )
  );
}
function get_single_posts_from_services($parameter) {

    $result = array();
    $args_single = array(
    'posts_per_page' => 1,
    'post_type' => 'services',
    'post_status' => 'publish',
    // 'name' => $parameter['slug'],
    'include' => $parameter['id'],
    );

    $single_post = get_posts($args_single);

    foreach($single_post as $post) {
    $data = array(
        'ID' => $post->ID,
        'URL' => $post->guid,
        'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
        'slug' => $post->post_name,
        'date' => $post->post_date,
        'modified' => $post->post_modified,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'content' => $post->post_content,
        'post_author' => $post->post_author,
        // 'category' => get_the_terms($post->ID, 'service_category')[0]->name,
    );
    array_push($result, $data);
    };
    return $result;

}
add_action('rest_api_init', 'add_rest_endpoint_single_posts_from_services');


// -----------------------------------------------------------------
// Services category
// -----------------------------------------------------------------
function add_rest_endpoint_all_service_category()
{
  register_rest_route(
    'wp/api',
    '/service_category',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_service_category'
    )
  );
}

function get_all_service_category()
{
    $result = get_terms('service_category');
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_service_category');

// -----------------------------------------------------------------
// Services theme
// -----------------------------------------------------------------
function add_rest_endpoint_all_service_theme()
{
  register_rest_route(
    'wp/api',
    '/service_theme',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_service_theme'
    )
  );
}

function get_all_service_theme()
{
    $result = get_terms('service_theme');
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_service_theme');


// -----------------------------------------------------------------
// Compass
// -----------------------------------------------------------------
function add_rest_endpoint_all_posts_from_compass()
{
  register_rest_route(
    'wp/api',
    '/about',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_posts_from_compass'
    )
  );

  register_rest_field( 'about',
    'acf',
     array(
      'get_callback'    => 'register_fields',
      'update_callback' => null,
      'schema'          => null,
    )
  );

}


function get_all_posts_from_compass()
{
    $result = array();
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'about',
      'post_status' => 'publish'
    );
    $all_posts = get_posts($args);
    foreach ($all_posts as $post) {
      $data = array(
        'ID' => $post->ID,
        'URL' => $post->guid,
        'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
        'slug' => $post->post_name,
        'date' => $post->post_date,
        'modified' => $post->post_modified,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'content' => $post->post_content,
        'main_copy' => get_field('main_copy', $post->ID),
        'update_date' => get_field('update_date', $post->ID),
        'speaker' => get_field('speaker', $post->ID),
        'dialog' => get_field('dialog', $post->ID),
        'description' => get_field('description', $post->ID),
      );
      array_push($result, $data);
    };
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_posts_from_compass');


// -----------------------------------------------------------------
// Authors
// -----------------------------------------------------------------
function add_rest_endpoint_all_posts_from_authors()
{
  register_rest_route(
    'wp/api',
    '/authors',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_posts_from_authors'
    )
  );

  register_rest_field( 'authors',
    'acf',
     array(
      'get_callback'    => 'register_fields',
      'update_callback' => null,
      'schema'          => null,
    )
  );

}


function get_all_posts_from_authors()
{
    $result = array();
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'authors',
      'post_status' => 'publish'
    );
    $all_posts = get_posts($args);
    foreach ($all_posts as $post) {
      $data = array(
        'ID' => $post->ID,
        'date' => $post->post_date,
        'modified' => $post->post_modified,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'content' => $post->post_content,
        'author_img' => get_field('author_img', $post->ID),
        'name_jp' => get_field('name_jp', $post->ID),
        'name_en' => get_field('name_en', $post->ID),
        'profile_text' => get_field('profile_text', $post->ID),
        'related_post1' => get_field('related_post1', $post->ID),
        'related_post2' => get_field('related_post2', $post->ID),
      );
      array_push($result, $data);
    };
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_posts_from_authors');


// -----------------------------------------------------------------
// Forbiz
// -----------------------------------------------------------------
function add_rest_endpoint_all_posts_from_forbiz()
{
  register_rest_route(
    'wp/api',
    '/forbiz',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_posts_from_forbiz'
    )
  );
}

function get_all_posts_from_forbiz()
{
    $result = array();
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'stories',
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'story_category',
          'field' => 'slug',
          'terms' => 'work-design' ? 'work-design' : '',
        )
      )
    );
    $all_posts = get_posts($args);

    foreach($all_posts as $post) {
      $data = array(
        'ID' => $post->ID,
        'URL' => $post->guid,
        'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
        'slug' => $post->post_name,
        'date' => $post->post_date,
        'modified' => $post->post_modified,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'content' => $post->post_content,
        'category' => get_the_terms($post->ID, 'story_category')[0]->name,
        'main_img' => get_field('main_img', $post->ID),
        'thumbnail_img' => get_field('thumbnail_img', $post->ID),
      );

      array_push($result, $data);
    };
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_posts_from_forbiz');


// -----------------------------------------------------------------
// Forbiz programs
// -----------------------------------------------------------------
function add_rest_endpoint_all_programs_from_forbiz()
{
  register_rest_route(
    'wp/api',
    '/forbiz_programs',
    array(
      'methods' => 'GET',
      'callback' => 'get_all_programs_from_forbiz'
    )
  );

  register_rest_field( 'paged',
    'acf',
     array(
      'get_callback'    => 'register_fields',
      'update_callback' => null,
      'schema'          => null,
    )
  );
}

function get_all_programs_from_forbiz()
{
    $result =  get_field('program', 186);
    return $result;
}
add_action('rest_api_init', 'add_rest_endpoint_all_programs_from_forbiz');

