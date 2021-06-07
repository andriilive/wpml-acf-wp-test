<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sample_Theme
 */

?>
    <hr>
    <footer id="colophon" class="site-footer">
        <h2>ACF OPTIONS FIELDS</h2>
        <pre><?php print_r(get_fields('option')) ?></pre>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
