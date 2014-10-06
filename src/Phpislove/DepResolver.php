<?php namespace Phpislove;

use ReflectionClass;

class DepResolver {

    /**
     * @param string $class
     * @return mixed
     */
    public function resolve($class)
    {
        if ( ! class_exists($class))
        {
            throw new Exceptions\NonexistentClass;
        }

        $reflector = new ReflectionClass($class);

        if ( ! $reflector->isInstantiable())
        {
            throw new Exceptions\UninstantiableClass;
        }
    }

}
