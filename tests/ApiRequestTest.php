<?php

namespace Tests;

use Modules\Auth\Models\User;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\AssertionFailedError;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiRequestTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    abstract protected function getRoute(): string;

    abstract protected function getMethod(): string;

    public function testUnauthenticated(): void
    {
        $this->checkRequestHasCode([], Response::HTTP_UNAUTHORIZED, false);
    }

    protected function checkRequestHasCode(array $params = [], int $expectedCode = Response::HTTP_OK, bool $authenticated = true): TestResponse
    {
        if ($authenticated) {
            $response = $this->actingAs($this->user, 'api')->json($this->getMethod(), $this->getRoute(), $params);
        } else {
            $response = $this->json($this->getMethod(), $this->getRoute(), $params);
        }

        $this->assertResponseCodeMatchesExpected($response, $expectedCode);

        return $response;
    }

    protected function loginAs(User $user): void
    {
        $this->user = $user;
    }

    private function assertResponseCodeMatchesExpected(TestResponse $response, int $expectedCode): void
    {
        if ($expectedCode === Response::HTTP_OK) {
            try {
                $response->assertSuccessful();
            } catch (AssertionFailedError $error) {
                $this->fail($error->getMessage() . "\n" . json_encode($response->json(), JSON_PRETTY_PRINT));
            }
        } else {
            $this->assertEquals($expectedCode, $response->status(), $response->getContent());
        }
    }
}
