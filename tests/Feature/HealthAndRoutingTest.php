<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthAndRoutingTest extends TestCase
{
    public function test_health_endpoint_returns_successful_response(): void
    {
        $this->get('/up')->assertSuccessful();
    }

    public function test_public_api_unknown_resource_returns_json_404(): void
    {
        $this->getJson('/api/v1/public/not-existing-endpoint')
            ->assertNotFound()
            ->assertJson([
                'message' => 'Resource not found',
            ]);
    }

    public function test_private_api_requires_authentication(): void
    {
        $this->getJson('/api/v1/user')
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Unauthenticated',
            ]);
    }
}
