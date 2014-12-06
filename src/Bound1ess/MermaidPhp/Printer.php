<?php namespace Bound1ess\MermaidPhp;

class Printer {

	/**
	 * @param Graph $graph
	 * @param boolean $wrapInDiv
	 * @return string
	 */
	public function printGraph(Graph $graph, $wrapInDiv = false)
	{
		return sprintf(
			'graph %s;%s', $graph->getDirection(), $this->renderNodes($graph->getNodes())
		);
	}		

	/**
	 * @param array $nodes
	 * @return string
	 */
	protected function renderNodes(array $nodes)
	{
		$result = '';

		foreach ($nodes as $node)
		{
			$result .= $this->renderNode($node);
		}

		return $result ? "{$result};" : '';
	}

	/**
	 * @param Node $node
	 * @return string
	 */
	protected function renderNode(Node $node)
	{
		$result = $node->getId();
	
		# Remember that we might not always have a text to work with.	
		if ( ! is_null($node->getText()))
		{
			# The style variable already contains a nice template, making our life easier.
			$result .= sprintf($node->getStyle(), $node->getText());
		}

		return $result;
	}
	
}
