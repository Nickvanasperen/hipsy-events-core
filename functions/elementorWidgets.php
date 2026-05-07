<?php
/** Elementor widgets bundled into Hipsy Events Unified. */
if ( ! defined( 'ABSPATH' ) ) exit;

// FIX: defined() guards zodat dubbele activatie geen fatal error geeft
if ( ! defined( 'HIPSY_EW_PATH' ) )    define( 'HIPSY_EW_PATH',    plugin_dir_path( dirname( __FILE__ ) ) );
if ( ! defined( 'HIPSY_EW_URL' ) )     define( 'HIPSY_EW_URL',     plugin_dir_url( dirname( __FILE__ ) ) );
if ( ! defined( 'HIPSY_EW_VERSION' ) ) define( 'HIPSY_EW_VERSION', '4.0.8' );

// ── 1. TAXONOMY ──────────────────────────────────────────────────────
// FIX: alleen registreren als de Hipsy plugin actief is (post type 'events' bestaat)
add_action( 'init', function() {
    if ( ! post_type_exists( 'events' ) ) return;
    if ( taxonomy_exists( 'event_categorie' ) ) return; // al geregistreerd door andere plugin
    register_taxonomy( 'event_categorie', 'events', [
        'labels' => [
            'name'          => 'Event Categorieën',
            'singular_name' => 'Categorie',
            'all_items'     => 'Alle categorieën',
            'add_new_item'  => 'Categorie toevoegen',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ]);
}, 11 ); // priority 11: na de Hipsy plugin (priority 10)

// ── 3. ASSETS ────────────────────────────────────────────────────────
// FIX 1: Swiper alleen laden als Elementor actief is op de pagina
//         (voorkomt onnodige laadtijd op pagina's zonder widgets)
// FIX 2: handle 'hipsy-swiper' i.p.v. 'swiper' om conflict met
//         Elementor's eigen Swiper-registratie te vermijden
add_action( 'wp_enqueue_scripts', function() {
    // Emoji-fix: globaal nodig voor alle Hipsy-widgets
    // Koppel aan wp-emoji zodat het alleen laadt als WordPress emojis actief zijn
    if ( wp_style_is( 'wp-emoji', 'registered' ) || true ) {
        // Globale emoji-fix — agressief zodat het overal werkt
    $emoji_css = 'img.emoji{height:1em!important;width:1em!important;max-width:1em!important;min-width:unset!important;max-height:1em!important;vertical-align:-0.1em!important;display:inline!important;margin:0 0.05em!important;padding:0!important;box-shadow:none!important;border:none!important;background:none!important;border-radius:0!important;float:none!important;}';
    // Koppel aan meerdere stylesheets als fallback
    foreach ( ['wp-block-library', 'elementor-frontend', 'elementor-post'] as $handle ) {
        if ( wp_style_is( $handle, 'enqueued' ) || wp_style_is( $handle, 'registered' ) ) {
            wp_add_inline_style( $handle, $emoji_css );
            break;
        }
    }
    // Altijd ook als losse style registreren als geen van bovenstaande geladen is
    if ( ! wp_style_is( 'hipsy-emoji-fix', 'registered' ) ) {
        wp_register_style( 'hipsy-emoji-fix', false, [], HIPSY_EW_VERSION );
        wp_enqueue_style( 'hipsy-emoji-fix' );
        wp_add_inline_style( 'hipsy-emoji-fix', $emoji_css );
    }
    }
});

// Swiper als aparte functie zodat widgets hem kunnen aanroepen
function hipsy_ew_enqueue_swiper() {
    // FIX: gebruik unieke handle 'hipsy-swiper' zodat we Elementor's
    //      eigen Swiper-versie niet overschrijven als die er al is
    if ( ! wp_script_is( 'hipsy-swiper', 'enqueued' ) ) {
        wp_enqueue_style(
            'hipsy-swiper',
            'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css',
            [], '11.0.5'
        );
        wp_enqueue_script(
            'hipsy-swiper',
            'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js',
            [], '11.0.5', true
        );
    }
}

// In editor altijd laden
add_action( 'elementor/editor/after_enqueue_scripts', 'hipsy_ew_enqueue_swiper' );

// ── 4. WIDGETS ───────────────────────────────────────────────────────
add_action( 'plugins_loaded', function() {
    if ( ! did_action( 'elementor/loaded' ) ) {
        // Elementor niet actief - widgets worden niet geladen
        // Shortcodes werken nog steeds!
        add_action( 'admin_notices', function() {
            // Alleen tonen op plugins pagina
            $screen = get_current_screen();
            if ( $screen && $screen->id === 'plugins' ) {
                echo '<div class="notice notice-info is-dismissible">';
                echo '<p><strong>Hipsy Events Builder:</strong> ';
                echo 'Elementor is niet actief. Elementor widgets zijn uitgeschakeld, maar shortcodes werken nog steeds! ';
                echo '<a href="https://wordpress.org/plugins/elementor/" target="_blank">Installeer Elementor</a> voor visuele widgets.';
                echo '</p></div>';
            }
        });
        return;
    }

    require_once HIPSY_EW_PATH . 'includes/helpers.php';

    add_action( 'elementor/widgets/register', function( $manager ) {
        foreach ( [
            'hipsy-events-grid.php'        => 'Hipsy_Events_Grid_Widget',
            'hipsy-event-titel.php'        => 'Hipsy_Event_Titel_Widget',
            'hipsy-event-datum.php'        => 'Hipsy_Event_Datum_Widget',
            'hipsy-event-tijd.php'         => 'Hipsy_Event_Tijd_Widget',
            'hipsy-event-locatie.php'      => 'Hipsy_Event_Locatie_Widget',
            'hipsy-event-beschrijving.php' => 'Hipsy_Event_Beschrijving_Widget',
            'hipsy-event-afbeelding.php'   => 'Hipsy_Event_Afbeelding_Widget',
            'hipsy-event-tickets.php'      => 'Hipsy_Event_Tickets_Widget',
            'hipsy-event-ticketknop.php'   => 'Hipsy_Event_Ticketknop_Widget',
            'hipsy-zoek-filter.php'        => 'Hipsy_Zoek_Filter_Widget',
            'hipsy-reviews.php'            => 'Hipsy_Reviews_Widget',
        ] as $file => $class ) {
            require_once HIPSY_EW_PATH . 'widgets/' . $file;
            $manager->register( new $class() );
        }
    });
});
