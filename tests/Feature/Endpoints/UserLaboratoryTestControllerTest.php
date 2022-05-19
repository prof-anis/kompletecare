<?php

namespace Tests\Feature\Endpoints;

use App\Mail\UserLaboratoryTestMail;
use App\Models\LaboratoryTest;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserLaboratoryTestControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * @test
     */
    public function willHandleSubmittedData(): void
    {
        Mail::fake();

        $laboratoryTests = LaboratoryTest::limit(5)->inRandomOrder()->pluck('id');

        $this->assertCount(5, $laboratoryTests);

        $this->withToken(base64_encode('User Access Token'))
            ->postJson('/api/laboratory-tests/2', [
                'laboratoryTests' => $laboratoryTests->toArray(),
            ])->assertExactJson([
                'message' => 'Records sent successfully.',
            ]);

        Mail::assertQueued(UserLaboratoryTestMail::class);
    }

    /**
     * @test
     */
    public function willReturnUnauthenticatedForUsersWhoAreNotAuthenticated(): void
    {
        $laboratoryTests = LaboratoryTest::limit(5)->inRandomOrder()->pluck('id');

        $this->assertCount(5, $laboratoryTests);
        $this->postJson('/api/laboratory-tests/2', $laboratoryTests->toArray())->assertStatus(401);
    }
}
