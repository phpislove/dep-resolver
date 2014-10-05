<?php namespace Phpislove;

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
    }

}
