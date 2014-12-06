<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;
use Bound1ess\MermaidPhp\Graph;
use Bound1ess\MermaidPhp\Node;
use Bound1ess\MermaidPhp\Link;

class PrinterSpec extends ObjectBehavior {

	function it_is_initializable()
	{
		$this->shouldHaveType('Bound1ess\MermaidPhp\Printer');
	}			

	function it_prints_the_direction_of_the_graph_layout(Graph $graph)
	{
		$graph->getDirection()->willReturn('LR');
		$graph->getNodes()->willReturn([]);
		$graph->getLinks()->willReturn([]);

		$this->printGraph($graph)->shouldReturn('graph LR;');
	}

	function it_prints_a_node(Graph $graph, Node $node)
	{
		$graph->getDirection()->willReturn('LR');
		$graph->getNodes()->willReturn([$node]);
		$graph->getLinks()->willReturn([]);

		$node->getId()->willReturn('node_id');
		$node->getText()->willReturn(null);
		$this->printGraph($graph)->shouldReturn('graph LR;node_id;');

		$node->getText()->willReturn('Node text');
		$node->getStyle()->willReturn(Node::RHOMBUS);
		$this->printGraph($graph)->shouldReturn('graph LR;node_id{Node text};');
	}

	function it_prints_a_link(Graph $graph, Link $link, Node $node, Node $anotherNode)
	{
		$node->getId()->willReturn('first_node');
		$anotherNode->getId()->willReturn('second_node');

		$link->getNodes()->willReturn([$node, $anotherNode]);
		$link->isOpen()->willReturn(true);
		$link->getText()->willReturn(null);

		$graph->getDirection()->willReturn('LR');
		$graph->getNodes()->willReturn([]);
		$graph->getLinks()->willReturn([$link]);

		$this->printGraph($graph)->shouldReturn('graph LR;first_node---second_node;');

		$link->isOpen()->willReturn(false);
		$link->getText()->willReturn('Text on link');

		$this->printGraph($graph)->shouldReturn(
			'graph LR;first_node-->|Text on link|second_node;'
		);
	}

	function it_prints_a_graph(Graph $graph, Link $link, Node $node, Node $anotherNode)
	{
		$graph->getDirection()->willReturn('LR');
		
		$node->getId()->willReturn('A');
		$node->getText()->willReturn('First node');
		$node->getStyle()->willReturn(Node::SQUARE_EDGES);

		$anotherNode->getId()->willReturn('B');
		$anotherNode->getText()->willReturn('Second node');
		$anotherNode->getStyle()->willReturn(Node::ROUND_EDGES);

		$graph->getNodes()->willReturn([$node, $anotherNode]);
		
		$link->getNodes()->willReturn([$node, $anotherNode]);
		$link->isOpen()->willReturn(false);
		$link->getText()->willReturn('Text on link');
	
		$graph->getLinks()->willReturn([$link]);

		$this->printGraph($graph, true)->shouldReturn(
			'<div class="mermaid">'.
			'graph LR;A[First node];B(Second node);A-->|Text on link|B;'.
			'</div>'
		);	
	}

}
