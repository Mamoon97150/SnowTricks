<?php

namespace App\Tests;

use App\Entity\User;

class UserTest extends TestCase
{
    public function testIsTrue(): void
    {
        $user = new User();

        $user
            ->setUsername('username')
            ->setEmail('true@test.com')
            ->setFirstName('first name')
            ->setLastName('last name')
            ->setPassword('password')
            ->setPicture('path/to/profile/picture');

        $this->assertTrue($user->getUsername() === 'username');
        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getFirstName() === 'first name');
        $this->assertTrue($user->getLastName() === 'last name');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getPicture() === 'path/to/profile/picture');
    }

    public function testIsFalse()
    {
        $user = new User();

        $user
            ->setUsername('username')
            ->setEmail('true@test.com')
            ->setFirstName('first name')
            ->setLastName('last name')
            ->setPassword('password')
            ->setPicture('path/to/profile/picture');

        $this->assertFalse($user->getUsername() === 'user name');
        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getFirstName() === 'firstname');
        $this->assertFalse($user->getLastName() === 'lastname');
        $this->assertFalse($user->getPassword() === 'pass word');
        $this->assertFalse($user->getPicture() === 'path/not/to/profile/picture');
    }

    public function testIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getFirstName());
        $this->assertEmpty($user->getLastName());
        $this->assertEmpty($user->getPicture());
    }
}
