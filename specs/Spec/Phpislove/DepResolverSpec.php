<?php namespace Spec\Phpislove;

use PhpSpec\ObjectBehavior;

class DepResolverSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Phpislove\DepResolver');
    }

    function it_throws_an_exception_if_class_does_not_exist()
    {
        $nonexistentClass = uniqid().'_class';

        $this->shouldThrow('Phpislove\Exceptions\NonexistentClass')
             ->duringResolve($nonexistentClass);
    }

}
