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

/**
 * Class Module
 *
 * @package PPProAds
 */
class Module implements AdInterface
{
    /**
     * @var TemplateLoaderInterface
     */
    private $templateLoader;

    public function __construct(TemplateLoaderInterface $templateLoader)
    {
        $this->templateLoader = $templateLoader;
    }

    public function addHooks()
    {
        add_action('pp_pro_ads_display_top_banner', [$this, 'display']);
    }

    public function display()
    {
        $this->templateLoader->displayOutput('TopBanner', 'ad');
    }
}