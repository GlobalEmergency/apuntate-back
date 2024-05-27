<?php

namespace GlobalEmergency\Apuntate\Admin\Infrastructure\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use GlobalEmergency\Apuntate\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    ) {
    }
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->createUser('admin@admin.com', 'admin');

        $this->manager->flush();
    }

    private function createUser(string $email, string $password): User
    {
        $user = new User();
        $user->setName('Admin');
        $user->setSurname('Admin');
        $user->setDateStart(new \DateTime());
        $user->setEmail($email);
        $user->setPassword($this->passwordEncoder->hashPassword($user, $password));
        $user->setRoles(['ROLE_ADMIN']);
        $this->manager->persist($user);

        return $user;
    }
}
