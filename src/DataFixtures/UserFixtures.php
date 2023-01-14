<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USERS = [
        [
            'email' => 'admin@gmail.com',
            'role' => ['ROLE_ADMIN'],
            'password' => 'admin',
        ],
        [
            'email' => 'nina@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'nina',
        ],
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $key => $values) {
            $user = new User();
            $user->setEmail($values['email']);
            $user->setRoles($values['role']);
            $hash = $this->passwordHasher->hashPassword($user, $values['password']);
            $user->setPassword($hash);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
