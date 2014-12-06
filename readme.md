# MermaidPhp

First, make yourself familiar with the brilliant 
[Mermaid project](https://github.com/knsv/mermaid).

Basically, **MermaidPhp** provides you a nice and clean interface 
to generate valid **Mermaid** code.
 
Now (if you want to give it a try), lets review the installation process.

## Installation

In order to install MermaidPhp, you need Composer.
Run the following command in your project root directory.

```shell
composer require bound1ess/mermaid-php:~1.0
```

Ok, now include `vendor/autoload.php` file in your project (if you have not done this yet)
and you are all set to go!

## Example of usage

This PHP code

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

- Run `mermaid_php_code_directory/examples/create` file, 
it will produce `mermaid_php_code_directory/example.html` HTML file
- Now set up development server with this command: `php -S localhost:8000`
- View this file in your browser by visiting `localhost:8000/example.html`

## API

*[I have not finished this section just yet, but it is going to be posted soon, I promise]*

## License information

This project is licensed under the MIT license 
(*see the license file for detailed information*).
