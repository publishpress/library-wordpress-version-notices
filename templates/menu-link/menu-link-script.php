<?php
$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';
$version = defined('PUBLISHPRESS_WORDPRESS_VERSION_NOTICES_VERSION')
    ? PUBLISHPRESS_WORDPRESS_VERSION_NOTICES_VERSION
    : '2.2.1';

wp_enqueue_script(
    'publishpress-wordpress-version-notices-menu-link',
    plugins_url(
        "assets/js/menu-link{$suffix}.js",
        trailingslashit(PP_VERSION_NOTICES_BASE_PATH) . 'wordpress-version-notices.php'
    ),
    [],
    $version,
    true
);
?>
<?php foreach ($convertedUrlsMap as $urlData) : ?>
    <span class="pp-version-notice-menu-config"
        data-plugin-name="<?php echo esc_attr($urlData['pluginName']); ?>"
        data-redirect-to="<?php echo esc_url($urlData['redirectTo']); ?>" hidden></span>
<?php endforeach; ?>
