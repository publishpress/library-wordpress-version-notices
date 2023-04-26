<?php

/*****************************************************************
 * This file is generated on composer update command by
 * a custom script. 
 * 
 * Do not edit it manually!
 ****************************************************************/

use PublishPress\WordpressVersionNotices\Versions;

class VersionsCest
{
    public function testAllVersionsAreRegistered(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $registeredVersions = $versions->getVersions();

        $I->assertNotEmpty($registeredVersions);
        $I->assertEquals([
            '2.0.0.1' => 'PublishPress\WordpressVersionNotices\initialize2Dot0Dot0Dot1',
            '2.0.0.2' => 'PublishPress\WordpressVersionNotices\initialize2Dot0Dot0Dot2',
            '2.0.3' => 'PublishPress\WordpressVersionNotices\initialize2Dot0Dot3',
        ], $registeredVersions);
    }

    public function testLatestVersionIsTheCurrentVersion(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $latestVersion = $versions->latestVersion();

        $I->assertEquals('2.0.3', $latestVersion);
    }

    public function testLatestVersionCallbackIsTheLastOne(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $latestVersionCallback = $versions->latestVersionCallback();

        $I->assertEquals('PublishPress\WordpressVersionNotices\initialize2Dot0Dot3', $latestVersionCallback);
    }

    public function testInitializeLatestVersion(WpunitTester $I)
    {
        $versions = Versions::getInstance();

        $versions->initializeLatestVersion();

        $I->assertTrue(class_exists('PPVersionNotices\ServicesProvider'));

        $didAction = (bool)did_action('publishpress_wordpress_version_notices_2Dot0Dot3_initialized');
        $I->assertTrue($didAction);
    }
}
