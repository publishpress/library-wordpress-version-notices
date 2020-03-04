<?php

namespace Template;

use PPProAds\Template\TemplateLoader;
use PPProAds\Template\TemplateLoaderInterface;
use PPProAds\Template\TemplateNotFoundException;

class TemplateLoaderTest extends \Codeception\TestCase\WPTestCase
{
    /**
     * @var \WpunitTester
     */
    protected $tester;

    /**
     * @var TemplateLoaderInterface
     */
    protected $templateLoader;

    public function setUp(): void
    {
        // Before...
        parent::setUp();

        $templatePath = PP_PRO_ADS_BASE_PATH . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_data' .
            DIRECTORY_SEPARATOR . 'dumb-templates';

        $this->templateLoader = new TemplateLoader($templatePath);
    }

    public function tearDown(): void
    {
        // Your tear down methods here.

        // Then...
        parent::tearDown();
    }

    // Tests
    public function test_exception_if_template_is_not_found_when_displaying()
    {
        $this->expectException(TemplateNotFoundException::class);
        $this->templateLoader->displayOutput('NotExistent', 'any');
    }

    public function test_exception_if_template_is_not_found_when_returning()
    {
        $this->expectException(TemplateNotFoundException::class);
        $this->templateLoader->returnOutput('NotExistent', 'any');
    }

    public function test_displayed_template_output()
    {
        ob_start();
        $this->templateLoader->displayOutput('Dumb', 'test1');
        $output = ob_get_clean();

        $expected = '<h1>Test1</h1>';

        $this->assertEquals($expected, $output);
    }

    public function test_returned_template_output()
    {
        $output = $this->templateLoader->returnOutput('Dumb', 'test1');

        $expected = '<h1>Test1</h1>';

        $this->assertEquals($expected, $output);
    }

    public function test_displayed_template_output_with_context()
    {
        $context = [
            'foo1' => 'bar1',
            'foo2' => 'bar2',
        ];

        ob_start();
        $this->templateLoader->displayOutput('Dumb', 'test2', $context);
        $output = ob_get_clean();

        $expected = '<h1>Test2: bar1, bar2</h1>';

        $this->assertEquals($expected, $output);
    }

    public function test_returned_template_output_with_context()
    {
        $context = [
            'foo1' => 'bar1',
            'foo2' => 'bar2',
        ];

        $output = $this->templateLoader->returnOutput('Dumb', 'test2', $context);

        $expected = '<h1>Test2: bar1, bar2</h1>';

        $this->assertEquals($expected, $output);
    }
}
