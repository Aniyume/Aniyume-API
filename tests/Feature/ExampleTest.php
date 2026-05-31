<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_home_page_redirects_to_admin_web(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(config('app.admin_web_url', env('ADMIN_WEB_URL', 'http://localhost:3001')));
    }
}
