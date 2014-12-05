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
	 * @var string|null
	 */
	protected $text = null;

	/**
	 * @var string|null
	 */
	protected $style = null;

	/**
	 * @param string $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @param string $text
	 * @param string|null $style
	 * @return void
	 */
	public function setText($text, $style = null)
	{
		$this->text = $text;

		# If the node style is not specified, we assume Node::SQUARE_EDGES.
		if (is_null($style))
		{
			$style = static::SQUARE_EDGES;
		}

		$this->style = $style;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string|null
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @return string|null
	 */
	public function getStyle()
	{
		return $this->style;
	}

}
