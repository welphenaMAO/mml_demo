<?php
/**
 * Created by PhpStorm.
 * User: feader
 * Date: 2018/11/08
 * Time: 11:34
 */



require( dirname(__FILE__) . '/../wp-load.php' );


$sql = 'SELECT ' .
       'ID,post_name,post_title ' .
       'FROM ' .
       'wp_posts ' .
       'WHERE ' .
       'post_type = "page" ' .
       'AND ID NOT IN (2,3) ' .
       'AND post_title != "Home"';


$results = (array)$wpdb->get_results($sql);

$res = [];

foreach ($results as $k => $v){
    $res[$k]['ID'] = $v->ID;
    $res[$k]['title'] = $v->post_title;
    $res[$k]['name'] = $v->post_name;
    $res[$k]['link'] = get_permalink($v->ID);
}
echo json_encode($res,true);
