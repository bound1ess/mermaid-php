<?php namespace Bound1ess\MermaidPhp;

class Printer {

	/**
	 * @var boolean
	 */
	protected $testMode;

    /**
     * ClassName => [NodeId, ...]
     * 
     * @var array
     */
    protected $relations = [];

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
			'graph %s%s%s%s',
			$this->renderDirection($graph->getDirection()),
			$this->renderNodes($graph->getNodes()),
			$this->renderLinks($graph->getLinks()),
            $this->renderClasses($graph->getClasses())
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
        $this->setRelations($node->getId(), $node->getAttachedClasses());

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
     * @param array $classes
     * @return string
     */
    protected function renderClasses(array $classes)
    {
        $result = [];

        foreach ($classes as $class)
        {
            $result[] = $this->renderClass($class);
        }

        return $this->concatenateElements($result).$this->renderRelations();
    }

    /**
     * @param NodeClass $class
     * @return string
     */
    protected function renderClass(NodeClass $class)
    {
        $properties = [];

        foreach ($class->getProperties() as $key => $value)
        {
            $properties[] = "{$key}:{$value}";
        }

        return sprintf('classDef %s %s', $class->getName(), implode(',', $properties));
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

    /**
     * @param string $nodeId
     * @param array $attachedClasses
     * @return void
     */
    protected function setRelations($nodeId, array $attachedClasses)
    {
        foreach ($attachedClasses as $class)
        {
            if ( ! isset ($this->relations[$class]))
            {
                $this->relations[$class] = [];
            }

            $this->relations[$class][] = $nodeId;
        }
    }

    /**
     * @return void
     */
    protected function renderRelations()
    {
        $result = [];

        foreach ($this->relations as $className => $nodeIds)
        {
            $result[] = sprintf('class %s %s', implode(',', $nodeIds), $className);
        } 
    
        return $this->concatenateElements($result);
    }

}
