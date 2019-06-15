<?php declare(strict_types=1);

namespace OussamaElgoumri\Component\Testing;

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionMethod;
use ReflectionProperty;
use Throwable;
use ReflectionClass;

class TestCase extends BaseTestCase
{
    /**
     * Instantiate an object without calling it's constructor.
     *
     * @param string $class
     * @return object
     */
    protected function newInstanceWithoutConstructor(string $class): object
    {
        $rf = new ReflectionClass($class);

        return $rf->newInstanceWithoutConstructor();
    }

    /**
     * Test protected/private methods.
     *
     * @param object $object
     * @param string $method
     * @param ...$args
     *
     * @return mixed
     */
    protected function invoke(object $object, string $method, ...$args)
    {
        $r = new ReflectionMethod($object, $method);
        $r->setAccessible(true);

        return $r->invokeArgs($object, $args);
    }

    /**
     * Get the content of protected/private attributes.
     *
     * @param object $object
     * @param string $name
     * @param mixed  $value
     * @return mixed|void
     */
    protected function attr(object $object, string $name, $value = null)
    {
        $r = new ReflectionProperty($object, $name);
        $r->setAccessible(true);

        if (is_null($value)) return $r->getValue($object);

        $r->setValue($object, $value);
    }

    /**
     * Turn on output buffering.
     *
     * @param callable $callback
     * @return mixed
     */
    protected function buffered(callable $callback)
    {
        try {
            ob_start();
            $callback();

            return ob_get_clean();
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }
    }
}
