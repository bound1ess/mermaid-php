<?php namespace Bound1ess\MermaidPhp;

class Node {

	/**
	 * @var string
	 */
	const SQUARE_EDGE = '[%s]';

	/**
	 * @var string
	 */
	const ROUND_EDGE = '(%s)';

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
	 * @param array|null $settings
	 */
	public function __construct($id, $settings = null)
	{
		$this->id = $id;

		# If some settings were passed, let's configure the node right away!
		if ( ! is_null($settings))
		{
			call_user_func_array([$this, 'setText'], $settings);
		}
	}

	/**
	 * @param string $text
	 * @param string|null $style
	 * @return void
	 */
	public function setText($text, $style = null)
	{
		$this->text = $text;

		# If the node style is not specified, we assume Node::SQUARE_EDGE.
		if (is_null($style))
		{
			$style = static::SQUARE_EDGE;
		}
		else
		{
			# We need to verify that the passed $style is valid.
			# In order to do that we need a list of all valid styles, right?
			$styles = [
				static::SQUARE_EDGE,
				static::ROUND_EDGE,
				static::CIRCLE,
				static::ASYMETRIC_SHAPE,
				static::RHOMBUS,
			];

			# Unfortunately, the passed $style is invalid.			
			if ( ! in_array($style, $styles))
			{
				throw new Exceptions\InvalidStyleException($style);
			}	
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
