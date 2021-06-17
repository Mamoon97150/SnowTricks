<?php

namespace App\Tests;

use App\Entity\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testIsTrue(): void
    {
        $message = new Message();

        $message
            ->setContent('content');

        $this->assertTrue($message->getContent() === 'content');
    }

    public function testIsFalse()
    {
        $message = new Message();

        $message
            ->setContent('content');

        $this->assertFalse($message->getContent() === 'contented');
    }

    public function testIsEmpty()
    {
        $message = new Message();

        $this->assertEmpty($message->getContent());
    }
}
