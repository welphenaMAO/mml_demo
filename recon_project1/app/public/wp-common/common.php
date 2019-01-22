<?php
/**
 * Created by PhpStorm.
 * User: feader
 * Date: 2018/07/20
 * Time: 11:21
 */

namespace wp_common;


class Common
{
    /**
     * @param $catId
     * @return array
     */
    public function loadProductByCatId($catId) {

        if (empty($catId)) {

            return [];

        }

        global $wpdb;

        $sql = "SELECT " .
            "tr.object_id,p.guid AS imageUrl ".
            "FROM " .
            "{$wpdb->term_relationships} AS tr " .
            "INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = tr.object_id " .
            "INNER JOIN {$wpdb->posts} AS p ON p.ID = pm.meta_value " .
            "WHERE " .
            "tr.term_taxonomy_id = " . $catId . ' ' .
            "AND pm.meta_key = '_thumbnail_id' ORDER BY tr.object_id DESC" ;

        $results = (array)$wpdb->get_results($sql);

        foreach ($results as $k => $v) {
            $product_info = get_post($v->object_id);
            $results[$k]->ID = $v->object_id;
            $results[$k]->title = $product_info->post_title;
            $results[$k]->content = $product_info->post_content;
            $results[$k]->productLink = get_permalink($v->object_id);
            $results[$k]->excerpt = $product_info->post_excerpt;
        }

        return $results;

    }

    /**
     * @param $id
     * @param string $type
     * @return array
     */
    public function getMainImageUrl($id, $type = '_thumbnail_id'){

        global $wpdb;

        if (empty($id)) {

            return [];

        }

        $sql =  "SELECT " .
            " meta_value " .
            "FROM " .
            "{$wpdb->postmeta} " .
            "WHERE " .
            "post_id = " .  $id . ' ' .
            "AND meta_key = '$type'";

        $results = (array)$wpdb->get_results($sql);

        $post_sql = "SELECT guid FROM {$wpdb->posts} WHERE `ID` = " . $results[0]->meta_value;

        $res = (array)$wpdb->get_results($post_sql);

        return $res[0]->guid;

    }

    /**
     * 根据分类id查除自己以外的同分类产品
     * @param $data
     * @return array
     */
    public function loadMoreProductByCatId($data) {

        if (empty($data)) {

            return [];

        }

        global $wpdb;

        $sql = "SELECT " .
            "tr.object_id,p.guid AS imageUrl ".
            "FROM " .
            "{$wpdb->term_relationships} AS tr " .
            "INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = tr.object_id " .
            "INNER JOIN {$wpdb->posts} AS p ON p.ID = pm.meta_value " .
            "WHERE " .
            "tr.term_taxonomy_id = " . $data['catId'] . ' ' .
            "AND pm.meta_key = '_thumbnail_id' " .
            "AND tr.object_id != " . $data['id'] . ' ' .
            "ORDER BY tr.object_id DESC";
        if ($data['end'] != 0 ) {
            //$sql .= " LIMIT " . $data['start'] . "," . $data['end'];
        }

        $results = (array)$wpdb->get_results($sql);

        $res = [];

        foreach ($results as $k => $v) {
            $each_sql = "SELECT * FROM {$wpdb->posts} WHERE `ID` = " . $v->object_id;
            $product_info = (array)$wpdb->get_results($each_sql);
            $res[$k]['title'] = $product_info[0]->post_title;
            $res[$k]['sort'] = $product_info[0]->menu_order;
            $res[$k]['productLink'] = get_permalink($v->object_id);
            $res[$k]['imageUrl'] = $v->imageUrl;
        }

        if (count($res) > $data['end']) {
            $rand = array_rand($res,$data['end']);

            $res1 = [];

            foreach ($rand as $k => $v) {
                $res1[$k] = $res[$v];
            }

            return $res1;

        } else {
            return $res;
        }
    }

    /**
     * 产品分类页全部输出数据的获取
     * @param $catId
     * @return array
     */
    public function getCategoryInfo($catId){

        global $wpdb;

        $sql = "SELECT " .
            "tt.term_id,t.name,tt.parent,t.slug,tt.description " .
            "FROM " .
            "{$wpdb->term_taxonomy} AS tt " .
            "INNER JOIN {$wpdb->terms} AS t ON t.term_id = tt.term_id " .
            "WHERE " .
            "tt.taxonomy = 'portfolio-types' " .
            "AND tt.term_id = %d " .
            "ORDER BY tt.term_id DESC";

        $sql = $wpdb->prepare($sql,$catId);

        $results = (array)$wpdb->get_results($sql)[0];

        //$rewrite = $this->getOptions("option_name = 'betheme'");

        //$rules = unserialize($rewrite['option_value']);

        $res = [];

        $res['name'] = $results['name'];
        $res['catId'] = $results['term_id'];
        $res['slug'] = $results['slug'];
        //$res['parentId'] = $results['parent'];
        $res['description'] = $results['description'];
        $res['sub_title'] = get_term_meta($results['term_id'],'sub_title')[0];
        //$res['link'] = '/' . $rules['portfolio-tax'] .'/' .$results['slug'] . '/';
        $res['link'] = esc_url(get_category_link($results['term_id']));

        $res['feature_title'] = get_term_meta($results['term_id'],'feature_title')[0];

        $res['feature_content'] = get_term_meta($results['term_id'],'feature_content')[0];

        $features_title_info = $this->getTermMetaInfo('features_title',$results['term_id'],"REGEXP '^features_._title$'");

        $features_content_info = $this->getTermMetaInfo('features_content',$results['term_id'],"REGEXP '^features_._content$'");

        $features_image_info = $this->getTermMetaInfo('features_image_id',$results['term_id'],"REGEXP '^features_._image$'");

        //$image_id = get_term_meta($results['term_id'],'image')[0];

        foreach ($features_title_info as $k => $v) {
            $res['features'][$k]['title'] = $v->features_title;
            $res['features'][$k]['content'] = $features_content_info[$k]->features_content;
            $step_image = get_post($features_image_info[$k]->features_image_id);
            $res['features'][$k]['image'] = $step_image->guid;
            $res['features'][$k]['alt'] = $this->getImageAlt($step_image->guid);
        }

        $res['detail_title'] = get_term_meta($results['term_id'],'detail_title')[0];

        $details_info = $this->getTermMetaInfo('details',$results['term_id'],"REGEXP '^details_._content$'");

        foreach ($details_info as $k => $v) {
            $res['details'][$k]['content'] = $details_info[$k]->details;
        }

//        if ($image_id != '') {
//            $product_image_info = get_post($image_id);
//            $res['image'] = $product_image_info->guid;
//        } else {
//            $res['image'] = '';
//        }

        return $res;
    }

    /**
     * @param $as_name
     * @param $term_id
     * @param $meta_key_str
     * @return array|mixed
     */
    public function getTermMetaInfo($as_name,$term_id,$meta_key_str) {

        global $wpdb;

        $sql = "SELECT " .
            "meta_value AS $as_name " .
            "FROM " .
            "{$wpdb->termmeta} " .
            "WHERE " .
            "term_id = " . $term_id . ' AND ' .
            "meta_key $meta_key_str";

        $res = (array)$wpdb->get_results($sql);

        if (count($res) > 1) {
            return $res;
        } else {
            return $res[0];
        }

    }

    /**
     * @param int $catId
     * @param int $start
     * @param int $end
     * @return array
     */
    public function getCategory($catId = 0 ,$start = 0 ,$end = 0){

        global $wpdb;

        $sql = "SELECT " .
            "tt.term_id,t.name,tt.parent,t.slug,tm.meta_value AS sort,tt.description " .
            "FROM " .
            "{$wpdb->term_taxonomy} AS tt " .
            "INNER JOIN {$wpdb->terms} AS t ON t.term_id = tt.term_id " .
            "INNER JOIN {$wpdb->termmeta} AS tm ON t.term_id = tm.term_id " .
            "WHERE " .
            "tt.taxonomy = 'portfolio-types' " .
            "AND tt.`parent` = %d " .
            "AND tm.meta_key = 'sort' " .
            "ORDER BY tm.meta_value ASC";


        if ($end != 0) {
            $sql .= " LIMIT %d,%d ";
            $sql = $wpdb->prepare($sql,$catId,$start,$end);
        }

        $sql = $wpdb->prepare($sql,$catId);

        $results = (array)$wpdb->get_results($sql);

        //$rewrite = $this->getOptions("option_name = 'betheme'");

        //$rules = unserialize($rewrite['option_value']);

        $res = [];

        foreach ($results as $k => $v) {
            $res[$k]['name'] = $v->name;
            $res[$k]['catId'] = $v->term_id;
            //$res[$k]['parentId'] = $v->parent;
            $res[$k]['sort'] = $v->sort;
            $res[$k]['slug'] = $v->slug;
            $res[$k]['description'] = $v->description;

            //$res[$k]['link'] = '/' . $rules['portfolio-tax'] .'/' .$v->slug . '/';
            $res[$k]['link'] = esc_url(get_category_link($v->term_id));

            $res[$k]['sub_title'] = get_term_meta($v->term_id,'sub_title')[0];

            $image_post_id = get_term_meta($v->term_id,'image')[0];

            if ($image_post_id != '') {
                $product_image_info = get_post($image_post_id);
                $res[$k]['image'] = $product_image_info->guid;
            } else {
                $res[$k]['image'] = '';
            }

            $category_image_post_id = get_term_meta($v->term_id,'category_image')[0];

            if ($category_image_post_id != '') {
                $category_image_info = get_post($category_image_post_id);
                $res[$k]['category_image'] = $category_image_info->guid;
            } else {
                $res[$k]['category_image'] = '';
            }

            $res[$k]['alt'] = $this->getImageAlt($res[$k]['image']);
            $res[$k]['category_alt'] = $this->getImageAlt($res[$k]['category_image']);

        }

        $res = $this->array_sort($res,'sort','asc');

        return $res;

    }

    /**
     * @param int $catId
     * @param int $start
     * @param int $end
     * @return mixed|string|void
     */
    public function getHomeNavCategory($catId = 0,$start = 0 ,$end = 0) {

        global $wpdb;

        $category = $this->getCategory($catId ,$start ,$end );

        foreach ($category as $k => $v) {

            $children = $this->getCategory($v['catId'] ,$start ,8);

            foreach ($children as $k1 => $v1) {
                $each_sql = "SELECT meta_value AS post_id FROM {$wpdb->termmeta} WHERE meta_key = 'image' AND term_id = " . $v1['catId'];
                $product_image_post = (array)$wpdb->get_results($each_sql)[0];

                if (strlen($product_image_post['post_id']) > 0) {
                    $product_image_info = get_post($product_image_post['post_id']);
                    $children[$k1]['image'] = $product_image_info->guid;
                } else {
                    $children[$k1]['image'] = '';
                }
            }
            $category[$k]['children'] = $children;
        }

        return $category;
    }

    public function getOptions($where) {

        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->options} WHERE $where";

        $res = (array)$wpdb->get_results($sql)[0];

        return $res;

    }

    public function getVideoCategory(){

        global $wpdb;

        $sql = "SELECT " .
            "tt.term_id,t.name,tt.parent,t.slug,tm.meta_value AS sort,tt.description " .
            "FROM " .
            "{$wpdb->term_taxonomy} AS tt " .
            "INNER JOIN {$wpdb->terms} AS t ON t.term_id = tt.term_id " .
            "INNER JOIN {$wpdb->termmeta} AS tm ON t.term_id = tm.term_id " .
            "WHERE " .
            "tt.taxonomy = 'video_category' " .
            "AND tm.meta_key = 'sort' " .
            "ORDER BY tm.meta_value ASC";

        $results = (array)$wpdb->get_results($sql);

        foreach ($results as $k => $v) {
            $res[$k]['name'] = $v->name;
            $res[$k]['catId'] = $v->term_id;
            $res[$k]['sort'] = $v->sort;
            $res[$k]['slug'] = $v->slug;
        }

        $res = $this->array_sort($res,'sort','asc');

        return $res;

    }

    public function rand_case_study($ID){
        $args = array(
            'post_type'             => 'case',
            'posts_per_page'        => -1,
            'post_status'           => 'publish',
        );

        $cases = query_posts($args);

        $case_study = [];

        foreach ($cases as $k => $v) {
            if ($ID != $v->ID) {
                $case_study[$k]['name'] = $v->post_title;
                $case_study[$k]['content'] = apply_filters('the_content', $v->post_content);
                $case_study[$k]['link'] = get_permalink($v->ID);
                $case_study[$k]['image'] = get_the_post_thumbnail_url($v->ID,'full');
            }
        }

        $rand = array_rand($case_study,1);
        return $case_study[$rand];
    }

    /**
     * @param $arr
     * @param $keys
     * @param string $type
     * @return array
     */
    public function array_sort($arr,$keys,$type='asc'){

        $keysvalue = $new_array = array();

        foreach ($arr as $k=>$v){
            $keysvalue[$k] = $v[$keys];
        }

        if($type == 'asc'){
            asort($keysvalue);
        }else{
            arsort($keysvalue);
        }

        reset($keysvalue);

        foreach ($keysvalue as $k=>$v){
            $new_array[$k] = $arr[$k];
        }

        return $new_array;

    }

    /**
     * @param $url
     * @return string
     */
    function getImageAlt($url){
        if (!$url) {
            return 'image';
        }
        $id = attachment_url_to_postid($url);
        if (isset($id) && $id) {
            $metas = get_post_meta($id, '_wp_attachment_image_alt');
            if (count($metas) > 0) {
                $alt = $metas[0];
            }
            if (isset($alt) && $alt != '') {
                return $alt;
            }
        }

        $url_arr = explode('/', $url);
        $file_name = end($url_arr);
        $strrev_str = strrev($file_name);
        $strpos_res = strpos($strrev_str, '.');
        $fileName = substr($strrev_str, $strpos_res + 1, strlen($strrev_str));
        $fileName = preg_replace(['/_/','/-/'], ' ', $fileName);
        $fileName = preg_replace(['/\d+\w\d+$/'], '', $fileName);
        //return ucwords(strrev($fileName));
        return strrev($fileName);
    }

}