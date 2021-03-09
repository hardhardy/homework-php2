<?php

use app\models\entities\Product;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProduct()
    {
        $name = "Чай";
        $product = new Product($name);
        $this->assertIsObject($product);
        $this->assertEquals($name, $product->name);
    }
}