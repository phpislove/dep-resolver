<?php namespace Phpislove;

use ReflectionClass, ReflectionParameter, ReflectionException;

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
        $arguments = [];

        foreach ($dependencies as $dependency)
        {
            $arguments[] = $this->resolveDependency($dependency);
        }

        return $arguments;
    }

    /**
     * @param ReflectionParameter $dependency
     * @return mixed
     */
    protected function resolveDependency(ReflectionParameter $dependency)
    {
        if ($this->hasClassTypeHint($dependency))
        {
            return $this->resolve($dependency->getClass()->getName());
        }

        if ($dependency->isDefaultValueAvailable())
        {
            return $dependency->getDefaultValue();
        }

        throw new Exceptions\UnresolvableDependency;
    }

    /**
     * @param ReflectionParameter $dependency
     * @return boolean
     */
    protected function hasClassTypeHint(ReflectionParameter $dependency)
    {
        try
        {
            return $dependency->getClass() instanceof ReflectionClass;
        }
        catch (ReflectionException $exception)
        {
            return false;
        }
    }

}
