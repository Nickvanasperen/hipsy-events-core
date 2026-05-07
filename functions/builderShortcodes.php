<?php
/** Builder-onafhankelijke Hipsy shortcodes voor Salient/WPBakery/Gutenberg/Elementor. */
if ( ! defined( 'ABSPATH' ) ) exit;

function hipsy_sc_bool( $value, $default = true ) {
    if ( $value === null || $value === '' ) return $default;
    return in_array( strtolower( (string) $value ), array( '1', 'true', 'yes', 'ja', 'on' ), true );
}

function hipsy_sc_enqueue_styles() {
    static $done = false;
    if ( $done ) return;
    $done = true;
    wp_register_style( 'hipsy-builder-shortcodes', false, array(), '1.3.0' );
    wp_enqueue_style( 'hipsy-builder-shortcodes' );
    wp_add_inline_style( 'hipsy-builder-shortcodes', '
.hipsy-bsc{--hipsy-accent:#6b21c8;--hipsy-border:#e5e7eb;--hipsy-text:#111827;--hipsy-muted:#6b7280;--hipsy-bg:#fff;display:block;color:var(--hipsy-text)}.hipsy-bsc *{box-sizing:border-box}.hipsy-bsc a{text-decoration:none}.hipsy-bsc-empty{padding:1rem;border:1px dashed var(--hipsy-border);border-radius:12px;color:var(--hipsy-muted)}
.hipsy-bsc-grid{display:grid;gap:1.25rem;grid-template-columns:repeat(var(--cols,3),minmax(0,1fr))}@media(max-width:980px){.hipsy-bsc-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:680px){.hipsy-bsc-grid{grid-template-columns:1fr}}
.hipsy-bsc-card{background:var(--hipsy-bg);border:1px solid var(--hipsy-border);border-radius:18px;overflow:hidden;box-shadow:0 8px 24px rgba(15,23,42,.06);height:100%;display:flex;flex-direction:column;transition:transform .18s ease,box-shadow .18s ease}.hipsy-bsc-card:hover{transform:translateY(-2px);box-shadow:0 14px 34px rgba(15,23,42,.10)}
.hipsy-bsc-media{aspect-ratio:16/10;background:#f3f4f6;overflow:hidden}.hipsy-bsc-img{width:100%;height:100%!important;object-fit:cover;display:block}.hipsy-bsc-body{padding:1rem 1rem 1.1rem;display:flex;flex-direction:column;gap:.45rem;flex:1}.hipsy-bsc-date{font-size:.78rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;color:var(--hipsy-accent)}.hipsy-bsc-time,.hipsy-bsc-location{font-size:.9rem;color:var(--hipsy-muted)}.hipsy-bsc-title{font-size:1.15rem;line-height:1.25;margin:.1rem 0}.hipsy-bsc-title a{color:inherit}.hipsy-bsc-excerpt{font-size:.94rem;line-height:1.55;color:#374151;margin:0}.hipsy-bsc-price{font-size:.9rem;font-weight:700;color:#059669}.hipsy-bsc-actions{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:auto;padding-top:.55rem}.hipsy-bsc-btn{display:inline-flex;align-items:center;justify-content:center;padding:.65rem .9rem;border-radius:999px;font-weight:700;font-size:.9rem}.hipsy-bsc-btn-info{background:#f3f4f6;color:#374151}.hipsy-bsc-btn-ticket{background:var(--hipsy-accent);color:#fff!important}
.hipsy-bsc-list{display:flex;flex-direction:column;gap:1rem}.hipsy-bsc-list .hipsy-bsc-card{display:grid;grid-template-columns:220px 1fr;min-height:160px}.hipsy-bsc-list .hipsy-bsc-media{aspect-ratio:auto;height:100%}@media(max-width:680px){.hipsy-bsc-list .hipsy-bsc-card{grid-template-columns:1fr}.hipsy-bsc-list .hipsy-bsc-media{aspect-ratio:16/10}}
.hipsy-bsc-agenda{display:flex;flex-direction:column;gap:.85rem}.hipsy-bsc-month{font-size:1.25rem;margin:1.2rem 0 .15rem}.hipsy-bsc-row{display:grid;grid-template-columns:92px 1fr auto;gap:1rem;align-items:center;padding:1rem;border:1px solid var(--hipsy-border);border-radius:16px;background:#fff}.hipsy-bsc-day{font-weight:800;color:var(--hipsy-accent);text-align:center}.hipsy-bsc-day span{display:block;font-size:1.65rem;line-height:1}.hipsy-bsc-row h3{margin:0;font-size:1.05rem}.hipsy-bsc-row-meta{color:var(--hipsy-muted);font-size:.9rem;margin-top:.25rem}@media(max-width:680px){.hipsy-bsc-row{grid-template-columns:70px 1fr}.hipsy-bsc-row .hipsy-bsc-actions{grid-column:1 / -1}}
.hipsy-bsc-calendar{display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:.4rem}.hipsy-bsc-cal-head{font-weight:800;text-align:center;padding:.5rem;color:var(--hipsy-muted)}.hipsy-bsc-cal-day{min-height:110px;border:1px solid var(--hipsy-border);border-radius:14px;padding:.55rem;background:#fff}.hipsy-bsc-cal-num{font-weight:800;margin-bottom:.4rem}.hipsy-bsc-cal-event{display:block;font-size:.78rem;line-height:1.25;border-radius:9px;padding:.35rem .4rem;margin:.25rem 0;background:#f5f3ff;color:#4c1d95}.hipsy-bsc-cal-empty{background:#fafafa}@media(max-width:760px){.hipsy-bsc-calendar{display:flex;flex-direction:column}.hipsy-bsc-cal-head,.hipsy-bsc-cal-empty{display:none}.hipsy-bsc-cal-day{min-height:auto}}
' );
}

function hipsy_sc_get_events( $atts = array() ) {
    $limit = isset($atts['limit']) ? (int) $atts['limit'] : -1;
    if ( isset($atts['aantal']) && $atts['aantal'] !== '' ) $limit = (int) $atts['aantal'];
    if ( $limit === 0 ) $limit = -1;
    $args = array(
        'post_type' => 'events', 'posts_per_page' => $limit, 'post_status' => 'publish',
        'meta_key' => 'hipsy_events_date', 'orderby' => 'meta_value',
        'order' => ( isset($atts['order']) && strtoupper($atts['order']) === 'DESC' ) ? 'DESC' : 'ASC',
    );
    if ( hipsy_sc_bool( $atts['future'] ?? $atts['alleen_toekomst'] ?? 'yes', true ) ) {
        $args['meta_query'] = array(array('key'=>'hipsy_events_date','value'=>current_time('Y-m-d\TH:i'),'compare'=>'>=','type'=>'CHAR'));
    }
    $term = $atts['category'] ?? $atts['categorie'] ?? '';
    if ( $term !== '' && taxonomy_exists('event_categorie') ) {
        $args['tax_query'] = array(array('taxonomy'=>'event_categorie','field'=>is_numeric($term) ? 'term_id' : 'slug','terms'=>is_numeric($term) ? (int)$term : sanitize_title($term)));
    }
    $q = new WP_Query($args); $events = array();
    if ( $q->have_posts() ) {
        while ( $q->have_posts() ) { $q->the_post(); $id = get_the_ID();
            $tickets = function_exists('hipsy_get_tickets') ? hipsy_get_tickets($id) : array(); $prices = array();
            if ( is_array($tickets) ) foreach ($tickets as $ticket) if (isset($ticket['price']) && (float)$ticket['price'] > 0) $prices[] = (float)$ticket['price'];
            $events[] = array(
                'id'=>$id, 'title'=>get_the_title(), 'permalink'=>get_permalink(), 'ticket_url'=>get_post_meta($id,'hipsy_events_link',true),
                'date'=>get_post_meta($id,'hipsy_events_date',true), 'date_end'=>get_post_meta($id,'hipsy_events_date_end',true), 'location'=>get_post_meta($id,'hipsy_events_location',true),
                'thumb'=>has_post_thumbnail($id) ? get_the_post_thumbnail($id,'large',array('class'=>'hipsy-bsc-img')) : '',
                'excerpt'=>wp_trim_words(wp_strip_all_tags(get_post_field('post_content',$id)), isset($atts['words']) ? (int)$atts['words'] : 24),
                'price'=>$prices ? 'Vanaf '.(function_exists('hipsy_format_prijs') ? hipsy_format_prijs(min($prices)) : '€'.number_format(min($prices),2,',','.')) : ($tickets ? 'Gratis' : ''),
            );
        }
        wp_reset_postdata();
    }
    return $events;
}

function hipsy_sc_format_date( $raw, $format = 'kort' ) { return function_exists('hipsy_format_datum') ? hipsy_format_datum($raw,$format) : $raw; }
function hipsy_sc_format_time( $start, $end ) { return function_exists('hipsy_format_tijd') ? hipsy_format_tijd($start,$end) : ''; }

function hipsy_sc_card( $event, $atts = array() ) {
    $show_img = hipsy_sc_bool($atts['image'] ?? 'yes', true); $show_desc = hipsy_sc_bool($atts['description'] ?? 'yes', true); $show_price = hipsy_sc_bool($atts['price'] ?? 'yes', true);
    ob_start(); ?>
    <article class="hipsy-bsc-card">
        <?php if ( $show_img && $event['thumb'] ) : ?><a class="hipsy-bsc-media" href="<?php echo esc_url($event['permalink']); ?>"><?php echo $event['thumb']; ?></a><?php endif; ?>
        <div class="hipsy-bsc-body">
            <?php if ( $event['date'] ) : ?><div class="hipsy-bsc-date"><?php echo esc_html(hipsy_sc_format_date($event['date'], $atts['date_format'] ?? 'kort')); ?></div><?php endif; ?>
            <?php $time = hipsy_sc_format_time($event['date'], $event['date_end']); if ( $time ) : ?><div class="hipsy-bsc-time"><?php echo esc_html($time); ?></div><?php endif; ?>
            <h3 class="hipsy-bsc-title"><a href="<?php echo esc_url($event['permalink']); ?>"><?php echo esc_html($event['title']); ?></a></h3>
            <?php if ( $event['location'] ) : ?><div class="hipsy-bsc-location">📍 <?php echo esc_html($event['location']); ?></div><?php endif; ?>
            <?php if ( $show_desc && $event['excerpt'] ) : ?><p class="hipsy-bsc-excerpt"><?php echo esc_html($event['excerpt']); ?></p><?php endif; ?>
            <?php if ( $show_price && $event['price'] ) : ?><div class="hipsy-bsc-price"><?php echo esc_html($event['price']); ?></div><?php endif; ?>
            <div class="hipsy-bsc-actions"><a class="hipsy-bsc-btn hipsy-bsc-btn-info" href="<?php echo esc_url($event['permalink']); ?>"><?php echo esc_html($atts['info_text'] ?? 'Meer info'); ?></a><?php if ( $event['ticket_url'] ) : ?><a class="hipsy-bsc-btn hipsy-bsc-btn-ticket" href="<?php echo esc_url($event['ticket_url']); ?>" target="_blank" rel="noopener"><?php echo esc_html($atts['button_text'] ?? 'Bestel tickets'); ?></a><?php endif; ?></div>
        </div>
    </article>
    <?php return ob_get_clean();
}

function hipsy_events_grid_shortcode( $atts ) {
    $atts = shortcode_atts(array('limit'=>6,'aantal'=>'','columns'=>3,'future'=>'yes','category'=>'','categorie'=>'','order'=>'ASC','words'=>24,'image'=>'yes','description'=>'yes','price'=>'yes','date_format'=>'kort','button_text'=>'Bestel tickets','info_text'=>'Meer info'), $atts, 'hipsy_events_grid');
    hipsy_sc_enqueue_styles(); $events = hipsy_sc_get_events($atts); if (!$events) return '<div class="hipsy-bsc hipsy-bsc-empty">Geen events gevonden.</div>';
    $cols = max(1,min(4,(int)$atts['columns'])); $out = '<div class="hipsy-bsc hipsy-bsc-grid" style="--cols:'.$cols.'">'; foreach($events as $event) $out .= hipsy_sc_card($event,$atts); return $out.'</div>';
}
add_shortcode('hipsy_events_grid','hipsy_events_grid_shortcode');

function hipsy_events_list_shortcode( $atts ) {
    $atts = shortcode_atts(array('limit'=>10,'future'=>'yes','category'=>'','categorie'=>'','order'=>'ASC','words'=>28,'image'=>'yes','description'=>'yes','price'=>'yes','date_format'=>'kort','button_text'=>'Bestel tickets','info_text'=>'Meer info'), $atts, 'hipsy_events_list');
    hipsy_sc_enqueue_styles(); $events = hipsy_sc_get_events($atts); if (!$events) return '<div class="hipsy-bsc hipsy-bsc-empty">Geen events gevonden.</div>';
    $out = '<div class="hipsy-bsc hipsy-bsc-list">'; foreach($events as $event) $out .= hipsy_sc_card($event,$atts); return $out.'</div>';
}
add_shortcode('hipsy_events_list','hipsy_events_list_shortcode');

function hipsy_events_agenda_shortcode( $atts ) {
    $atts = shortcode_atts(array('limit'=>20,'future'=>'yes','category'=>'','categorie'=>'','order'=>'ASC','button_text'=>'Tickets','info_text'=>'Meer info'), $atts, 'hipsy_events_agenda');
    hipsy_sc_enqueue_styles(); $events = hipsy_sc_get_events($atts); if (!$events) return '<div class="hipsy-bsc hipsy-bsc-empty">Geen events gevonden.</div>';
    $out = '<div class="hipsy-bsc hipsy-bsc-agenda">'; $current_month = '';
    foreach ($events as $event) { $dt = function_exists('hipsy_parse_datetime') ? hipsy_parse_datetime($event['date']) : null; $month_label = $dt ? date_i18n('F Y', $dt->getTimestamp()) : '';
        if ($month_label && $month_label !== $current_month) { $current_month = $month_label; $out .= '<h2 class="hipsy-bsc-month">'.esc_html($month_label).'</h2>'; }
        $day = $dt ? $dt->format('d') : ''; $day_name = $dt ? date_i18n('D', $dt->getTimestamp()) : ''; $time = hipsy_sc_format_time($event['date'],$event['date_end']);
        $out .= '<article class="hipsy-bsc-row"><div class="hipsy-bsc-day">'.esc_html($day_name).'<span>'.esc_html($day).'</span></div><div><h3><a href="'.esc_url($event['permalink']).'">'.esc_html($event['title']).'</a></h3><div class="hipsy-bsc-row-meta">'.esc_html(trim($time.($event['location'] ? ' · '.$event['location'] : ''))).'</div></div><div class="hipsy-bsc-actions"><a class="hipsy-bsc-btn hipsy-bsc-btn-info" href="'.esc_url($event['permalink']).'">'.esc_html($atts['info_text']).'</a>';
        if ($event['ticket_url']) $out .= '<a class="hipsy-bsc-btn hipsy-bsc-btn-ticket" href="'.esc_url($event['ticket_url']).'" target="_blank" rel="noopener">'.esc_html($atts['button_text']).'</a>';
        $out .= '</div></article>'; }
    return $out.'</div>';
}
add_shortcode('hipsy_events_agenda','hipsy_events_agenda_shortcode');
add_shortcode('hipsy_events_calendar','hipsy_events_agenda_shortcode');

function hipsy_events_month_shortcode( $atts ) {
    $atts = shortcode_atts(array('limit'=>100,'future'=>'yes','category'=>'','categorie'=>''), $atts, 'hipsy_events_month');
    hipsy_sc_enqueue_styles(); $events = hipsy_sc_get_events($atts); $first = ($events && function_exists('hipsy_parse_datetime')) ? hipsy_parse_datetime($events[0]['date']) : new DateTime(current_time('Y-m-01')); if (!$first) $first = new DateTime(current_time('Y-m-01'));
    $year=(int)$first->format('Y'); $month=(int)$first->format('n'); $start=new DateTime(sprintf('%04d-%02d-01',$year,$month)); $days=(int)$start->format('t'); $offset=(int)$start->format('N')-1; $by_day=array();
    foreach($events as $event){ $dt=function_exists('hipsy_parse_datetime') ? hipsy_parse_datetime($event['date']) : null; if($dt && (int)$dt->format('Y')===$year && (int)$dt->format('n')===$month) $by_day[(int)$dt->format('j')][]=$event; }
    $out='<div class="hipsy-bsc"><h2 class="hipsy-bsc-month">'.esc_html(date_i18n('F Y',$start->getTimestamp())).'</h2><div class="hipsy-bsc-calendar">'; foreach(array('Ma','Di','Wo','Do','Vr','Za','Zo') as $d) $out.='<div class="hipsy-bsc-cal-head">'.$d.'</div>'; for($i=0;$i<$offset;$i++) $out.='<div class="hipsy-bsc-cal-day hipsy-bsc-cal-empty"></div>';
    for($day=1;$day<=$days;$day++){ $out.='<div class="hipsy-bsc-cal-day"><div class="hipsy-bsc-cal-num">'.$day.'</div>'; foreach($by_day[$day] ?? array() as $event) $out.='<a class="hipsy-bsc-cal-event" href="'.esc_url($event['permalink']).'">'.esc_html($event['title']).'</a>'; $out.='</div>'; }
    return $out.'</div></div>';
}
add_shortcode('hipsy_events_month','hipsy_events_month_shortcode');
