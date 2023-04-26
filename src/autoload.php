<?php

use PPVersionNotices\Autoloader;
use PPVersionNotices\ServicesProvider;
use PublishPress\Pimple\Container;

if (! function_exists('untrailingslashit') || ! function_exists('plugin_dir_url')) {
    return;
}

add_action('plugins_loaded', function () {
    if (! defined('PP_VERSION_NOTICES_LOADED')) {
        define('PP_VERSION_NOTICES_VERSION', '2.0.1');
        define('PP_VERSION_NOTICES_BASE_PATH', __DIR__ . '/../');
        define('PP_VERSION_NOTICES_BASE_URL', untrailingslashit(plugin_dir_url(__FILE__)));
        define('PP_VERSION_NOTICES_SRC_PATH', __DIR__);

        Autoloader::register();

        $container = new Container();
        $container->register(new ServicesProvider());

        // Load the modules
        $module = $container['module_top_notice'];
        $module->init();

        $module = $container['module_menu_link'];
        $module->init();

        define('PP_VERSION_NOTICES_LOADED', true);
    }
}, -125, 0);
