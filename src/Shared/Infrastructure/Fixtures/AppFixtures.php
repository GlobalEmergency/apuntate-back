<?php

namespace GlobalEmergency\Apuntate\Shared\Infrastructure\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use GlobalEmergency\Apuntate\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class AppFixtures extends Fixture implements FixtureInterface
{

    public function __construct(
        private UserPasswordHasherInterface $encoder
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('admin');
        $user->setSurname('admin');
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->encoder->hashPassword($user,'admin'));

        $manager->persist($user);
        $manager->flush();

    }
}
