<?php

namespace App\Tests\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    public function testVisitingWhileLoggedIn(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(CustomerRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('test@test.com');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // test e.g. the checkBook page
        $client->request('GET', '/check_book');
        $this->assertResponseIsSuccessful();
    }

    public function testRouteBookingIsSecure(): void
    {
        $client = self::createClient();
        $client->request('GET', '/booking');

        self::assertResponseStatusCodeSame(302); //redirect to Login page
    }

    public function testIfBookingJsRouteIsSuccessfulWithTheRightData(): void
    {
        $client = self::createClient();

        $client->request('POST', '/bookJS', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            "alias" => "Test",
            "date" => "2024-07-04",
            "hourSelectedDay" => "12:00",
            "hourSelectedNight" => "Non",
            "phoneNumber" => "0601020304",
            "preferedGroupNumber" => 2,
            "allergies" => "test"
        ], JSON_THROW_ON_ERROR));

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals(201, $statusCode); // Test if is successfully fulfilled
    }
}
