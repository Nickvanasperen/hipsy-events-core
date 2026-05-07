<?php
/**
 * AJAX Filter Handler — v4.0
 * 
 * Handles AJAX requests for event filtering.
 * Works with Query IDs to connect filters to specific grids.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register AJAX actions
 */
add_action( 'wp_ajax_hipsy_filter_events', 'hipsy_ajax_filter_events' );
add_action( 'wp_ajax_nopriv_hipsy_filter_events', 'hipsy_ajax_filter_events' );

/**
 * AJAX handler voor event filtering
 */
function hipsy_ajax_filter_events() {
    
    // Security check
    check_ajax_referer( 'hipsy_filter_nonce', 'nonce' );
    
    // Get filter parameters
    $query_id   = sanitize_text_field( $_POST['query_id'] ?? '' );
    $categorie  = sanitize_text_field( $_POST['categorie'] ?? '' );
    $locatie    = sanitize_text_field( $_POST['locatie'] ?? '' );
    $zoekterm   = sanitize_text_field( $_POST['zoekterm'] ?? '' );
    $layout     = sanitize_text_field( $_POST['layout'] ?? 'grid' );
    
    // Get base query args from registry or defaults
    $base_args = hipsy_get_registered_query( $query_id ) ?: [
        'posts_per_page' => 6,
        'alleen_toekomst' => 'yes',
    ];
    
    // Apply filters
    if ( ! empty( $categorie ) ) {
        $base_args['tax_query'] = [
            [
                'taxonomy' => 'event_categorie',
                'field'    => 'slug',
                'terms'    => $categorie,
            ],
        ];
    }
    
    if ( ! empty( $locatie ) ) {
        $base_args['meta_query'][] = [
            'key'     => 'hipsy_events_location',
            'value'   => $locatie,
            'compare' => 'LIKE',
        ];
    }
    
    if ( ! empty( $zoekterm ) ) {
        $base_args['s'] = $zoekterm;
    }
    
    // Execute query
    $query = hipsy_get_events_query( $base_args );
    
    // Render results
    ob_start();
    
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Gebruik de render engine om cards te genereren
            hipsy_render_event_card( get_the_ID(), [
                'layout' => $layout,
                'show_image' => true,
                'show_date' => true,
                'show_time' => true,
                'show_title' => true,
                'show_location' => true,
                'show_description' => true,
                'show_price' => true,
                'show_button' => true,
                'max_words' => 20,
                'button_text' => 'Bestel tickets',
            ]);
        }
        wp_reset_postdata();
    } else {
        echo '<div class="hew-no-results">';
        echo '<p>Geen events gevonden met deze filters.</p>';
        echo '</div>';
    }
    
    $html = ob_get_clean();
    
    wp_send_json_success( [
        'html'  => $html,
        'count' => $query->found_posts,
    ] );
}

/**
 * Enqueue AJAX filter script
 */
add_action( 'wp_enqueue_scripts', 'hipsy_enqueue_filter_script' );

function hipsy_enqueue_filter_script() {
    wp_enqueue_script(
        'hipsy-ajax-filter',
        plugins_url( 'assets/js/ajax-filter.js', dirname( __FILE__ ) ),
        [ 'jquery' ],
        '4.0.0',
        true
    );
    
    wp_localize_script( 'hipsy-ajax-filter', 'hipsyAjax', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'hipsy_filter_nonce' ),
    ] );
}
