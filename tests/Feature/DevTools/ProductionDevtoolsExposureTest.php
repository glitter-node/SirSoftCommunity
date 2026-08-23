<?php

namespace Tests\Feature\DevTools;

use Tests\TestCase;

class ProductionDevtoolsExposureTest extends TestCase
{
    public function test_devtools_routes_are_not_registered_in_production(): void
    {
        $bootstrap = file_get_contents(base_path('bootstrap/app.php'));

        $this->assertStringContainsString(
            "defined('PHPUNIT_COMPOSER_INSTALL') || app()->environment('local')",
            $bootstrap,
        );
        $this->assertStringNotContainsString("environment(['local', 'testing'])", $bootstrap);
    }
}
