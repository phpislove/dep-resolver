<?php namespace Phpislove\Examples;

class ClassDependencyWithDefaultValue {

    public function __construct(NonexistentClass $dependency = null) {}

}
