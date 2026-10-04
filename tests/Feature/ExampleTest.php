<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_health_route_returns_json(): void
    {
        $this->getJson('/api/up')
            ->assertOk()
            ->assertExactJson(['status' => 'up']);
    }
}
