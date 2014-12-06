<?php namespace Bound1ess\MermaidPhp;

class Link {

	/**
	 * @var array
	 */
	protected $nodes = [];
	
	/**
	 * @var boolean
	 */
	protected $isOpen;

	/**
	 * @var string|null
	 */
	protected $text;

	/**
	 * @param Node $node
	 * @param Node $anotherNode
	 * @param string|null $text
	 * @param boolean $isOpen
	 */		
	public function __construct(Node $node, Node $anotherNode, $text = null, $isOpen = false)
	{
		$this->nodes[] = $node;
		$this->nodes[] = $anotherNode;

		$this->text = $text;
		$this->isOpen = $isOpen;
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
	 * @param string $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * @return array
	 */
	public function getNodes()
	{
		return $this->nodes;
	}

	/**
	 * @return string|null
	 */
	public function getText()
	{
		return $this->text;
	}

}
