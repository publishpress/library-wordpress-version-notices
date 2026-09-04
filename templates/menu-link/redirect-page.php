<div class="pp-version-notice-upgrade-menu-item-page pp-version-notice-redirect" data-redirect-to="<?php echo esc_url($link); ?>">
    <p>
        <span class="dashicons dashicons-smiley spin bounce"></span>
        <div class="message"><?php echo esc_html($message); ?></div>
    </p>

</div>
<?php
$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';
$version = defined('PUBLISHPRESS_WORDPRESS_VERSION_NOTICES_VERSION')
    ? PUBLISHPRESS_WORDPRESS_VERSION_NOTICES_VERSION
    : '2.2.1';
$handle = 'publishpress-wordpress-version-notices-redirect';
wp_register_script(
    $handle,
    plugins_url(
        "assets/js/redirect{$suffix}.js",
        trailingslashit(PP_VERSION_NOTICES_BASE_PATH) . 'wordpress-version-notices.php'
    ),
    [],
    $version,
    false
);
wp_enqueue_script($handle);
wp_print_scripts($handle);
?>
