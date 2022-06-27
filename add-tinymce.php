<?php
function timo_editor_remove_meta_box() {
    global $post_type;
/**
 *  Check to see if the global $post_type variable exists
 *  and then check to see if the current post_type supports
 *  excerpts. If so, remove the default excerpt meta box
 *  provided by the WordPress core. If you would like to only
 *  change the excerpt meta box for certain post types replace
 *  $post_type with the post_type identifier.
 */
    if (isset($post_type) && post_type_supports($post_type, 'excerpt')){
        remove_meta_box('postexcerpt', $post_type, 'normal');
    } 
}
add_action('admin_menu', 'timo_editor_remove_meta_box');
 
function timo_editor_add_custom_meta_box() {
    global $post_type;
    if (isset($post_type) && post_type_supports($post_type, 'excerpt')){
        add_meta_box('postexcerpt', __('Excerpt'), 'timo_editor_custom_post_excerpt_meta_box', $post_type, 'normal', 'high');
    }
}
add_action( 'add_meta_boxes', 'timo_editor_add_custom_meta_box' );
function timo_editor_custom_post_excerpt_meta_box( $post ) {
    $settings = array( 'textarea_rows' => '12', 'quicktags' => true, 'tinymce' => true);
    wp_editor(html_entity_decode(stripcslashes($post->post_excerpt)), 'excerpt', $settings);
}
?>
