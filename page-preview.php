<?php
/**
 * Plugin Name: Page Preview
 * Plugin URI: https://github.com/field2/Page-Preview.git
 * Description: A plugin to show page previews
 * Version: 0.1
 * Author: Ben Dunkle (@empireoflight)
 * Author URI: http://bendunkle.com
 * License: GPL2
 */
 
function page_preview($atts,$pageid = null) {
extract(shortcode_atts(array(
        "pageid" => '0'
    ), $atts));
  
$the_query = new WP_Query( 'page_id=' . $pageid . '' );
     global $more;    
if ( $the_query->have_posts() ) {
 
    while ( $the_query->have_posts() ) {
    $the_query->the_post();
    $more=0;
    $title=get_the_title();
    $thumbnail='<a href="' . 
    get_the_permalink() . 
    '">' . get_the_post_thumbnail( $pageid, 'preview' ) . '</a>';
    $content = apply_filters( 'the_content', get_the_content('Continue Reading') );
    $content = str_replace( ']]>', ']]&gt;', $content );
}
} 
return '<div class="callout">' . 
'<h4>' . 
$title . 
'</h4>' . 
$thumbnail . 
$content .
'</div><!-- .callout -->';
}
add_shortcode( 'pagepreview', 'page_preview' );
?>