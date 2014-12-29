<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;

class NodeClassSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith('className');
    }

    function it_is_initializable()
	{
        $this->shouldHaveType('Bound1ess\MermaidPhp\NodeClass');
    }			

    function it_returns_the_class_name()
    {
        $this->getName()->shouldReturn('className');
    }

    function it_returns_class_properties()
    {
        $this->add('fill', '#ccf');
        $this->callOnWrappedObject('__call', ['strokeWidth', ['20px']]);

        $this->getProperties()->shouldReturn([
            'fill'         => '#ccf',
            'stroke-width' => '20px',
        ]);
    }

}
