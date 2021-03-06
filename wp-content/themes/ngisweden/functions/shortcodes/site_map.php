<?php

// NGI Site Map Shortcode
// Shows a complete list of all website pages
function ngisweden_site_map_shortcode($atts_raw){
    $html = '';
    foreach (['page', 'methods', 'technologies', 'bioinformatics'] as $pt){
        $post_type = get_post_type_object($pt);
        $html .= '<h3 class="ngisweden_sitemap_posttype_header">'.$post_type->labels->name.'</h3>';
        if(is_post_type_hierarchical($pt)){
            $html .= wp_list_pages(array(
                'post_type' => $pt,
                'sort_column' => 'post_title',
                'title_li' => null,
                'echo' => false,
                //////// DEBUG ONLY
                ///// REMOVE THIS WHEN THE SITE IS GOING LIVE
                'post_status' => 'publish,pending,draft',
            ));
        } else {
            $pages = get_posts(array(
                'post_type' => $pt,
                'orderby' => 'title',
                'numberposts' => -1,
                //////// DEBUG ONLY
                ///// REMOVE THIS WHEN THE SITE IS GOING LIVE
                'post_status' => 'publish,pending,draft',
            ));
            $html .= '<ul>';
            foreach($pages as $page){
                $html .= '<li><a href="'.$page->guid.'">'.$page->post_title.'</a></li>';
            }
            $html .= '</ul>';
        }
    }
    return $html;
}
add_shortcode('ngisweden_site_map', 'ngisweden_site_map_shortcode');
