<?php

namespace App\Tests;

use App\Entity\Medias;
use PHPUnit\Framework\TestCase;

class MediasTest extends TestCase
{
    public function testIsTrue(): void
    {
        $medias = new Medias();

        $medias
            ->setName('name');

        $this->assertTrue($medias->getName() === 'name');
    }

    public function testIsFalse()
    {
        $medias = new Medias();

        $medias
            ->setName('name');

        $this->assertFalse($medias->getName() === 'nome');
    }

    public function testIsEmpty()
    {
        $medias = new Medias();

        $this->assertEmpty($medias->getName());
    }
}
