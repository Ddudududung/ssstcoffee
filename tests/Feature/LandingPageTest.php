<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * Test that the landing page renders with SSST Coffee elements.
     */
    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Start with SSST.');
        $response->assertSee('Titik singgah,');
        $response->assertSee('Ringkas, familiar.');
        $response->assertSee('Bawa pulang yang lain.');
        $response->assertSee('07.00');
        $response->assertSee('21.00');
        $response->assertSee('#AlwaySSST');
    }
}

