<?php
/**
 * Plugin Name: Latest Post in Order Email
 * Plugin URI: https://morfjord.com
 * Description: This plugin adds the latest post to WooCommerce order completion email.
 * Version: 1.0
 * Author: Martin Morfjord
 * Author URI: https://morfjord.com
 * License: GPL2
 */

// Hook for adding content of the latest post to the WooCommerce email
function add_latest_post_to_order_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( 'customer_completed_order' === $email->id ) {
        // Get the latest post
        $args = array(
            'numberposts' => 1,
            'post_type'   => 'post'
        );
        $latest_posts = get_posts( $args );
        $latest_post = array_shift( $latest_posts );

        // Add post content to the email
        if ( $latest_post ) {
            echo '<h2>' . $latest_post->post_title . '</h2>';
            echo apply_filters( 'the_content', $latest_post->post_content );
        }
    }
}
add_action( 'woocommerce_email_order_details', 'add_latest_post_to_order_email', 20, 4 );

?>
