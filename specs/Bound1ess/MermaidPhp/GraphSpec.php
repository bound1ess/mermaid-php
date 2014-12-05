<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;
use Bound1ess\MermaidPhp\Graph;
use Bound1ess\MermaidPhp\Node;
use Bound1ess\MermaidPhp\Link;

class GraphSpec extends ObjectBehavior {

	function it_is_initializable()
	{
		$this->shouldHaveType('Bound1ess\MermaidPhp\Graph');
	}		

	function it_sets_the_direction_of_the_graph_layout()
	{
		$this->getDirection()->shouldReturn(null);

		$this->setDirection(Graph::TOP_BOTTOM);
		$this->getDirection()->shouldReturn('TB');
	
		$this->setDirection(Graph::LEFT_RIGHT);
		$this->getDirection()->shouldReturn('LR');

		$this->setDirection('from bottom to top');
		$this->getDirection()->shouldReturn('BT');
	
		$this->setDirection('from right to left');
		$this->getDirection()->shouldReturn('RL');

		$this->shouldThrow('Bound1ess\MermaidPhp\Exceptions\InvalidDirectionException')
			 ->duringSetDirection('something completely invalid');
	}

	function it_returns_the_nodes_added(Node $node, Node $anotherNode)
	{
		$this->getNodes()->shouldReturn([]);		

		$this->addNode($node);
		$this->getNodes()->shouldReturn([$node]);

		$this->addNode($anotherNode);
		$this->getNodes()->shouldReturn([$node, $anotherNode]);
	}

	function it_returns_the_links_added(Link $link, Link $anotherLink)
	{
		$this->getLinks()->shouldReturn([]);

		$this->addLink($link);
		$this->getLinks()->shouldReturn([$link]);

		$this->addLink($anotherLink);
		$this->getLinks()->shouldReturn([$link, $anotherLink]);
	}

}
