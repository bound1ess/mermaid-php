<?php namespace Bound1ess\MermaidPhp;

class NodeClass {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @param string $name
     * @return NodeClass
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $property
     * @param string $value
     * @return void
     */
    public function add($property, $value)
    {
        $this->properties[$property] = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string $property
     * @param array $value
     * @return void
     */
    public function __call($property, array $value)
    {
        $this->add($this->transform($property), $value[0]);    
    }

    /**
     * @param string $value
     * @return string
     */
    protected function transform($value)
    {
        return preg_replace_callback('/[A-Z]/', function(array $matches)
        {
            return '-'.strtolower($matches[0]);
        }, $value);
    }

}
