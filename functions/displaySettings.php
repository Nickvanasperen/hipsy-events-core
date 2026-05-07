<?php
function hipsy_events_settings_page()
{
    // Handle Clear Error Log
    if (isset($_GET['clear_error_log']) && $_GET['clear_error_log'] == '1') {
        delete_option('hipsy_events_error_log');
        add_settings_error(
            'hipsy_error_log',
            'log_cleared',
            'Error log gewist.',
            'success'
        );
    }
    
    // Handle Test Sync
    if (isset($_POST['hipsy_test_sync']) && 
        isset($_POST['hipsy_test_sync_nonce']) && 
        wp_verify_nonce($_POST['hipsy_test_sync_nonce'], 'hipsy_test_sync_action')) {
        
        $result = refresh_hipsy_events_func(true); // true = test mode
        
        if ($result) {
            add_settings_error(
                'hipsy_test_sync',
                'test_sync_success',
                'Test sync voltooid! Bekijk het resultaat hieronder.',
                'success'
            );
        } else {
            add_settings_error(
                'hipsy_test_sync',
                'test_sync_error',
                'Test sync gefaald. Check de error log.',
                'error'
            );
        }
    }
    
    // Handle Full Sync
    if (isset($_POST['hipsy_full_sync']) && 
        isset($_POST['hipsy_full_sync_nonce']) && 
        wp_verify_nonce($_POST['hipsy_full_sync_nonce'], 'hipsy_full_sync_action')) {
        
        $result = refresh_hipsy_events_func(false); // false = full sync
        
        if ($result) {
            add_settings_error(
                'hipsy_full_sync',
                'full_sync_success',
                'Volledige sync voltooid! Check het resultaat hieronder.',
                'success'
            );
        } else {
            add_settings_error(
                'hipsy_full_sync',
                'full_sync_error',
                'Sync gefaald. Check de error log.',
                'error'
            );
        }
    }
    
    // Handle normale settings save
    if (isset($_POST['hipsy_events_api_key'])) {
        submit_hipsy_events_options();
    }
?>
    <div class="wrap" style="max-width:700px;">
        <h1><?php esc_html_e('Hipsy Events Settings', 'hipsy-events'); ?></h1>
        <p>On this page you update the hipsy settings and synchronise all your events on Hipsy. Just click the blue button to load all your events. Whenever you make changes to events on Hipsy, you can also click this button to sync your changes to your own Wordpress site. It's magic!</p>
        <form action="edit.php?post_type=events&page=hipsy_events_settings" method="post">
            <?php settings_fields('hipsy_events_settings'); ?>
            <?php do_settings_sections('hipsy_events'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e('API Key', 'hipsy-events'); ?></th>
                    <td>
                        <?php $api_key = get_option('hipsy_events_api_key'); ?>
                        <input type="password" style="width:100%;" id="hipsy_events_api_key" name="hipsy_events_api_key" value="<?php echo esc_attr($api_key); ?>" />
                        <p><a href="https://hipsy.nl/app/api-keys" target="_blank" class="description"><?php esc_html_e('Generate an API key here', 'hipsy-events'); ?></a>.</p>
                    </td>
                </tr>
                <?php if ($api_key) { ?>
                    <?php
                    $organisations = get_hipsy_organisations($api_key);
                    if (isset($organisations["message"])) {
                        add_settings_error('hipsy_events_api_key', 'hipsy_events_api_key_error', __('Invalid API key. Please correct it', 'hipsy-events'));
                        update_option('hipsy_events_organisation_slug', "");
                    } else { ?>
                        <tr>
                            <th scope="row"><?php esc_html_e('Organisation', 'hipsy-events'); ?></th>
                            <td>
                                <?php $org_slug = get_option('hipsy_events_organisation_slug'); ?>
                                <select name="hipsy_events_organisation_slug" id="hipsy_events_organisation_slug">
                                    <option disabled selected value> -- select an organisation -- </option>
                                    <?php foreach ($organisations as $organisation) { ?>
                                        <option value="<?php echo $organisation["slug"]; ?>" <?php selected($org_slug, $organisation["slug"]) ?>><?php echo $organisation["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <?php if ($org_slug) { ?>
                            <tr>
                                <th scope="row"><?php esc_html_e('Button Link', 'hipsy-events'); ?></th>
                                <td>
                                    <?php $value = get_option('hipsy_events_button_link'); ?>
                                    <select name="hipsy_events_button_link" id="hipsy_events_button_link">
                                        <option value="shop" <?php selected($value, 'shop'); ?>>Ticketshop</option>
                                        <option value="event" <?php selected($value, 'event'); ?>>Event page</option>
                                        <option value="popup" disabled <?php selected($value, 'popup'); ?>>Popup</option>
                                    </select>
                                    <p class="description"><?php esc_html_e('Where should the ticket button link to?', 'hipsy-events'); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e('Dark Mode', 'hipsy-events'); ?></th>
                                <td class="hipsy-toggle">
                                    <?php $value = get_option('hipsy_events_dark_mode'); ?>
                                    <input type="checkbox" id="hipsy_events_dark_mode" name="hipsy_events_dark_mode" value="1" <?php checked(1, $value); ?> />
                                    <label for="hipsy_events_dark_mode">Click to toggle</label>

                                    <p class="description"><?php esc_html_e('Enable dark styling for events and widgets.', 'hipsy-events'); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php esc_html_e('v4.0 Features 🆕', 'hipsy-events'); ?></th>
                                <td class="hipsy-toggle">
                                    <?php $v4_enabled = get_option('hipsy_events_v4_enabled'); ?>
                                    <input type="checkbox" id="hipsy_events_v4_enabled" name="hipsy_events_v4_enabled" value="1" <?php checked(1, $v4_enabled); ?> />
                                    <label for="hipsy_events_v4_enabled">Enable v4.0 Features</label>
                                    <p class="description">
                                        <?php esc_html_e('Enable v4.0 features: AJAX Filtering, Filter Bar Widget, Query ID System, Extended Shortcodes.', 'hipsy-events'); ?>
                                        <br><strong>Note:</strong> Requires plugin reactivation after enabling.
                                    </p>
                                </td>
                            </tr>
                        <?php } ?>


                    <?php } ?>

                <?php } ?>
            </table>
            <div style="display:flex; align-items: center; gap:10px;
">
                <?php settings_errors(); ?>
                <?php $button_text = "Save Settings";
                if (!$api_key) $button_text = "Verify API key"; ?>
                <p class="submit"><button type="submit" name="custom_button" class="button button-primary"><?php _e($button_text, 'hipsy-events'); ?></button></p>

            </div>
        
        <?php if (get_option('hipsy_events_last_sync')) : ?>
            <p><strong>Laatste automatische sync:</strong> <?php echo esc_html(get_option('hipsy_events_last_sync')); ?></p>
        <?php endif; ?>
        <?php if (get_option('hipsy_events_last_sync_error')) : ?>
            <p style="color:#b32d2e;"><strong>Laatste sync fout:</strong> <?php echo esc_html(get_option('hipsy_events_last_sync_error')); ?></p>
        <?php endif; ?>
        
        <?php
        // Toon sync resultaat
        $sync_result = get_option('hipsy_events_last_sync_result');
        if ($sync_result && is_array($sync_result)) :
        ?>
            <div style="background:#f0f0f1; padding:15px; border-left:4px solid #2271b1; margin-top:20px;">
                <h3 style="margin-top:0;">Sync Resultaat</h3>
                <p>
                    <strong>Totaal:</strong> <?php echo $sync_result['total']; ?> events<br>
                    <strong>Succesvol:</strong> <span style="color:#46b450;"><?php echo $sync_result['success']; ?></span><br>
                    <strong>Gefaald:</strong> <span style="color:#dc3232;"><?php echo $sync_result['failed']; ?></span><br>
                    <strong>Tijd:</strong> <?php echo $sync_result['timestamp']; ?>
                    <?php if ($sync_result['test_mode']) : ?>
                        <br><em>(Test modus - alleen eerste 3 events)</em>
                    <?php endif; ?>
                </p>
                <?php if (!empty($sync_result['errors'])) : ?>
                    <details>
                        <summary style="cursor:pointer;">Toon errors (<?php echo count($sync_result['errors']); ?>)</summary>
                        <ul style="margin-top:10px;">
                            <?php foreach ($sync_result['errors'] as $error) : ?>
                                <li><?php echo esc_html($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </details>
                <?php endif; ?>
            </div>
        <?php endif; ?>
</form>

    <?php if ($org_slug && $api_key) : ?>
        <div style="margin-top:30px; padding:20px; background:#fff; border:1px solid #ccd0d4;">
            <h2>🧪 Test & Sync</h2>
            <p>Test eerst met 3 events voordat je alles synchroniseert. Dit voorkomt problemen.</p>
            
            <form method="post" action="" style="display:inline-block; margin-right:10px;">
                <input type="hidden" name="hipsy_test_sync" value="1">
                <?php wp_nonce_field('hipsy_test_sync_action', 'hipsy_test_sync_nonce'); ?>
                <button type="submit" class="button button-secondary">
                    🧪 Test Sync (3 events)
                </button>
            </form>
            
            <form method="post" action="" style="display:inline-block;">
                <input type="hidden" name="hipsy_full_sync" value="1">
                <?php wp_nonce_field('hipsy_full_sync_action', 'hipsy_full_sync_nonce'); ?>
                <button type="submit" class="button button-primary" onclick="return confirm('Alle events synchroniseren vanaf Hipsy?');">
                    🔄 Volledige Sync
                </button>
            </form>
            
            <p class="description" style="margin-top:10px;">
                <strong>Tip:</strong> Gebruik eerst "Test Sync" om te controleren of alles werkt.
            </p>
        </div>
    <?php endif; ?>
    
    <?php
    // Error log viewer
    $error_log = get_option('hipsy_events_error_log', array());
    if (!empty($error_log)) :
    ?>
        <div style="margin-top:30px; padding:20px; background:#fff; border:1px solid #dc3232;">
            <h2>🐛 Error Log (laatste 50)</h2>
            <p>
                <a href="?post_type=events&page=hipsy_events_settings&clear_error_log=1" 
                   class="button button-small" 
                   onclick="return confirm('Error log wissen?');">
                    Wis Log
                </a>
            </p>
            <div style="max-height:400px; overflow-y:auto; background:#f9f9f9; padding:10px; font-family:monospace; font-size:12px;">
                <?php foreach (array_reverse($error_log) as $entry) : ?>
                    <div style="margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #ddd;">
                        <strong><?php echo esc_html($entry['time']); ?></strong><br>
                        <?php echo esc_html($entry['message']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    
    </div>
    <style>
        .form-table td.hipsy-toggle {
            padding-top: 0;
        }

        .hipsy-toggle input[type=checkbox] {
            height: 0;
            width: 0;
            visibility: hidden;
        }

        .hipsy-toggle label {
            cursor: pointer;
            text-indent: -9999px;
            width: 60px;
            height: 30px;
            background: #dddddd;
            display: block;
            border-radius: 30px;
            position: relative;
        }

        .hipsy-toggle label:after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 24px;
            transition: 0.4s;
        }

        .hipsy-toggle input:checked+label {
            background: #1a5e58;
        }

        .hipsy-toggle input:checked+label:after {
            left: calc(100% - 3px);
            transform: translateX(-100%);
        }

        .hipsy-toggle label:active:after {
            width: 40px;
        }
    </style>
<?php
}
