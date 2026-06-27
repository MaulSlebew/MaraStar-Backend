<?php

namespace Tests\Feature;

use Tests\TestCase;

class CorsTest extends TestCase
{
    public function test_cors_config_allows_vercel_origin(): void
    {
        $this->assertContains('https://hehehehabruh.vercel.app', config('cors.allowed_origins'));
        $this->assertContains('/^https:\/\/[a-z0-9-]+\.vercel\.app$/', config('cors.allowed_origins_patterns'));
    }
}
