<?php namespace specs\Bound1ess\MermaidPhp;

use PhpSpec\ObjectBehavior;
use Bound1ess\MermaidPhp\Graph;

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

}
