<?php
/**
 * Plugin Name: ACF Fields Sync
 * Plugin URI: //
 * Version: 1.0
 * Author: Andy Yolk
 * Author URI: //
 * Description: ACF Fields Sync
 */


add_action('acf/init', function () {
    //    acf_update_setting('show_admin', false);
    //    acf_update_setting('google_api_key', 'xxx');
    //    acf_update_setting('acfe/modules/single_meta', true);
    // acf_update_setting('acfe/modules/single_meta', true);
    acf_update_setting('acfe/dev', true);

    // Enable Force Sync
//    acf_update_setting('acfe/modules/force_sync', true);
});


add_filter('acf/load_field_group', function ($field_group) {
    $field_group['acfe_autosync'] = ['json'];
    return $field_group;
});
