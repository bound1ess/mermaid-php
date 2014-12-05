<?php namespace Bound1ess\MermaidPhp;

class Link {

	/**
	 * @var array
	 */
	protected $nodes = [];
	
	/**
	 * @param Node $node
	 * @param Node $anotherNode
	 */		
	public function __construct($node, $anotherNode)
	{
		$this->nodes[] = $node;
		$this->nodes[] = $anotherNode;
	}

	/**
	 * @return array
	 */
	public function getNodes()
	{
		return $this->nodes;
	}

}
