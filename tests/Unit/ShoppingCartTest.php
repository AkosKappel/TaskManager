<?php

namespace Tests\Unit;

use App\ShoppingCart;
use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testCartContents()
    {
        $cart = new ShoppingCart(['apple', 'orange']);
        $this->assertTrue($cart->has('apple'));
        $this->assertFalse($cart->has('banana'));
    }

    public function testTakeOneFromCart()
    {
        $cart = new ShoppingCart(['vodka', 'rum', 'gin']);
        $this->assertEquals('vodka', $cart->takeOne());
        $this->assertEquals('rum', $cart->takeOne());
        $this->assertEquals('gin', $cart->takeOne());

        // Null, now the box is empty
        $this->assertNull($cart->takeOne());
    }

    public function testStartsWithALetter()
    {
        $box = new ShoppingCart(['toy', 'torch', 'ball', 'cat', 'tissue']);

        $results = $box->startsWith('t');

        $this->assertCount(3, $results);
        $this->assertContains('toy', $results);
        $this->assertContains('torch', $results);
        $this->assertContains('tissue', $results);

        // Empty array if passed even
        $this->assertEmpty($box->startsWith('s'));
    }
}
