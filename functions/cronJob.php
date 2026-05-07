<?php
$frequency = 'hourly';

if (!wp_next_scheduled('refresh_hipsy_events')) {
    wp_schedule_event(time(), $frequency, 'refresh_hipsy_events');
}

add_action('refresh_hipsy_events', 'refresh_hipsy_events_func');
function refresh_hipsy_events_func($test_mode = false) {
    $api_key = get_option('hipsy_events_api_key');
    $org_slug = get_option('hipsy_events_organisation_slug');

    if (!$api_key || !$org_slug) {
        update_option('hipsy_events_last_sync_error', 'API key of organisation slug ontbreekt.');
        return false;
    }

    // Haal events op van Hipsy API
    $events = get_hipsy_events($api_key, $org_slug);
    
    if (isset($events["message"]) || !is_array($events)) {
        $error_msg = isset($events["message"]) ? $events["message"] : 'Kon Hipsy events niet ophalen.';
        update_option('hipsy_events_last_sync_error', $error_msg);
        hipsy_log_error('API call gefaald: ' . $error_msg);
        return false;
    }

    // Test mode: sync alleen eerste 3 events
    if ($test_mode) {
        $events = array_slice($events, 0, 3);
    }

    // Sync statistieken
    $total = count($events);
    $success = 0;
    $failed = 0;
    $errors = array();

    // Loop door events MET error handling per event
    foreach ($events as $event) {
        try {
            $result = createEvent($event);
            
            if ($result) {
                $success++;
            } else {
                $failed++;
                $errors[] = 'Event gefaald: ' . ($event['title'] ?? 'Onbekend');
            }
            
        } catch (Exception $e) {
            $failed++;
            $errors[] = 'Event exception: ' . ($event['title'] ?? 'Onbekend') . ' - ' . $e->getMessage();
            hipsy_log_error('Event sync exception: ' . $e->getMessage());
        }
        
        // Kleine pauze tussen events om server te ontlasten
        usleep(100000); // 0.1 seconde
    }

    // Opslaan sync resultaat
    $sync_result = array(
        'total' => $total,
        'success' => $success,
        'failed' => $failed,
        'errors' => $errors,
        'timestamp' => current_time('mysql'),
        'test_mode' => $test_mode
    );
    
    update_option('hipsy_events_last_sync_result', $sync_result);
    update_option('hipsy_events_last_sync', current_time('mysql'));
    
    if ($failed > 0) {
        update_option('hipsy_events_last_sync_error', 
            sprintf('%d van %d events gefaald. Check error log.', $failed, $total)
        );
    } else {
        delete_option('hipsy_events_last_sync_error');
    }

    return true;
}
