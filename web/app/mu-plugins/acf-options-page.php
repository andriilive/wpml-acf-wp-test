<?php
/**
 * Plugin Name:  Add ACF Options Page
 * Plugin URI:   https://github.com/roots/bedrock/
 * Description:  Disallow indexing of your site on non-production environments.
 * Version:      1.0.0
 * Author:       Roots
 * Author URI:   https://roots.io/
 * License:      MIT License
 */


add_action('acf/init', function () {
    acf_add_options_page();
});
