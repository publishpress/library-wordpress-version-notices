<?php

class TopBannerCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->loginAsAdmin();
        $I->amOnPluginsPage();
        $I->activatePlugin(['dumb-plugin-one', 'dumb-plugin-two']);
    }

    public function tryToSeeTheDashboardWithoutTheTopBanner(AcceptanceTester $I)
    {
        $I->loginAsAdmin();
        $I->amOnAdminPage('admin.php');
        $I->dontSee('You\'re using Dumb Plugin One Free');
    }

    public function tryToSeeTheTopBannerForDumbPluginOne(AcceptanceTester $I)
    {
        $I->amOnAdminPage('edit.php?post_type=post');
        $I->see('You\'re using Dumb Plugin One Free', '.pp-pro-ads-top-banner-message');
        $I->dontSee('You\'re using Dumb Plugin Two Free', '.pp-pro-ads-top-banner-message');

        $banners = $I->grabMultiple('.pp-pro-ads-top-banner-message');
        $I->assertEquals(1, count($banners), 'Has more than one banner');
    }

    public function tryToSeeTheTopBannerForDumbPluginTwo(AcceptanceTester $I)
    {
        $I->amOnAdminPage('edit.php?post_type=page');
        $I->see('You\'re using Dumb Plugin Two Free', '.pp-pro-ads-top-banner-message');
        $I->dontSee('You\'re using Dumb Plugin One Free', '.pp-pro-ads-top-banner-message');

        $banners = $I->grabMultiple('.pp-pro-ads-top-banner-message');
        $I->assertEquals(1, count($banners), 'Has more than one banner');
    }
}
