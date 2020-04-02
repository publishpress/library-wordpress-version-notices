<?php
/**
 * Copyright (c) 2020 PublishPress
 *
 * GNU General Public License, Free Software Foundation <https://www.gnu.org/licenses/gpl-3.0.html>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     PPVersionNotices
 * @category    Core
 * @author      PublishPress
 * @copyright   Copyright (c) 2020 PublishPress. All rights reserved.
 **/

use Pimple\Container;
use PPVersionNotices\ServicesProvider;

if (!defined('PP_VERSION_NOTICES_LOADED')) {
    define('PP_VERSION_NOTICES_VERSION', '1.0.2');
    define('PP_VERSION_NOTICES_BASE_PATH', __DIR__);
    define('PP_VERSION_NOTICES_BASE_URL', untrailingslashit(plugin_dir_url(__FILE__)));
    define('PP_VERSION_NOTICES_SRC_PATH', PP_VERSION_NOTICES_BASE_PATH . '/src');

    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        /*
         * We need to check this because of the tests. Since we use composer the tests already loaded the class and
         * the autoload.php file doesn't check that (it is generated by composer).
         *
         * Make sure to update the class name after running composer update or dump autoload.
         */
        if (!class_exists('ComposerAutoloaderInit0ff73bab6c34dc502dbc3151d23f7930')) {
            require_once __DIR__ . '/vendor/autoload.php';
        }
    }

    $container = new Container();
    $container->register(new ServicesProvider());

    // Load the modules
    $module = $container['module_top_notice'];
    $module->init();

    define('PP_VERSION_NOTICES_LOADED', true);
}
