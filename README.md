# About

**php-testing** provide a handful set of utilities to use when writing tests.

# Installation

`composer require oussama-elgoumri/php-testing`

# Usage

First extends `TestCase` in your test class

```php
use OussamaElgoumri\Component\Testing\TestCase;

class MyAwesomeTest extends TestCase
{
    // Testing MyAwesome object
}
```

let's assume that we want to test the following class

```php
class Foo {
  private $name = 'Oussama Elgoumri';
  private $active;

  private function add($a, $b) {
    return $a + $b;
  }
}
```

### Testing protected methods

To test the method `add` we would write:

```php
use OussamaElgoumri\Component\Testing\TestCase;

function test__my_private_method()
{
    $foo = new Foo;
    $results = $this->invoke($foo, 'add', 2, 3);
    $this->assertEquals($results, 5);
}
```

### Testing protected properties

To get the value of a private property:

```php
use OussamaElgoumri\Component\Testing\TestCase;

function test__my_private_property()
{
    $foo = new Foo;
    $name = $this->attr($foo, 'name');
    $this->assertEquals($name, 'Oussama Elgoumri');
}
```

### Accessing protected properties

To set the value of a private property:

```php
use OussamaElgoumri\Component\Testing\TestCase;

function test__my_private_property()
{
    $foo = new Foo;
    $this->attr($foo, 'active', true);
    $is_active = $this->attr($foo, 'active');
    $this->assertEquals($is_active, true);
}
```

### Instantiate object without calling it's constructor

```php
use OussamaElgoumri\Component\Testing\TestCase;

function test__instantiate_without_constructor()
{
    $foo = $this->newInstanceWithoutConstructor(Foo::class);
    $foo->doStuff();
}
```
