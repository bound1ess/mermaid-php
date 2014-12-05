<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;
use Bound1ess\MermaidPhp\Node;

class LinkSpec extends ObjectBehavior {

	function let(Node $node, Node $anotherNode)
	{
		$this->beConstructedWith($node, $anotherNode);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Bound1ess\MermaidPhp\Link');
	}		

	function it_returns_both_nodes(Node $node, Node $anotherNode)
	{
		$this->getNodes()->shouldReturn([$node, $anotherNode]);
	}

}
