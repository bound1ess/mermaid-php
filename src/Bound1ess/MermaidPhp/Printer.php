<?php namespace Bound1ess\MermaidPhp;

class Printer {

	/**
	 * @param Graph $graph
	 * @param boolean $wrapInDiv
	 * @return string
	 */
	public function printGraph(Graph $graph, $wrapInDiv = false)
	{
		return "graph {$graph->getDirection()};";
	}		

}
