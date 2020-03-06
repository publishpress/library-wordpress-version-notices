<?php

namespace Module\TopBanner;

use Pimple\Container;
use PPProAds\Module\AdInterface;
use PPProAds\Module\TopBanner\Module;
use PPProAds\ServicesProvider;
use PPProAds\Template\TemplateInvalidArgumentsException;

class ModuleTest extends \Codeception\TestCase\WPTestCase
{
    /**
     * @var \WpunitTester
     */
    protected $tester;

    /**
     * @var AdInterface
     */
    private $module;

    public function setUp(): void
    {
        // Before...
        parent::setUp();

        $container = new Container();
        $container->register(new ServicesProvider());

        $this->module = $container['module_top_banner'];
    }

    public function tearDown(): void
    {
        // Your tear down methods here.

        // Then...
        parent::tearDown();
    }

    // Tests
    public function test_module_enqueue_admin_style()
    {
        do_action('admin_enqueue_scripts');

        $wp_styles = wp_styles();
        $this->assertContains('pp-pro-ads-top-banner', $wp_styles->queue);
    }

    public function test_module_add_action_to_display()
    {
        global $wp_filter;

        $this->assertArrayHasKey(Module::DISPLAY_ACTION, $wp_filter,
            'The actionModule::self::DISPLAY_ACTION is not defined');
    }

    public function test_module_display_with_no_arguments_throws_exception()
    {
        $this->expectException(TemplateInvalidArgumentsException::class);

        try {
            ob_start();
            $this->module->display();
        } finally {
            ob_end_clean();
        }
    }

    public function test_module_display_with_arguments_returns_output()
    {
        $message = 'You\'re using The Test Free. Please, %supgrade to pro%s.';
        $link    = 'http://example.com/upgrade';

        ob_start();
        $this->module->display($message, $link);
        $output   = ob_get_clean();
        $expected = '<div class="pp-pro-ads-top-banner">You\'re using The Test Free. Please, <a href="http://example.com/upgrade" target="_blank">upgrade to pro</a>.</div>';

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    public function test_module_display_with_no_arguments_throws_exception_for_action()
    {
        $this->expectException(TemplateInvalidArgumentsException::class);

        try {
            ob_start();
            do_action(Module::DISPLAY_ACTION);
        } finally {
            ob_end_clean();
        }
    }

    public function test_module_display_with_arguments_returns_output_for_action()
    {
        $message = 'You\'re using The Test Free. Please, %supgrade to pro%s.';
        $link    = 'http://example.com/upgrade';

        ob_start();
        do_action(Module::DISPLAY_ACTION, $message, $link);
        $output   = ob_get_clean();
        $expected = '<div class="pp-pro-ads-top-banner">You\'re using The Test Free. Please, <a href="http://example.com/upgrade" target="_blank">upgrade to pro</a>.</div>';

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    public function test_module_display_with_arguments_returns_output_for_action_and_multiple_plugins()
    {
        $messageA = 'You\'re using The Test A Free. Please, %supgrade to pro%s.';
        $linkA    = 'http://example.com/upgrade-a';

        ob_start();
        do_action(Module::DISPLAY_ACTION, $messageA, $linkA);
        $output   = ob_get_clean();
        $expected = '<div class="pp-pro-ads-top-banner">You\'re using The Test A Free. Please, <a href="http://example.com/upgrade-a" target="_blank">upgrade to pro</a>.</div>';

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $messageB = 'You\'re using The Test B Free. Please, %supgrade to pro%s.';
        $linkB    = 'http://example.com/upgrade-b';

        ob_start();
        do_action(Module::DISPLAY_ACTION, $messageB, $linkB);
        $output   = ob_get_clean();
        $expected = '<div class="pp-pro-ads-top-banner">You\'re using The Test B Free. Please, <a href="http://example.com/upgrade-b" target="_blank">upgrade to pro</a>.</div>';

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
