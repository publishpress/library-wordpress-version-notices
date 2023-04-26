<?php
/**
 * Plugin Name: Dumb Plugin One
 * Plugin URI: https://publishpress.com/
 * Description: Dumb plugin for testing the library
 * Author: PublishPress
 * Author URI: https://publishpress.com
 * Version: 0.1.0
 *
 * Copyright (c) 2020 PublishPress
 *
 * GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
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
 * @package     PublishPress
 * @category    Core
 * @author      PublishPress
 * @copyright   Copyright (C) 2020 PublishPress. All rights reserved.
 */

use PPVersionNotices\Module\MenuLink\Module as ModuleMenuLink;
use PPVersionNotices\Module\TopNotice\Module as ModuleTopNotice;

if (! defined('DUMB_PLUGIN_ONE_LOADED')) {

    require_once __DIR__ . '/vendor/autoload.php';

    add_action('plugins_loaded', function () {
        add_filter(ModuleTopNotice::SETTINGS_FILTER, function ($settings) {
            $settings['dumb-plugin-one'] = [
                'message' => 'You\'re using Dumb Plugin One Free. Please, %supgrade to pro%s.',
                'link' => 'http://example.com/upgrade',
                'screens' => [
                    [
                        'base' => 'edit',
                        'id' => 'edit-post',
                        'post_type' => 'post',
                    ],
                ],
            ];

            return $settings;
        });

        add_filter(ModuleMenuLink::SETTINGS_FILTER, function ($settings) {
            $settings['dumb-plugin-one'] = [
                'parent' => 'dummy-plugin-one-page',
                'label' => 'Upgrade to Pro',
                'link' => 'http://example.com/upgrade/one',
            ];

            return $settings;
        });

        // Add a menu item for testing
        add_action('admin_menu', function () {
            add_menu_page(
                'Dummy plugin One',
                'Dummy Plugin One',
                'read',
                'dummy-plugin-one-page',
                function () {
                    return __return_empty_string();
                }
            );
        });
    }, -15, 0);

    define('DUMB_PLUGIN_ONE_LOADED', true);
}
