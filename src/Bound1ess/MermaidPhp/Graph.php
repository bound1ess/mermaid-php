<?php namespace Bound1ess\MermaidPhp;

class Graph {

	/**
	 * @var string
	 */
	const TOP_BOTTOM = 'TB';

	/**
	 * @var string
	 */
	const BOTTOM_TOP = 'BT';

	/**
	 * @var string
	 */
	const LEFT_RIGHT = 'LR';

	/**
	 * @var string
	 */
	const RIGHT_LEFT = 'RL';

	/**
	 * @var string|null
	 */
	protected $direction = null;

	/**
	 * @var array
	 */
	protected $nodes = [];

	/**
	 * @var array
	 */
	protected $links = [];

	/**
	 * @param string|null $direction
	 */
	public function __construct($direction = null)
	{
		# We only want to call setDirection() if the passed $direction is not equal to null.
		if ( ! is_null($direction))
		{
			$this->setDirection($direction);
		}
	}

	/**
	 * @param string $direction
	 * @return void
	 */
	public function setDirection($direction)
	{
		# First we need a list of all possible (and valid) directions.
		$validValues = [
			static::TOP_BOTTOM,
			static::BOTTOM_TOP,
			static::LEFT_RIGHT,
			static::RIGHT_LEFT,
		];

		# If the passed $direction is already valid and no transformations are required,
		# set the property value and exit.
		if (in_array($direction, $validValues))
		{
			$this->direction = $direction;

			return;
		}

		# Otherwise try to find valid $direction.
		$directions = [
			'from top to bottom' => static::TOP_BOTTOM,
			'from bottom to top' => static::BOTTOM_TOP,
			'from left to right' => static::LEFT_RIGHT,
			'from right to left' => static::RIGHT_LEFT,
		];

		# I actually cannot understand what you are talking about.
		if ( ! isset ($directions[$direction]))
		{
			throw new Exceptions\InvalidDirectionException($direction);
		}

		# Transformation is successfully completed and now we got a valid direction.
		$this->direction = $directions[$direction];
	}

	/**
	 * @param Node $node
	 * @return void
	 */
	public function addNode(Node $node)
	{
		$this->nodes[] = $node;
	}

	/**
	 * @param dynamic
	 * @return void
	 */
	public function addNodes()
	{
		foreach (func_get_args() as $node)
		{
			$this->addNode($node);
		}
	}

	/**
	 * @param Link $link
	 * @return void
	 */
	public function addLink(Link $link)
	{
		$this->links[] = $link;
	}

	/**
	 * @param dynamic
	 * @return void
	 */
	public function addLinks()
	{
		foreach (func_get_args() as $link)
		{
			$this->addLink($link);
		}
	}
	
	/**
	 * @return string|null
     */ 
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 * @return array
	 */
	public function getNodes()
	{
		return $this->nodes;
	}

	/**
	 * @return array
	 */
	public function getLinks()
	{
		return $this->links;
	}

}
