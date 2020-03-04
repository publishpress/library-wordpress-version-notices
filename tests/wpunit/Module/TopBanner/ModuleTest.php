<?php

namespace Module\TopBanner;

use PPProAds\Module\TopBanner\Module;

class ModuleTest extends \Codeception\TestCase\WPTestCase
{
    /**
     * @var \WpunitTester
     */
    protected $tester;

    public function setUp(): void
    {
        // Before...
        parent::setUp();

        // Your set up methods here.
    }

    public function tearDown(): void
    {
        // Your tear down methods here.

        // Then...
        parent::tearDown();
    }

    // Tests
    public function test_module_display_hooks_is_defined()
    {
        global $wp_filter;

        $this->assertArrayHasKey('pp_pro_ads_display_top_banner', $wp_filter,
            'The action pp_pro_ads_display_top_banner is not defined');
    }

    public function test_module_output_is_returned_after_calling_action()
    {
        ob_start();
        do_action('pp_pro_ads_display_top_banner');
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
    }
}
