<?php

namespace App\Tests;

use App\Entity\Tricks;
use PHPUnit\Framework\TestCase;

class TricksTest extends TestCase
{
    public function testIsTrue(): void
    {
        $tricks = new Tricks();

        $tricks
            ->setName('name')
            ->setDescription('description');

        $this->assertTrue($tricks->getName() === 'name');
        $this->assertTrue($tricks->getDescription() === 'description');
    }

    public function testIsFalse()
    {
        $tricks = new Tricks();

        $tricks
            ->setName('name')
            ->setDescription('description');

        $this->assertFalse($tricks->getName() === 'nome');
        $this->assertFalse($tricks->getDescription() === 'describe');
    }

    public function testIsEmpty()
    {
        $tricks = new Tricks();

        $this->assertEmpty($tricks->getName());
        $this->assertEmpty($tricks->getDescription());
    }
}
