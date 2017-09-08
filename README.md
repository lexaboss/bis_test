# Combinatorial test task
Исполненное Задание (просим сказать сколько времени было потрачено):
 * Дана строчка символов длины M, например, 'qwertyuiolk'
 * необходимо получить массив из всех возможных разбиений с минимальной длиной N (например 2)
 * примеры разбиений ['qw','ertyuiolk'],['qw', 'erty','uiolk']
 * достаточно решить через рекурсию и простыми циклами.
 * можно продемонстрировать знание классов.
 * бонусом может считаться реализация в функциональном стиле через анонимные функции.

# Installation
git clone git@github.com:lexaboss/bis_test.git .

# Usage 
```php
<?php
$response = $combinator
	->setString('qwertyuiolk')
	->setMinChunk(2)
	->generate();
$response->getResponse() // <-- result is here
```

# System requirements
PHP 7.1
