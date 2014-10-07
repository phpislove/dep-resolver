<?php namespace Phpislove\Examples;

class UnresolvableClassDependency {

    public function __construct(UninstantiableClass $dependency) {}

}
