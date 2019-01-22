<?php
/**
 * Created by PhpStorm.
 * User: feader
 * Date: 2018/10/12
 * Time: 17:33
 */

$get = $_GET;

require( dirname(__FILE__) . '/../wp-load.php' );

$term = get_term($get['term_id']);

$args = array(
    'post_type' 			=> 'portfolio',
    'posts_per_page' 		=> 6,
    'paged' 				=> $get['page'],
    'portfolio-types'       => $term->slug,
    'order' 				=> 'ASC',
    'orderby' 				=> 'menu_order',
    'post_status'           => 'publish',
);
$products = query_posts($args);

$products_info = [];

foreach ($products as $k => $v) {
    $products_info[$k]['ID'] = $v->ID;
    $products_info[$k]['name'] = $v->post_title;
    $products_info[$k]['url'] = get_permalink($v->ID) . '/?tid=' .$get['term_id'];
    $products_info[$k]['image'] = get_the_post_thumbnail_url($v->ID,'full');
}

echo json_encode($products_info);

