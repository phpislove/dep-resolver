<?php namespace Spec\Phpislove;

use PhpSpec\ObjectBehavior;
// use Prophecy\Argument;

class DepResolverSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Phpislove\DepResolver');
    }

}
