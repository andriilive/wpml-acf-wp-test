<?php
/**
 * Plugin Name:  Timber WPML
 * Plugin URI:   https://github.com/roots/bedrock/
 * Description:  Register default theme directory
 * Version:      1.0.0
 * Author:       Roots
 * Author URI:   https://roots.io/
 * License:      MIT License
 */

class TimberWithWPML
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

    function wpml_current($return_type = 'obj')
    {
        $lang = apply_filters('wpml_current_language', null);
        if ($return_type === 'obj') {
            return wpml_get_language_information($lang);
        } else {
            return $lang;
        }
    }

    function wpml_available($skip_current = true)
    {
        $languages = apply_filters('wpml_active_languages', null);
        if ($skip_current) {
            unset($languages[$this->wpml_current('str')]);
        }
        return $languages;
    }

    function wpml_default()
    {
        return wpml_get_default_language();
    }

    function wpml_global_data()
    {

        $data = [];
        $data['current'] = $this->wpml_current();
        $data['list'] = $this->wpml_available(false);
        $data['default'] = $this->wpml_default();

        return $data;
    }

    function wpml_get_translations($keep_current = true)
    {

        $translations = apply_filters('wpml_get_element_translations', null, get_queried_object_id());

        if ( !$keep_current ) {
               unset($translations[$this->wpml_current('str')]);
        }

        return $translations;

    }

    function add_to_context($context)
    {
        $context['languages'] = $this->wpml_global_data();
//        $context['obj_id'] = get_queried_object_id();

        // https://wpml.org/wpml-hook/wpml_element_has_translations/
        // TODO: MAKE THIS SHIT WORK
        $is_translated = apply_filters('wpml_element_has_translations', null, get_queried_object_id());

        if ($is_translated && $this->wpml_get_translations()) {
            $context['languages']['has_translations'] = true;
            $context['languages']['translations'] = $this->wpml_get_translations(false);
        }

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

new TimberWithWPML;
