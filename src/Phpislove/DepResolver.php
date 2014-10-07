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

        $constructor = $reflector->getConstructor();

        if (is_null($constructor))
        {
            return $reflector->newInstance();
        }

        $dependencies = $constructor->getParameters();
        $arguments = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($arguments);
    }

    /**
     * @param array $dependencies
     * @return array
     */
    protected function resolveDependencies(array $dependencies)
    {
        throw new Exceptions\UnresolvableDependency;
    }

}
