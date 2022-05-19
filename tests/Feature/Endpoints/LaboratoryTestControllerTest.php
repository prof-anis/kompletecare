<?php

namespace Tests\Feature\Endpoints;

use Tests\TestCase;

class LaboratoryTestControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @test
     */
    public function willReturnLaboratoryTests(): void
    {
        $response = $this->withToken(base64_encode('User Access Token'))
            ->getJson('/api/laboratory-tests');

        $this->assertCount(4, $response['data']);
    }

    /**
     * @test
     */
    public function willReturnUnauthenticatedResponseIfUserIsNotAuthenticated(): void
    {
        $this->getJson('/api/laboratory-tests')->assertStatus(401);
    }
}
