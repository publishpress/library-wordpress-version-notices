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
 * @package     PPProAds
 * @category    Core
 * @author      PublishPress
 * @copyright   Copyright (c) 2020 PublishPress. All rights reserved.
 **/

namespace PPProAds\Module\TopBanner;

use PPProAds\Module\AdInterface;
use PPProAds\Template\TemplateLoaderInterface;
use PPProAds\Template\TemplateInvalidArgumentsException;

/**
 * Class Module
 *
 * @package PPProAds
 */
class Module implements AdInterface
{
    const SETTINGS_FILTER = 'pp_pro_ads_top_banner_settings';

    const DISPLAY_ACTION = 'pp_pro_ads_display_top_banner';

    /**
     * @var TemplateLoaderInterface
     */
    private $templateLoader;

    /**
     * @var array
     */
    private $settings = [];

    public function __construct(TemplateLoaderInterface $templateLoader)
    {
        $this->templateLoader = $templateLoader;
    }

    public function init()
    {
        add_action(self::DISPLAY_ACTION, [$this, 'display'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueStyle']);
        add_action('in_admin_header', [$this, 'adminHeader']);

        $this->settings = apply_filters(self::SETTINGS_FILTER, []);
    }

    /**
     * @param string $message
     * @param string $linkURL
     */
    public function display($message = '', $linkURL = '')
    {
        if (empty($message) || empty($linkURL)) {
            throw new TemplateInvalidArgumentsException();
        }

        $context = [
            'message' => $message,
            'linkURL' => $linkURL
        ];

        $this->templateLoader->displayOutput('TopBanner', 'ad', $context);
    }

    private function executeOnValidConditions(callable $callback)
    {
        foreach ($this->settings as $pluginName => $setting) {
            foreach ($setting['conditions'] as $vars) {
                if ($vars === true) {
                    $callback($setting);
                    return;
                }

                // Check each GET var
                $validVars = 0;
                foreach ($vars as $var => $value) {
                    if (!isset($_GET[$var]) || $_GET[$var] !== $value) {
                        break;
                    }

                    $validVars++;
                }
                if ($validVars === count($vars)) {
                    $callback($setting);
                    return;
                }
            }
        }
    }

    public function adminEnqueueStyle()
    {
        $this->executeOnValidConditions(function ($settings) {
            wp_enqueue_style(
                'pp-pro-ads-top-banner',
                dirname(dirname(dirname(plugin_dir_url(__FILE__)))) . DIRECTORY_SEPARATOR . 'assets/css/admin.css',
                false,
                PP_PRO_ADS_VERSION
            );
        });
    }

    public function adminHeader()
    {
        $this->executeOnValidConditions(function ($settings) {
            do_action(self::DISPLAY_ACTION, $settings['message'], $settings['link']);
        });

        return;
    }
}