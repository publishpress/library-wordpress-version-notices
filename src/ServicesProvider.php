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

namespace PPProAds;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use PPProAds\Module\TopBanner\Module as TopBannerModule;
use PPProAds\Template\TemplateLoader;

class ServicesProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['TEMPLATES_PATH'] = function (Container $c) {
            return PP_PRO_ADS_BASE_PATH . DIRECTORY_SEPARATOR . 'templates';
        };

        $pimple['module_top_banner'] = function (Container $c) {
            return new TopBannerModule($c['template_loader']);
        };

        $pimple['template_loader'] = function (Container $c) {
            return new TemplateLoader($c['TEMPLATES_PATH']);
        };
    }
}