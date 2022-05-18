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

    public function test_will_handle_submitted_data()
    {
        Mail::fake();
        $laboratoryTests = LaboratoryTest::limit(5)->inRandomOrder()->pluck('id');

        $this->assertCount(5, $laboratoryTests);

        $this->withToken(base64_encode("User Access Token"))
            ->postJson("/api/laboratory-tests/2", [
                "laboratoryTests" => $laboratoryTests->toArray()
            ])->assertExactJson([
                "message" => "Records sent successfully."
            ]);

        Mail::assertQueued(UserLaboratoryTestMail::class);
    }

    public function test_will_return_unauthenticated_for_users_who_are_not_authenticated()
    {
        $laboratoryTests = LaboratoryTest::limit(5)->inRandomOrder()->pluck('id');

        $this->assertCount(5, $laboratoryTests);
        $this->postJson("/api/laboratory-tests/2", $laboratoryTests->toArray())->assertStatus(401);
    }
}
