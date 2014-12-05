<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;
use Bound1ess\MermaidPhp\Node;

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
	
	function it_sets_the_node_text()
	{
		$this->setText('node text');
		$this->getText()->shouldReturn('node text');
		$this->getStyle()->shouldReturn(Node::SQUARE_EDGES);

		$this->setText('another node text', Node::CIRCLE);
		$this->getText()->shouldReturn('another node text');
		$this->getStyle()->shouldReturn(Node::CIRCLE);

		$this->shouldThrow('Bound1ess\MermaidPhp\Exceptions\InvalidStyleException')
			 ->duringSetText('some node text', 'invalid style');
	}

}
