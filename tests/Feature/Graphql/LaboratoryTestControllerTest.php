<?php

namespace Tests\Feature\Graphql;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class LaboratoryTestControllerTest extends TestCase
{
    use MakesGraphQLRequests;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }


    public function test_will_return_laboratory_tests()
    {
        $response = $this->withToken(base64_encode("User Access Token"))
            ->graphQL('{
                laboratoryTestGroup(first: 10) {
                    data {
                      id,
                      name,
                      laboratoryTests {
                        id,
                        name
                      }
                    }
                    paginatorInfo {
                      currentPage
                      lastPage
                    }
                }
            }');

        $this->assertCount(4, $response['data']['laboratoryTestGroup']['data']);
    }

    public function test_will_return_unauthenticated_response_if_user_is_not_authenticated()
    {
        $this->graphQL('{
                laboratoryTestGroup(first: 10) {
                    data {
                      id,
                      name,
                      laboratoryTests {
                        id,
                        name
                      }
                    }
                    paginatorInfo {
                      currentPage
                      lastPage
                    }
                }
            }')->assertJson([
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
