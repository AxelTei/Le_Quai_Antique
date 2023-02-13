<?php

namespace App\DataFixtures;

use App\Entity\Customers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new Customers($this->passwordHasher);

        $user->setEmail("Admin@LeQuaiAntique.com")->setPassword("JaimelaSavoi3")->setRoles(array("ROLE_ADMIN"));
        $manager->persist($user);
        $manager->flush();
    }
}
