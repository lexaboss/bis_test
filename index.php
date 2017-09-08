<?php

// autoload
spl_autoload_register(function ($class_name) {
	include __DIR__ . '/' . str_replace('\\', '/', basename($class_name)) . '.php';
});

// initializing array combinating service
$combinator = new \arrayCombinations\Generator();
$response = $combinator
	->setString('qwertyuiolk')
	->setMinChunk(2)
	->generate();


// printing out results ?>
<p>
	Is valid: <?= $response->isValid() ? 'true' : 'false' ?>
</p>

<p>
	Combinations count: <?= is_array($message = $response->getResponse()) ? count($message) : 'null' ?>
</p>

<pre>
	<?= print_r($response->getResponse(), true) ?>
</pre>