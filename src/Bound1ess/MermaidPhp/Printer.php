<?php namespace Bound1ess\MermaidPhp;

class Printer {

	/**
	 * @var boolean
	 */
	protected $testMode;

	/**
	 * @param boolean $testMode
	 */
	public function __construct($testMode = false)
	{
		$this->testMode = $testMode;
	}

	/**
	 * @param Graph $graph
	 * @param boolean $wrapInDiv
	 * @return string
	 */
	public function printGraph(Graph $graph, $wrapInDiv = false)
	{
		$graph = sprintf(
			'graph %s%s%s',
			$this->renderDirection($graph->getDirection()),
			$this->renderNodes($graph->getNodes()),
			$this->renderLinks($graph->getLinks())
		);

		# By default, just plain graph will be returned.
		return $wrapInDiv ? "<div class=\"mermaid\">{$graph}</div>" : $graph;
	}		

	/**
	 * @param string $direction
	 * @return string
	 */
	protected function renderDirection($direction)
	{
		return $direction.($this->testMode ? ';' : ';'.PHP_EOL);
	}

	/**
	 * @param array $nodes
	 * @return string
	 */
	protected function renderNodes(array $nodes)
	{
		$result = [];

		foreach ($nodes as $node)
		{
			$result[] = $this->renderNode($node);
		}

		return $this->concatenateElements($result);
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

	/**
	 * @param array $links
	 * @return string
	 */
	protected function renderLinks(array $links)
	{
		$result = [];

		foreach ($links as $link)
		{
			$result[] = $this->renderLink($link);
		}

		return $this->concatenateElements($result);
	}

	/**
	 * @param Link $link
	 * @return string
	 */
	protected function renderLink(Link $link)
	{
		list ($node, $anotherNode) = $link->getNodes();

		$connection = $link->isOpen() ? '---' : '-->';

		# Remember that we might not always have a text to work with.
		if ( ! is_null($link->getText()))
		{
			$connection .= "|{$link->getText()}|";
		}

		return "{$node->getId()}{$connection}{$anotherNode->getId()}";	
	}

	/**
	 * @param array $elements
	 * @return string
	 */
	protected function concatenateElements(array $elements)
	{
		# If no elements are present, just return an empty string.
		if ( ! $elements)
		{
			return '';
		}

		# We do not append PHP_EOL when testing - it would make the resulting string
		# too complicated to reproduce.
		$glue = $this->testMode ? ';' : ';'.PHP_EOL;		

		# Just implode() them all and append a semi-colon to the end.
		return implode($glue, $elements).$glue;
	}
	
}
