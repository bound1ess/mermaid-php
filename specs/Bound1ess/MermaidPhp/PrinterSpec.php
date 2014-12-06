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

	function it_prints_a_link_between_two_nodes(Graph $graph, Link $link)
	{
		$link->getNodes()->willReturn([new Node('first_node'), new Node('second_node')]);
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

}
