<?php

namespace App\Tests\Entity;

use App\Entity\Customers;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomersTest extends TestCase
{
    public function testThanAUserHAsAtleastOneRoleUser(): void
    {
        $user = new Customers();
        $this->assertContains("ROLE_USER", $user->getRoles());
    }
}
