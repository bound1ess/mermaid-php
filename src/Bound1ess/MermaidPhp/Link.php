<?php namespace Bound1ess\MermaidPhp;

class Link {

	/**
	 * @var array
	 */
	protected $nodes = [];
	
	/**
	 * @var boolean
	 */
	protected $isOpen = true;

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
	 * @param boolean|null $newValue
	 * @return void
	 */
	public function isOpen($newValue = null)
	{
		# If a new value is passed, replace the old one with it.
		# Otherwise, just return the current value.
		if ( ! is_null($newValue))
		{
			$this->isOpen = $newValue;

			return;
		}

		return $this->isOpen;
	}

	/**
	 * @return array
	 */
	public function getNodes()
	{
		return $this->nodes;
	}

}
