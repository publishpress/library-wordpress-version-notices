<?php

class WPTestCaseHttps extends \Codeception\TestCase\WPTestCase
{
    public function setUp(): void
    {
        // Before...
        parent::setUp();

        add_filter('set_url_scheme', [$this, 'filter_set_url_scheme'], 10, 3 );
    }

    public function filter_set_url_scheme( string $url, string $scheme, ?string $orig_scheme ) : string
    {
        return str_replace('http:', 'https:', $url);
    }
}
