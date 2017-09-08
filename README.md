# Combinatorial test task
Исполненное Задание (просим сказать сколько времени было потрачено):
o   Дана строчка символов длины M, например, 'qwertyuiolk'
o   необходимо получить массив из всех возможных разбиений с минимальной длиной N (например 2)
o   примеры разбиений ['qw','ertyuiolk'],['qw', 'erty','uiolk']
o   достаточно решить через рекурсию и простыми циклами.
o   можно продемонстрировать знание классов.
o   бонусом может считаться реализация в функциональном стиле через анонимные функции.

# Installation
git clone git@github.com:lexaboss/bis_test.git .

# Usage 
$response = $combinator
	->setString('qwertyuiolk')
	->setMinChunk(2)
	->generate();
$response->getResponse() // <-- result is here

# System requirements
PHP 7.1
