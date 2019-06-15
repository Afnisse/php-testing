<?php

use OussamaElgoumri\Component\Testing\TestCase;

class TestCaseTest extends TestCase
{
    function test__newInstanceWithoutWithoutConstructor()
    {
        $i = $this->newInstanceWithoutConstructor(Bar::class);
        $this->assertTrue($i->callMe());
    }

    function test__invoke()
    {
        $f = new Foo;
        $r = $this->invoke($f, 'add', 2, 3);
        $this->assertTrue(5 === $r);
    }

    function test__attr()
    {
        $f = new Foo;
        $name = $this->attr($f, 'name');
        $this->assertTrue('Oussama Elgoumri' === $name);

        $this->attr($f, 'nameless', 'No name');
        $nameless = $this->attr($f, 'nameless');
        $this->assertTrue('No name' === $nameless);
    }

    function test__buffered()
    {
        $output = $this->buffered(function() {
            echo "Hi there!";
        });

        $this->assertEquals($output, 'Hi there!');
    }
}

class Bar {
    function __construct() {
        die("Better luck next time :)");
    }

    function callMe() {
        return true;
    }
}

class Foo
{
    private $name = 'Oussama Elgoumri';
    private $nameless;

    private function add($a, $b)
    {
        return $a + $b;
    }
}
