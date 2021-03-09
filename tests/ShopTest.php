<?php


use PHPUnit\Framework\TestCase;

class ShopTest extends TestCase
{
    public function testAdd()
    {
        $x = 1;
        $y = 2;
        $this->assertEquals(3, $x + $y);
        $this->assertTrue(true);
    }

}