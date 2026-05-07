<?php
/**
 * Flatsome (UX Builder) Integration Loader
 * 
 * Laadt UX Builder shortcodes voor Hipsy Events.
 * Werkt alleen als Flatsome theme actief is.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Check of Flatsome actief is en registreer shortcodes
 */
function hipsy_load_flatsome_elements() {
    // Check of Flatsome/UX Builder beschikbaar is
    if ( ! function_exists( 'flatsome_setup' ) && ! class_exists( 'UxBuilder' ) ) {
        return;
    }
    
    // Check of shortcode functie bestaat
    if ( ! function_exists( 'add_ux_builder_shortcode' ) ) {
        return;
    }
    
    // Registreer Events Grid shortcode
    hipsy_register_flatsome_events_grid();
    
    // Enqueue Flatsome CSS
    add_action( 'wp_enqueue_scripts', 'hipsy_flatsome_enqueue_css' );
}

/**
 * Enqueue Flatsome-specific CSS
 */
function hipsy_flatsome_enqueue_css() {
    // Hergebruik bestaande widget CSS (werkt prima met Flatsome)
    wp_enqueue_style(
        'hipsy-events-flatsome',
        plugin_dir_url( __FILE__ ) . '../../styles/dist/widget-styles.css',
        array(),
        '4.4.0'
    );
}

/**
 * Registreer Events Grid UX Builder element
 */
function hipsy_register_flatsome_events_grid() {
    
    add_ux_builder_shortcode( 'hipsy_events_grid', array(
        'name'      => 'Events Grid',
        'category'  => 'Hipsy Events',
        'priority'  => 1,
        
        'options' => array(
            
            // Layout
            'layout' => array(
                'type'    => 'select',
                'heading' => 'Layout',
                'default' => 'grid',
                'options' => array(
                    'grid'      => 'Grid',
                    'lijst'     => 'Lijst',
                    'carrousel' => 'Carrousel',
                    'kalender'  => 'Kalender',
                    'agenda'    => 'Agenda',
                ),
            ),
            
            'kolommen' => array(
                'type'    => 'slider',
                'heading' => 'Kolommen',
                'default' => 3,
                'min'     => 1,
                'max'     => 4,
            ),
            
            // Filter
            'aantal' => array(
                'type'    => 'slider',
                'heading' => 'Aantal events',
                'default' => 12,
                'min'     => 1,
                'max'     => 50,
            ),
            
            'sorteer' => array(
                'type'    => 'select',
                'heading' => 'Sortering',
                'default' => 'datum_asc',
                'options' => array(
                    'datum_asc'  => 'Datum (oplopend)',
                    'datum_desc' => 'Datum (aflopend)',
                ),
            ),
            
            // Content toggles
            'toon_afbeelding' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon afbeelding',
                'default' => 'true',
            ),
            
            'toon_datum' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon datum',
                'default' => 'true',
            ),
            
            'toon_tijd' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon tijd',
                'default' => 'true',
            ),
            
            'toon_titel' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon titel',
                'default' => 'true',
            ),
            
            'toon_locatie' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon locatie',
                'default' => 'true',
            ),
            
            'toon_beschrijving' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon beschrijving',
                'default' => 'true',
            ),
            
            'toon_prijs' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon prijs',
                'default' => 'true',
            ),
            
            'toon_knoppen' => array(
                'type'    => 'checkbox',
                'heading' => 'Toon knoppen',
                'default' => 'true',
            ),
        ),
    ));
    
    // Shortcode render functie
    add_shortcode( 'hipsy_events_grid', 'hipsy_render_flatsome_grid' );
}

/**
 * Render Events Grid shortcode voor Flatsome
 */
function hipsy_render_flatsome_grid( $atts ) {
    
    // Parse attributes
    $atts = shortcode_atts( array(
        'layout'           => 'grid',
        'kolommen'         => 3,
        'aantal'           => 12,
        'sorteer'          => 'datum_asc',
        'toon_afbeelding'  => 'true',
        'toon_datum'       => 'true',
        'toon_tijd'        => 'true',
        'toon_titel'       => 'true',
        'toon_locatie'     => 'true',
        'toon_beschrijving'=> 'true',
        'toon_prijs'       => 'true',
        'toon_knoppen'     => 'true',
    ), $atts );
    
    // Hergebruik de bestaande Elementor widget render logica
    // Door simpelweg de Elementor widget class te instantiëren
    // en zijn render functie te gebruiken
    
    // Voor nu: simpele implementatie met WP_Query
    $query_args = array(
        'post_type'      => 'events',
        'posts_per_page' => (int) $atts['aantal'],
        'orderby'        => 'meta_value',
        'meta_key'       => 'hipsy_events_date',
        'order'          => $atts['sorteer'] === 'datum_desc' ? 'DESC' : 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'hipsy_events_date',
                'value'   => date( 'Y-m-d\TH:i' ),
                'compare' => '>=',
                'type'    => 'DATETIME',
            ),
        ),
    );
    
    $events_query = new WP_Query( $query_args );
    
    if ( ! $events_query->have_posts() ) {
        return '<p>Geen events gevonden.</p>';
    }
    
    // Render grid
    ob_start();
    
    echo '<div class="hipsy-flatsome-grid row row-small" data-columns="' . esc_attr( $atts['kolommen'] ) . '">';
    
    while ( $events_query->have_posts() ) {
        $events_query->the_post();
        $event_id = get_the_ID();
        
        $col_class = 'col medium-' . ( 12 / (int) $atts['kolommen'] );
        
        echo '<div class="' . esc_attr( $col_class ) . '">';
        echo '<div class="hew-card">';
        
        // Afbeelding
        if ( $atts['toon_afbeelding'] === 'true' && has_post_thumbnail() ) {
            echo '<div class="hew-card-img">';
            echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( $event_id, 'large' ) . '</a>';
            echo '</div>';
        }
        
        echo '<div class="hew-card-body">';
        
        // Datum
        if ( $atts['toon_datum'] === 'true' ) {
            $datum_raw = get_post_meta( $event_id, 'hipsy_events_date', true );
            if ( $datum_raw && function_exists( 'hipsy_format_datum' ) ) {
                $datum = hipsy_format_datum( $datum_raw, 'volledig' );
                echo '<div class="hew-datum">' . esc_html( strtoupper( $datum ) ) . '</div>';
            }
        }
        
        // Titel
        if ( $atts['toon_titel'] === 'true' ) {
            echo '<h3 class="hew-titel"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
        }
        
        // Tijd
        if ( $atts['toon_tijd'] === 'true' ) {
            $datum_raw = get_post_meta( $event_id, 'hipsy_events_date', true );
            $einde_raw = get_post_meta( $event_id, 'hipsy_events_date_end', true );
            if ( $datum_raw && function_exists( 'hipsy_format_tijd' ) ) {
                $tijd = hipsy_format_tijd( $datum_raw, $einde_raw );
                if ( $tijd ) {
                    echo '<div class="hew-tijd">🕐 ' . esc_html( $tijd ) . '</div>';
                }
            }
        }
        
        // Locatie
        if ( $atts['toon_locatie'] === 'true' ) {
            $locatie = get_post_meta( $event_id, 'hipsy_events_location', true );
            if ( $locatie ) {
                echo '<div class="hew-locatie">📍 ' . esc_html( $locatie ) . '</div>';
            }
        }
        
        // Beschrijving
        if ( $atts['toon_beschrijving'] === 'true' ) {
            $desc = wp_trim_words( get_the_content(), 20 );
            if ( $desc ) {
                echo '<p class="hew-desc">' . wp_kses_post( $desc ) . '</p>';
            }
        }
        
        // Prijs
        if ( $atts['toon_prijs'] === 'true' ) {
            $ticket_info = get_post_meta( $event_id, 'hipsy_ticket_info', true );
            if ( $ticket_info ) {
                $prijs = hipsy_get_lowest_price( $ticket_info );
                if ( $prijs ) {
                    echo '<div class="hew-prijs">' . esc_html( $prijs ) . '</div>';
                }
            }
        }
        
        // Knoppen
        if ( $atts['toon_knoppen'] === 'true' ) {
            echo '<div class="hew-card-actions">';
            echo '<a href="' . get_permalink() . '" class="button is-outline">Meer info</a>';
            
            $ticket_url = get_post_meta( $event_id, 'hipsy_events_link', true );
            if ( $ticket_url ) {
                echo '<a href="' . esc_url( $ticket_url ) . '" class="button primary" target="_blank">Bestel tickets</a>';
            }
            echo '</div>';
        }
        
        echo '</div>'; // .hew-card-body
        echo '</div>'; // .hew-card
        echo '</div>'; // .col
    }
    
    echo '</div>'; // .row
    
    wp_reset_postdata();
    
    return ob_get_clean();
}

/**
 * Helper: Get lowest ticket price
 */
function hipsy_get_lowest_price( $ticket_info ) {
    if ( empty( $ticket_info ) ) {
        return '';
    }
    
    $tickets = maybe_unserialize( $ticket_info );
    if ( ! is_array( $tickets ) || empty( $tickets ) ) {
        return '';
    }
    
    $lowest = null;
    foreach ( $tickets as $ticket ) {
        $price = isset( $ticket['price'] ) ? floatval( $ticket['price'] ) : 0;
        if ( $lowest === null || ( $price > 0 && $price < $lowest ) ) {
            $lowest = $price;
        }
    }
    
    if ( $lowest === 0 || $lowest === null ) {
        return 'Gratis';
    }
    
    return 'Vanaf €' . number_format( $lowest, 2, ',', '.' );
}

// Laad Flatsome elements wanneer UX Builder ready is
add_action( 'ux_builder_setup', 'hipsy_load_flatsome_elements' );
add_action( 'init', 'hipsy_load_flatsome_elements', 20 );
