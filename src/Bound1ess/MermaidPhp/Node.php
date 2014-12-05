<?php namespace Bound1ess\MermaidPhp;

class Node {

	/**
	 * @var string
	 */
	const SQUARE_EDGES = '[%s]';

	/**
	 * @var string
	 */
	const ROUND_EDGES = '(%s)';

	/**
	 * @var string
	 */
	const CIRCLE = '((%s))';

	/**
	 * @var string
	 */
	const ASYMETRIC_SHAPE = '>%s]';
		
	/**
	 * @var string
	 */
	const RHOMBUS = '{%s}';

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @param string $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

}
