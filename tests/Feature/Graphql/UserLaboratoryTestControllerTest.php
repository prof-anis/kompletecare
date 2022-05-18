<?php


namespace Tests\Feature\Graphql;


use App\Mail\UserLaboratoryTestMail;
use App\Models\LaboratoryTest;
use Illuminate\Support\Facades\Mail;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class UserLaboratoryTestControllerTest extends TestCase
{
    use MakesGraphQLRequests;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_will_handle_submitted_data()
    {
        Mail::fake();
        $laboratoryTests = LaboratoryTest::limit(5)->inRandomOrder()->pluck('id')->toArray();
        $this->assertCount(5, $laboratoryTests);

        $laboratoryTests = implode(",", $laboratoryTests);
        $this->withToken(base64_encode("User Access Token"))->graphQL("
          mutation {
            SendUserLaboratoryTest(userID: 2, laboratoryTests: [{$laboratoryTests}]) {
            message
          }
          }
        ")->assertExactJson([
            "data" => [
                "SendUserLaboratoryTest" => [
                    "message" => "Records sent successfully."
                ]
            ]
        ]);

        Mail::assertQueued(UserLaboratoryTestMail::class);
    }

    public function test_will_return_unauthenticated_for_users_who_are_not_authenticated()
    {
        $this->graphQL('
          mutation {
            SendUserLaboratoryTest(userID: 2, laboratoryTests: [8, 9, 7]) {
            message
          }
          }
        ')->assertJson([
            "errors" => [
                [
                    "message" => "Unauthenticated.",
                    "extensions" => [
                        "guards" => [
                            "sanctum"
                        ],
                        "category" => "authentication"
                    ]
                ]
            ]
        ]);
    }
}
