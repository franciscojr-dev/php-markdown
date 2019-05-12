<?php 

/**
* File of tests
*/

namespace Markdown;

require __DIR__ . '/../vendor/autoload.php';

$markdown = new Markdown("file.md");
$parser = Parser::markdown($markdown);

echo $parser;