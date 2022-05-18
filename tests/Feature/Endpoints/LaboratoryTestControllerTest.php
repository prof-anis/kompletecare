<?php

namespace Tests\Feature\Endpoints;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaboratoryTestControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }


    public function test_will_return_laboratory_tests()
    {
        $response = $this->withToken(base64_encode("User Access Token"))
            ->getJson("/api/laboratory-tests");

        $this->assertCount(4, $response['data']);
    }

    public function test_will_return_unauthenticated_response_if_user_is_not_authenticated()
    {
        $this->getJson("/api/laboratory-tests")->assertStatus(401);
    }
}
