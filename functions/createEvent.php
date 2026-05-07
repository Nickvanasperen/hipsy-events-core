<?php

function createEvent($event)
{
    try {
        // Valideer verplichte velden
        if (empty($event['title']) || empty($event['date'])) {
            hipsy_log_error('Event mist verplichte velden (title/date): ' . json_encode($event));
            return false;
        }

        // DateTime met error handling
        try {
            $timezone = new DateTimeZone(wp_timezone_string());
            $stored_date = new DateTime($event['date']);
            $stored_date->setTimezone($timezone);

            $stored_date_until = new DateTime($event['date_until']);
            $stored_date_until->setTimezone($timezone);

            $formatted_date = $stored_date->format('Y-m-d\TH:i');
            $formatted_date_until = $stored_date_until->format('Y-m-d\TH:i');
        } catch (Exception $e) {
            hipsy_log_error('Datum parsing gefaald voor event: ' . $event['title'] . ' - ' . $e->getMessage());
            return false;
        }

        // Post aanmaken/updaten
        $post_arr = array(
            'post_title' => sanitize_text_field($event['title']),
            'post_type' => 'events',
            'post_content' => wp_kses_post($event['description'] ?? ''),
            'post_status' => 'publish',
            'meta_input' => array(
                'hipsy_events_location' => sanitize_text_field($event['location'] ?? ''),
                'hipsy_events_date' => $formatted_date,
                'hipsy_events_date_end' => $formatted_date_until,
                'hipsy_events_link' => esc_url_raw($event['url_ticketshop'] ?? ''),
                'hipsy_ticket_info' => serialize($event['tickets'] ?? array())
            ),
        );

        if (get_post($event['id'])) {
            $post_arr['ID'] = $event['id'];
            wp_update_post($post_arr);
            $post_id = $event['id'];
        } else {
            $post_arr['import_id'] = $event['id'];
            $post_id = wp_insert_post($post_arr);
        }

        if (is_wp_error($post_id)) {
            hipsy_log_error('Post aanmaken gefaald: ' . $post_id->get_error_message());
            return false;
        }

        // Image download met error handling (SKIP als dit faalt)
        if (!empty($event['picture'])) {
            try {
                $image = add_external_image_to_media_library($event['picture'], $event['id']);
                if ($image) {
                    set_post_thumbnail($post_id, $image);
                }
            } catch (Exception $e) {
                // Log maar ga door - event zonder image is beter dan helemaal geen event
                hipsy_log_error('Image download gefaald voor event ' . $event['title'] . ': ' . $e->getMessage());
            }
        }

        return $post_id;

    } catch (Exception $e) {
        hipsy_log_error('CreateEvent gefaald: ' . $e->getMessage() . ' voor event: ' . json_encode($event));
        return false;
    }
}

function add_external_image_to_media_library($image_url, $post_id)
{
    try {
        // Valideer URL
        if (empty($image_url) || !filter_var($image_url, FILTER_VALIDATE_URL)) {
            hipsy_log_error('Ongeldige image URL: ' . $image_url);
            return false;
        }

        $upload_dir = wp_upload_dir();
        $filename = basename(strtok($image_url, '?'));

        // Check if file already exists in media library to avoid duplicates
        $existing_attachment = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => '_wp_attached_file',
                    'value' => $filename,
                    'compare' => 'LIKE'
                )
            )
        ));

        if ($existing_attachment) {
            $att_id = $existing_attachment[0]->ID;
            $file_path = get_attached_file($att_id);
            if (file_exists($file_path)) {
                return $att_id;
            }
        }

        // Download image met timeout en error handling
        $response = wp_remote_get($image_url, array(
            'timeout' => 15,
            'sslverify' => false // Voor servers met SSL problemen
        ));

        if (is_wp_error($response)) {
            hipsy_log_error('Image download gefaald: ' . $response->get_error_message());
            return false;
        }

        $image_data = wp_remote_retrieve_body($response);
        
        if (empty($image_data)) {
            hipsy_log_error('Lege image data voor URL: ' . $image_url);
            return false;
        }

        // Bepaal file type
        if (strpos($filename, '.png') !== false) {
            $filetype = 'image/png';
        } elseif (strpos($filename, '.jpg') !== false || strpos($filename, '.jpeg') !== false) {
            $filetype = 'image/jpeg';
        } elseif (strpos($filename, '.webp') !== false) {
            $filetype = 'image/webp';
        } else {
            hipsy_log_error('Onbekend image type: ' . $filename);
            return false;
        }

        $new_file_path = $upload_dir['path'] . '/' . $filename;
        
        // Schrijf file
        $result = file_put_contents($new_file_path, $image_data);
        
        if ($result === false) {
            hipsy_log_error('Kon image niet schrijven naar: ' . $new_file_path);
            return false;
        }

        $attachment = array(
            'post_mime_type' => $filetype,
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $new_file_path);
        
        if (is_wp_error($attach_id)) {
            hipsy_log_error('Attachment aanmaken gefaald: ' . $attach_id->get_error_message());
            return false;
        }

        require_once ABSPATH . 'wp-admin/includes/image.php';
        $attach_data = wp_generate_attachment_metadata($attach_id, $new_file_path);
        wp_update_attachment_metadata($attach_id, $attach_data);

        return $attach_id;

    } catch (Exception $e) {
        hipsy_log_error('Image processing error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Log errors voor debugging
 */
function hipsy_log_error($message) {
    $log = get_option('hipsy_events_error_log', array());
    $log[] = array(
        'time' => current_time('mysql'),
        'message' => $message
    );
    
    // Bewaar alleen laatste 50 errors
    if (count($log) > 50) {
        $log = array_slice($log, -50);
    }
    
    update_option('hipsy_events_error_log', $log);
    
    // Ook naar PHP error log
    error_log('Hipsy Events: ' . $message);
}
