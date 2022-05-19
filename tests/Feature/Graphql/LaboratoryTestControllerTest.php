<?php

namespace Tests\Feature\Graphql;

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

    /**
     * @test
     */
    public function willReturnLaboratoryTests(): void
    {
        $response = $this->withToken(base64_encode('User Access Token'))
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

    /**
     * @test
     */
    public function willReturnUnauthenticatedResponseIfUserIsNotAuthenticated(): void
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
            'errors' => [
                [
                    'message'    => 'Unauthenticated.',
                    'extensions' => [
                        'guards' => [
                            'sanctum',
                        ],
                        'category' => 'authentication',
                    ],
                ],
            ],
        ]);
    }
}
