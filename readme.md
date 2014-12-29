# MermaidPhp

[![Build Status](https://travis-ci.org/bound1ess/mermaid-php.svg?branch=master)](https://travis-ci.org/bound1ess/mermaid-php)

First, make yourself familiar with the brilliant 
[Mermaid project](https://github.com/knsv/mermaid).

Basically, **MermaidPhp** provides you a nice and clean interface 
to generate compatible with **Mermaid** code.
 
Now (if you want to give it a try), lets review the installation process.

## Installation

In order to install MermaidPhp, you need Composer.

Run the following command in your project root directory:

```shell
composer require bound1ess/mermaid-php:~1.0
```

Ok, now include `vendor/autoload.php` file in your project (if you have not done this yet)
and you are all set to go!

## Example of usage

This PHP code:

```php
use Bound1ess\MermaidPhp\Graph,
	Bound1ess\MermaidPhp\Printer,
	Bound1ess\MermaidPhp\Node,
	Bound1ess\MermaidPhp\Link;

$graph = new Graph('from left to right');

$graph->addNodes(
	$a = new Node('A', ['Hard edge']),
	$b = new Node('B', ['Round edge', Node::ROUND_EDGE]),
	$c = new Node('C', ['Decision', Node::RHOMBUS]),
	$d = new Node('D', ['Result one']),
	$e = new Node('E', ['Result two'])
);

$graph->addLinks(
	new Link($a, $b, 'Link text'),
	new Link($b, $c),
	new Link($c, $d, 'One'),
	new Link($c, $e, 'Two')
);

$code = (new Printer)->printGraph($graph);
```

Will produce something like this:
![](http://i.imgur.com/hE2cGrs.png)

If you want to see this example in your browser, do the following:

- Execute `vendor/bound1ess/php-mermaid/examples/create` file, 
it will produce `example.html` file in your project root directory.
- Now set up a PHP development server by running this command: `php -S localhost:8000`.
- View the `example.html` file in your browser by visiting `localhost:8000/example.html`.

## API

- `Bound1ess\MermaidPhp\Printer`
	- `__construct($testMode = false)`
		- `$testMode`: when set to `true`, `Printer` will produce code that is invalid,
		but much easier to test. 
	- `printGraph(Graph $graph, $wrapInDiv = false)`
		- `$graph`: an instance of `Bound1ess\MermaidPhp\Graph` is expected.
		- `$wrapInDiv`: when set to `true`, the code produced will be wrapped in a
		`<div>` element with the class `mermaid`.
		- *This method will return a string.*

- `Bound1ess\MermaidPhp\Graph`
	- `__construct($direction = null)`
		- `$direction`: if not `null`, `setDirection` method will be called.
	- `setDirection($direction)`
		- `$direction`: valid values are `Node::TOP_BOTTOM`, `Node::BOTTOM_TOP`,
		 `Node::LEFT_RIGHT`, `Node::RIGHT_LEFT`, `from top to bottom`,
		`from bottom to top`, `from left to right`, `from right to left`.
		- *This method will return nothing (void).*
		- *This method can throw an instance of 
		`Bound1ess\MermaidPhp\Exceptions\InvalidDirectionException`.*
	- `addNode(Node $node)`
		- `$node`: an instance of `Bound1ess\MermaidPhp\Node` is expected.
		- *This method will return nothing (void).*
	- `addNodes(Node $node, ...)`
	- `addLink(Link $link)`
		- `$link`: an instance of `Bound1ess\MermaidPhp\Link` is expected.
		- *This method will return nothing (void).*
	- `addLinks(Link $link, ...)`
    - `addClass(NodeClass $class)`
        - `$class`: an instance of `Bound1ess\MermaidPhp\NodeClass`.
        - *This method will return nothing (void).*
    - `addClasses`
        - `dynamic`: as many `Bound1ess\MermaidPhp\NodeClass` instances as you need.
        - *This method will return nothing (void).*

- `Bound1ess\MermaidPhp\Node`
	- `__construct($id, array $settings = null)`
		- `$id`: the node id *(should be a string)*.
		- `$settings`: if not `null`, `setText` method will be called.
	- `setText($text, $style = null)`
		- `$text`: the node text *(should be a string)*. 
		- `$style`: valid values are `Node::ROUND_EDGE`, `Node::SQUARE_EDGE`, `Node::CIRCLE`,
		`Node::RHOMBUS`, `Node::ASYMETRIC_SHAPE`. If `null` is passed, `Node::SQUARE_EDGE`
		will be used.
		- *This method can throw an instance of 
		`Bound1ess\MermaidPhp\Exceptions\InvalidStyleException`.*
		- *This method will return nothing (void).*
    - `attachClass($name)`
        - `$name`: the class name as a `string`.
        - *This method will return nothing (void).*
    - `attachClasses`
        - `dynamic`: as many `string`s as you need.
        - *This method will return nothing (void).*
 
- `Bound1ess\MermaidPhp\Link`
	- `__construct(Node $node, Node $anotherNode, $text = null, $isOpen = false)`
		- `$node`: an instance of `Bound1ess\MermaidPhp\Node` is expected.
		- `$anotherNode`: an instance of `Bound1ess\MermaidPhp\Node` is expected.
		- `$text`: the text on link *(should be a string or `null`)*.
		- `$isOpen`: whether the link should be open or with arrow head
		*(should be a boolean, the default value is `false`)*. 
	- `setText($text)`
		- `$text`: the text on link *(should be a string)*.
		- *This method will return nothing (void).*
	- `isOpen($newValue = null)`
		- `$newValue`: if `null` is passed, this method will return the current value,
		otherwise new value will be set *(should be a boolean value)*.
		- *This method will return a boolean value or nothing (void).*

- `Bound1ess\MermaidPhp\NodeClass`
    - `__construct($name)`
        - `$name`: the class name as a `string`.
    - `add($property, $value)`
        - `$property`: the property name as a `string`.
        - `$value`: the property value as a `string`.
        - *This method will return the class instance itself.* 

## License information

This project is licensed under the MIT license 
(*see the license file for detailed information*).
