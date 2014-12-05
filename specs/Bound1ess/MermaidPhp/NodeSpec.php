<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;

class NodeSpec extends ObjectBehavior {
	
	function let()
	{
		$this->beConstructedWith('node id');
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Bound1ess\MermaidPhp\Node');
	}

	function it_returns_the_node_id()
	{
		$this->getId()->shouldReturn('node id');
	}

}
