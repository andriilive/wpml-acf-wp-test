<?php
/**
 * Plugin Name:  Timber Yoast SEO
 * Plugin URI:   https://github.com/roots/bedrock/
 * Description:  Register default theme directory
 * Version:      1.0.0
 * Author:       Roots
 * Author URI:   https://roots.io/
 * License:      MIT License
 */

class TimberWithYoastSEO
{

    /**
     * TimberPhoton constructor.
     */
    function __construct()
    {
        $this->admin_notices = [];
        add_action('plugins_loaded', [$this,'plugins_loaded']);
    }

    function admin_notices()
    {
        if (!empty($this->admin_notices)) {
            echo '<div class="error"><p>';
            if (in_array('timber', $this->admin_notices)) {
                _e('Timber WPML requires Timber Core (Plugin)');
            }
            if (in_array('timber-wpml', $this->admin_notices)) {
                _e('Timber WPML requires WPML Plugin');
            }
            echo '</p></div>';
        }
    }

    function plugins_loaded()
    {
        if ($this->system_ready()) {
            add_filter('timber/context', array( $this, 'add_to_context'));
        }
    }

    function add_to_context($context)
    {
        $context['seo'] = 'seo';
        return $context;
    }

    function system_ready()
    {
        global $timber;

        // Is Timber installed and activated?
        if (!class_exists('Timber')) {
            $this->admin_notices[] = 'timber';
            add_action('admin_notices', array($this,'admin_notices'));
            return false;
        }

        // Determine if WPML is configured
        if (!class_exists('SitePress')) {
            $this->admin_notices[] = 'timber-wpml';
            add_action('admin_notices', array($this,'admin_notices'));
            return false;
        }

        return true;
    }
}

new TimberWithYoastSEO;
