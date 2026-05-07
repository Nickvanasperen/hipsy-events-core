<?php
/**
 * Core Query System — v4.0
 * 
 * Query ID systeem voor koppeling tussen filters en grids.
 * Maakt AJAX filtering mogelijk.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Haal events op met query parameters en optional Query ID
 * 
 * @param array $args Query arguments
 * @return WP_Query
 */
function hipsy_get_events_query( $args = [] ) {
    
    $defaults = [
        'post_type'      => 'events',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'orderby'        => 'meta_value',
        'meta_key'       => 'hipsy_events_date',
        'order'          => 'ASC',
        'meta_query'     => [],
    ];
    
    $args = wp_parse_args( $args, $defaults );
    
    // Alleen toekomstige events?
    if ( ! empty( $args['alleen_toekomst'] ) && $args['alleen_toekomst'] === 'yes' ) {
        $args['meta_query'][] = [
            'key'     => 'hipsy_events_date',
            'value'   => current_time( 'Y-m-d\TH:i' ),
            'compare' => '>=',
            'type'    => 'DATETIME',
        ];
        unset( $args['alleen_toekomst'] );
    }
    
    // Categorie filter
    if ( ! empty( $args['filter_categorie'] ) ) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'event_categorie',
                'field'    => 'term_id',
                'terms'    => intval( $args['filter_categorie'] ),
            ],
        ];
        unset( $args['filter_categorie'] );
    }
    
    // Exclude specifiek event
    if ( ! empty( $args['exclude_event'] ) ) {
        $args['post__not_in'] = [ intval( $args['exclude_event'] ) ];
        unset( $args['exclude_event'] );
    }
    
    // Auto-exclude huidig event (voor dynamic templates)
    if ( ! empty( $args['auto_exclude'] ) && $args['auto_exclude'] === 'yes' && is_singular( 'events' ) ) {
        $args['post__not_in'] = [ get_the_ID() ];
        unset( $args['auto_exclude'] );
    }
    
    return new WP_Query( $args );
}

/**
 * Registreer Query ID voor gebruik door filters
 * Slaat query parameters op in global registry
 */
global $hipsy_query_registry;
$hipsy_query_registry = [];

function hipsy_register_query( $query_id, $args ) {
    global $hipsy_query_registry;
    $hipsy_query_registry[ $query_id ] = $args;
}

function hipsy_get_registered_query( $query_id ) {
    global $hipsy_query_registry;
    return isset( $hipsy_query_registry[ $query_id ] ) ? $hipsy_query_registry[ $query_id ] : null;
}
